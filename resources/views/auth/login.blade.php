@extends('layouts.login')

@section('content')
    <div class="container-fluid px-0">
        <div class="row min-vh-100 gx-0">
            <div class="col-lg-4 px-4 px-lg-5 d-flex align-items-center position-relative">
                <div class="w-100 py-5">
                    <div class="text-center"><img class="img-fluid mb-4" src={{ asset('img/logos/logo.png') }} alt="logo-ocatec" style="max-width: 13rem;">

                    </div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Login</label>
                            <input class="form-control @error('email') is-invalid @enderror" name="email" id="email" type="text" placeholder="email de acesso" value="{{ old('email') }}">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <div class="row mb-2">
                                <div class="col">
                                    <label class="form-label mb-0">Senha</label>
                                </div>
                                @if (Route::has('password.request'))
                                    <div class="col-auto"><a  style="color: orange;font-size: 14px;" class="form-text small " href="{{ route('password.request') }}">Recuperar a senha</a></div>
                                @endif
                            </div>
                            <div class="input-group mb-2">
                                <input class="form-control @error('password') is-invalid @enderror" id="password" type="password" name="password" required autocomplete="current-password"/>
                            </div>
                        </div>
                        <!-- Submit-->
                        <button type="submit" style="font-size:16px; background: #ee7336;border: 2px solid transparent !important;color: white;" class="btn btn-lg btn-primary mb-3 w-100">Entrar</button>
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
