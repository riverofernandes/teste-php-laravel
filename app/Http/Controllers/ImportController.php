<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessImport;
use App\Models\Category;
use App\Models\Document;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImportController extends Controller
{
    /* Mostrar lista de documentos importados
    **
    ** @param Request $request
    ** @return View
    */
    public function index(Request $request): View
    {
        $documentos = Document::query();
        if ($request->query('search')) {
            $searchTerm = '%' . $request->query('search') . '%';
            $documentos->where('title', 'LIKE', $searchTerm)
                ->orWhereHas('category', function ($query) use ($searchTerm) {
                    $query->where('name', 'LIKE', $searchTerm);
                });
        }

        $documentos = $documentos->paginate(12);
        return view('documents.import', compact('documentos'));
    }

    /* Processar lista.Json
    **
    ** @return RedirectResponse
    */
    public function start(): RedirectResponse
    {
        $filename = '2023-03-28.json';
        $fileContents = Storage::disk('private')->get($filename);
        $data = json_decode($fileContents, true);

        foreach ($data['documentos'] as $item) {
            ProcessImport::dispatch($item)->onQueue('imports');
        }

        return back()->with('status', 'A importação foi iniciada!');
    }

    /* Pagina de editar documento
    **
    ** @return View
    */
    public function edit(Document $document): View
    {
        $categories = Category::get();
        return view('documents.edit', compact('document', 'categories'));
    }


    /* Update documento
    **
    ** @return RedirectResponse
    */
    public function update(Request $request, Document $document): RedirectResponse
    {
        $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'content' => 'required',
        ], [
            'title.required' => 'O campo título é obrigatório.',
            'category_id.required' => 'O campo categoria é obrigatório.',
            'content.required' => 'O campo conteúdo é obrigatório.',
        ]);

        $document->fill($request->only(['title', 'category_id', 'content']));
        $document->save();

        return redirect()->route('import.index')->with('status', 'Documento atualizado com sucesso!');
    }

    /* Deletar documento
    **
    ** @return RedirectResponse
    */
    public function delete(Document $document): RedirectResponse
    {
        $document->delete();

        return redirect()->back()->with('status', 'Documento excluído com sucesso');
    }
}
