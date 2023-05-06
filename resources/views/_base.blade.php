<!DOCTYPE html>
<html>

<head>
    <title>Importar arquivo</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>

<body>
    <div class="bg-primary p-2">
        <div class="container">
            <div class="row">
                <div class="col-3">
                    <a href="{{ route('import.index') }}">
                        <h3 class="text-white">Teste AiSolutions</h3>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        @yield('content')
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

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>

    @yield('script')
</body>

</html>
