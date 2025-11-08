@extends('layouts.login')

@section('content')
    <div class="container-fluid px-0">
        <div class="row min-vh-100 gx-0">
            <div class="col-lg-4 px-4 px-lg-5 d-flex align-items-center position-relative">
                <div class="w-100 py-5">
                    <div class="text-center"><img class="img-fluid mb-4" src="{{ asset('img/logos/logo.png') }}" alt="logo-ocatec" style="max-width: 19rem;">

                    </div>
                    <form class="login-form" method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">Nome Completo</label>
                            <input class="form-control @error('name') is-invalid @enderror"  type="text" id="name"  name="name" placeholder="Nome Completo">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input class="form-control @error('email') is-invalid @enderror" type="text" id="email" name="email" placeholder="Insira seu E-mail">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="documento">CPF</label>
                            <input class="form-control @error('documento') is-invalid @enderror" type="text" id="documento" name="documento" placeholder="Insira seu CPF">
                            @error('documento')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="password">Senha</label>
                            <input class="form-control @error('password') is-invalid @enderror" type="password" id="password"  name="password" placeholder="Insira sua Senha">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="password_confirmation">Confirmar Senha</label>
                            <input class="form-control @error('password_confirmation') is-invalid @enderror" type="password" id="password_confirmation"  name="password_confirmation" placeholder="Insira sua Senha">
                            @error('password_confirmation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <br>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="checkbox-signup" value="1">
                                <label class="custom-control-label" for="checkbox-signup">Eu aceito os <a href="https://ocatec.com.br/termos-condicoes" class="text-muted" target="_blank">Termos e Condições</a></label>
                            </div>
                        </div>
                        <br>
                        <br>
                         <button type="submit" style="font-size:16px; background: #ee7336;border: 2px solid transparent !important;color: white;" class="btn btn-lg btn-primary mb-3 w-100">Cadastrar</button>

                        <!-- Link-->
                        <p class="text-xs text-muted text-center">Já é nosso parceiro ? <a href="/">Voltar</a>.</p>
                    </form>
                </div>
            </div>
            <div class="col-lg-8 d-none d-md-block">
                <!-- Image-->
                <div class="bg-cover h-100 mr-n3" style="background-image: url({{ asset('img/gallery/bg-auth.png') }});background-size: cover !important;"></div>
            </div>
        </div>
    </div>
@endsection
