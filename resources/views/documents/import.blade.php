@extends('_base')

@section('content')
    <div class="row justify-content-end mt-4">

        {{-- Bloco de pesquisa --}}
        <div class="col-6">
            <form method="GET" action="{{ route('import.index') }}">
                <div class="row">
                    <div class="col-8 form-group">
                        <input type="text" name="search" id="search" class="form-control"
                            placeholder="Pesquisar por Titulo ou Categoria..." value="{{ request()->query('search') }}">
                    </div>
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary">Pesquisar</button>
                    </div>
                </div>
            </form>
        </div>

        {{-- Botão para importar aquivo --}}
        <div class="col-3 d-flex justify-content-end">
            <form method="post" action="{{ route('import.start') }}">
                @csrf
                <button class="btn btn-primary" type="submit" id="importar-arquivo">Importar arquivo</button>
            </form>
        </div>
    </div>

    {{-- Tabela de documentos importados --}}
    <div class="row mt-3">
        <div class="col-12 card">
            @if ($documentos->count() > 0)
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th class="border-top-0">#</th>
                            <th class="border-top-0">Categoria</th>
                            <th class="border-top-0">Titulo</th>
                            <th class="border-top-0">Conteúdo</th>
                            <th class="border-top-0">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($documentos as $documento)
                            <tr>
                                <th scope="row">{{ $documento->id }}</th>
                                <td><span class="badge badge-primary">{{ $documento->category->name }}</span></td>
                                <td>{{ $documento->title }}</td>
                                <td>{{ Str::limit($documento->contents, 50) }}</td>
                                <td class="d-flex justify-content-between">
                                    <a class="btn btn-sm btn-primary"
                                        href="{{ route('import.edit', ['document' => $documento->id]) }}">Editar</a>
                                    <form method="POST" action="{{ route('import.delete', ['document' => $documento->id]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="delete btn btn-sm btn-danger"
                                            onclick="return confirmDelete()">Excluir</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>Nenhum documento encontrado.</p>
            @endif

        </div>
    </div>

    {{-- Pagianação documentos importados --}}
    <div class="row justify-content-end mt-4">
        <div class="col-6 d-flex justify-content-end">
            {{ $documentos->links('pagination::bootstrap-4') }}
        </div>
    </div>

    {{-- Bloco de aviso --}}
    @if (session('status'))
        <div class="toast fade" style="position: absolute; top: 0; right: 0;" data-autohide="false">
            <div class="toast-header">
                <strong class="mr-auto">Aviso</strong>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body">
                {{ session('status') }}
            </div>
        </div>
    @endif

@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('.toast').toast('show');

            $('#importar-arquivo').click(function(event) {
                event.preventDefault();
                var form = $(this).closest('form');
                var mensagem = 'Tem certeza de que deseja importar o arquivo?';
                if (confirm(mensagem)) {
                    form.submit();
                }
            });
        });

        function confirmDelete() {
            return confirm("Tem certeza que deseja excluir o documento?");
        }
    </script>
@endsection
