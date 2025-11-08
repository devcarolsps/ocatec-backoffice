@extends('layouts.login')

@section('content')
    <div class="container-fluid px-0">
        <div class="row min-vh-100 gx-0">
            <div class="col-lg-4 px-4 px-lg-5 d-flex align-items-center position-relative">
                <div class="w-100 py-5">
                    <div class="text-center">
                        <img class="img-fluid mb-4" src="{{ asset('img/logos/logo.png') }}" alt="logo-ocatec"
                             style="max-width: 19rem;">
                    </div>

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="form-group">
                            <label for="email">Informe seu e-mail de acesso</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                   name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <br>
                        <button type="submit"
                                style="font-size:16px; background: #ee7336;border: 2px solid transparent !important;color: white;"
                                class="btn btn-lg btn-primary mb-3 w-100">Enviar Link
                        </button>

                        <!-- Link-->
                        <p class="text-xs text-muted text-center"><a href="/">Voltar</a>.</p>
                    </form>
                </div>
            </div>
            <div class="col-lg-8 d-none d-md-block">
                <!-- Image-->
                <div class="bg-cover h-100 mr-n3"
                     style="background-image: url({{ asset('img/gallery/bg-auth.png') }});background-size: cover !important;"></div>
            </div>
        </div>
    </div>
@endsection
