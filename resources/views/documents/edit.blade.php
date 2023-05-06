@extends('_base')

@section('content')
    <div class="row justify-content-center">

        {{-- Botão volar index --}}
        <div class="col-7 my-2 d-flex justify-content-end">
            <a class="btn btn-outline-primary" href="{{ route('import.index') }}">Voltar</a>
        </div>
        <div class="col-7 card">
            <div class="card-body">
                {{-- Formulario update --}}
                <form method="post" action="{{ route('import.update', ['document' => $document->id]) }}">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col-12 form-group">
                            <label for="title">Titulo</label>
                            <input id="title" type="text" name="title" class="form-control"
                                value="{{ $document->title }}">
                        </div>
                        <div class="col-12 form-group">
                            <label for="category_id">Categoria</label>
                            <select id="category_id" name="category_id" class="form-control">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $category->id == $document->category_id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 form-group">
                            <label for="content">Conteúdo</label>
                            <textarea id="content" name="content" class="form-control" rows="10">{{ $document->contents }}</textarea>
                        </div>
                        <div class="col-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Atualizar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Bloco de aviso --}}
    @if ($errors->any())
        <div class="toast fade" style="position: absolute; top: 0; right: 0;" data-autohide="false">
            <div class="toast-header bg-danger text-white">
                <strong class="mr-auto">Erro de validação</strong>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('.toast').toast('show');
        })
    </script>
@endsection
