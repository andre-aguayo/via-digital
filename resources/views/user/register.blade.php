@extends('main')
@section('title', 'Cadastrar usuário')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-10 col-xl-9 mx-auto">
            <div class="card flex-row my-5 border-0 shadow rounded-3 overflow-hidden">
                <div class="card-img-left d-none d-md-flex">
                </div>
                <div class="card-body p-4 p-sm-5">
                    <h5 class="card-title text-center mb-5 fw-light fs-5">Cadasto</h5>
                    @if ($errors->all())
                        @foreach ($errors->all() as $error)
                            <p class="text-center" style="color: red">{{ $error }}</p>
                        @endforeach
                    @endif
                    <form @submit.prevent="handleSubmit" method="POST" action="/requisitar-cadastro">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="user_name" id="user_name" placeholder="Nome"
                                required autofocus>
                            <label for="user_name">Nome</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="user_email" name="user_email"
                                placeholder="nome@exemplo.com" required>
                            <label for="user_email">Email</label>
                        </div>
                        <hr>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" name="user_password" id="user_password" min="8"
                                placeholder="Password" required>
                            <label for="user_password">Senha</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="user_confirm_password" min="8"
                                placeholder="Confirm Password" required>
                            <label for="user_confirm_password">Confirmar senha</label>
                        </div>
                        <div class="d-grid mb-12 text-center">
                            <div class="d-grid mb-2">
                                <button class="btn btn-primary btn-login fw-bold text-uppercase text-center"
                                    type="submit">Cadastrar</button>
                            </div>
                        </div>
                        <a class="d-block text-center mt-2 small" href="/login">Ja possui uma conta? Login</a>
                        <hr class="my-4">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script src="{{ mix('/js/app.js') }}"></script>

@section('script')
@endsection
