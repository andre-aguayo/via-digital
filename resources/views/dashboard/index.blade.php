@extends('main')
@section('title', 'Área de trabalho')

@section('head-tags')
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ URL::asset('css/dashboard.css') }}" rel="stylesheet">
@endsection

@section('content')
    <main>
        <div class="album py-5 bg-light">
            <div class="container">
                <div class="row text-center">
                    <h5>Seus quadros de trabalho</h5>
                </div>
                <!-- Mensagens de erro -->
                @if ($errors->all())
                    @foreach ($errors->all() as $error)
                        <p class="text-center" style="color: red">{{ $error }}</p>
                    @endforeach
                @endif

                <!-- Adiçao de novo quadro de trabalho -->
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                    <div class="col new-workboard workboard">
                        <div class="card shadow-sm" data-toggle="modal" data-target="#modal_add_workboard">
                            <svg class="bd-placeholder-img card-img-top" width="100%" height="225"
                                xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail"
                                preserveAspectRatio="xMidYMid slice" focusable="false">
                                <title>Placeholder</title>
                                <rect width="100%" height="100%" fill="#66695c" /><text x="43%" y="50%"
                                    fill="#eceeef">Novo</text>
                            </svg>
                        </div>
                    </div>

                    <!-- Mostra os quadros de trabalho do usuario logado -->
                    @foreach ($userWorkboardsAccesses as $userWorkboardAcces)
                        <div class="col workboard">
                            <div class="card shadow-sm">
                                <a
                                    href="quadro-de-trabalho/{{ $userWorkboardAcces->workboard->id }}/{{ $userWorkboardAcces->workboard->name }}">

                                    <svg class="bd-placeholder-img card-img-top " width="100%" height="225"
                                        xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail"
                                        preserveAspectRatio="xMidYMid slice" focusable="false">

                                        <title>{{ $userWorkboardAcces->workboard->name }}</title>

                                        <rect width="100%" height="100%" fill="#55595c" />
                                        <text x="40%" y="50%" fill="#eceeef">{{ $userWorkboardAcces->workboard->name }}
                                        </text>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>

    <!-- Modal para cadastro de novo quadro de trabalho -->
    <div class="modal fade" id="modal_add_workboard" tabindex="-1" role="dialog" aria-labelledby="modal_add_workboard"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Adicionar novo quadro de trabalho</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- Componente Vue para validaçao de formulario -->
                <div id="app">
                    <form-workboard></form-workboard>
                </div>
            </div>
        </div>
    </div>
@endsection
