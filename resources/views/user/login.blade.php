@extends('main')
@section('title', 'Login')
@section('content')
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-xl-9 mx-auto">
                <div class="card flex-row my-5 border-0 shadow rounded-3 overflow-hidden">
                    <div class="card-img-left d-none d-md-flex">
                    </div>
                    <div class="card-body p-4 p-sm-5">
                        <h5 class="card-title text-center mb-5 fw-light fs-5">Login</h5>
                        <!-- Mostra as mensagens de erros vindas dos validadores de Rquest do laravel -->
                        @if ($errors->all())
                            @foreach ($errors->all() as $error)
                                <p class="text-center" style="color: red">{{ $error }}</p>
                            @endforeach
                        @endif
                        <!-- Template com o formulario e validaçao de login -->
                        <div id="app">
                            <form-login></form-login>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="{{ mix('/js/app.js') }}"></script>
