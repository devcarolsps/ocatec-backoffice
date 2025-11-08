@extends('layouts.layout')
@section('content')
    <!--suppress JSJQueryEfficiency -->
    <style>
        .profile-user-img {
            width: 125px;
            box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
        }

        .avatar-upload {
            position: relative;
            max-width: 205px;
            margin: auto;
            margin-bottom: 20px;
        }

        .avatar-upload .avatar-edit {
            position: absolute;
            right: 40px;
            z-index: 1;
            top: 90px;
        }

        .avatar-upload .avatar-edit input {
            display: none;
        }

        .avatar-upload .avatar-edit input + label {
            display: inline-block;
            width: 34px;
            height: 34px;
            margin-bottom: 0;
            border-radius: 100%;
            background: #FFFFFF;
            border: 1px solid #d2d6de;
            box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
            cursor: pointer;
            font-weight: normal;
            transition: all 0.2s ease-in-out;
        }

        .avatar-upload .avatar-edit input + label:hover {
            background: #f1f1f1;
            border-color: #d6d6d6;
        }

        .avatar-upload .avatar-edit input + label:after {
            content: "\f0100";
            font-family: "Material Design Icons", serif;
            color: #ee7336;
            position: absolute;
            left: 0;
            right: 0;
            text-align: center;
            line-height: 34px;
            margin: auto;
        }
    </style>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Perfil</a></li>
                            <li class="breadcrumb-item active">Editar Perfil</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Editar Perfil</h4>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-12 col-lg-12">
                        <ul class="nav nav-pills bg-nav-pills nav-justified mb-3" id="myTabFull" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link rounded-0 active" data-bs-toggle="tab" href="#perfil" role="tab"
                                   aria-controls="perfil" arial-expanded="false">Dados Pessoais</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane active" id="perfil">
                                <div class="row mt-2 mb-3">
                                    <div class="col-xl-12 col-lg-12">
                                        <div class="card text-center">
                                            <div class="card-body">
                                                <form action="{{ url("/perfil/update") }}" method="POST">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-xl-12 col-lg-12">
                                                            <div class="card">
                                                                <div class="card-body profile-user-box">
                                                                    <div class="row">
                                                                        <div class="col-lg-12">
                                                                            <div class="media">
                                                                                <span class="float-left m-2 mr-4">
                                                                                     <div class="avatar-upload">
                                                                                        <div class="avatar-edit">
                                                                                            <input type='file'
                                                                                                   id="imageUpload"
                                                                                                   accept=".png, .jpg, .jpeg"/>
                                                                                            <label  for="imageUpload"></label>
                                                                                        </div>
                                                                                        <div class="avatar-preview">
                                                                                          <img
                                                                                              class="profile-user-img img-responsive img-circle"
                                                                                              id="imagePreview"
                                                                                              src="{{ isset($dados->logo) ?  asset('storage/logos/'.$dados->logo) : asset('img/logos/sua-foto.png') }}"
                                                                                              alt="Logo Usuario">
                                                                                        </div>
                                                                                     </div>
                                                                                </span>
                                                                                <div class="media-body">
                                                                                    <h4 class="my-1"
                                                                                        id="txtNome">{{ $dados->name ?? '' }}</h4>
                                                                                    <p class="font-13 text-muted"
                                                                                       id="txtEmail">{{ $dados->email ?? '' }}</p>
                                                                                    <p class="font-13 text-muted"
                                                                                       id="txtDocumento">{{ $dados->telefone ?? '' }}</p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <div class="text-left">
                                                                        <p class="text-muted"><strong>Nome Completo      (Pessoa Física):</strong>
                                                                            <span class="ml-2">
                                                                                <input type="text" value="{{ $dados->name ?? '' }}"  name="name" class="form-control">
                                                                            </span>
                                                                        </p>

                                                                        <p class="text-muted"><strong>E-mail :</strong>
                                                                            <span class="ml-2">
                                                                                <input type="text"   value="{{ $dados->email ?? '' }}"  name="email"   class="form-control">
                                                                            </span>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="mb-12">
                                                            <button class="btn btn-outline-primary"  type="submit">
                                                                <i class="mdi mdi-plus mr-1"></i> Salvar
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @include('painel.perfil._partials.reset-password')

    <script>
        $(document).ready(function () {
            $('.cepClass').mask('00000-000');

            $("#imageUpload").change(function (data) {
                let imageFile = data.target.files[0];
                let reader = new FileReader();
                reader.readAsDataURL(imageFile);

                reader.onload = function (evt) {
                    $('#imagePreview').attr('src', evt.target.result);
                    $('#imagePreview').hide();
                    $('#imagePreview').fadeIn(650);
                }

                uploadArquivo(imageFile)
            });
        });

        function uploadArquivo(file) {
            let form_data = new FormData();
            form_data.append('file', file);
            let request = $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('[name="_token"]').val()
                },
                url: "{{ route('upload.logo') }}",
                contentType: false,
                cache: false,
                method: 'POST',
                crossDomain: true,
                processData: false,
                data: form_data
            });

            // Caso sucesso
            request.done(function (response, jqXHR, code) {
                toastr["success"](response.message, "Logo Adicionada com sucesso");
            });

            // Caso falha
            request.fail(function (jqXHR, textStatus, errorThrown) {
                toastr["error"](jqXHR.responseJSON.message);
            });
        }

        $("#btnOpenResetPass").unbind().click(function (event) {
            event.stopPropagation();
            event.preventDefault();
            $("#mdlResetPass").modal("show");
        });

        $("#btnAlterarSenha").unbind().click(function (event) {
            event.stopPropagation();
            event.preventDefault();
            let campos = {
                'current-password': $("#current-password").val(),
                'new-password': $("#new-password").val(),
            };

            // Enviando AJAX
            let request = $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('[name="_token"]').val()
                },
                url: "{{ route('perfil.change-password') }}",
                contentType: 'application/json',
                cache: false,
                method: 'POST',
                crossDomain: true,
                dataType: 'json',
                data: JSON.stringify(campos),
                beforeSend: function() {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Aguarde!',
                        html: 'Atualizando a senha..',
                        allowOutsideClick: false,
                        showCancelButton: false,
                        showConfirmButton: false,
                        onBeforeOpen: () => {
                            Swal.showLoading()
                        },
                    });

                },
            });

            // Caso sucesso
            request.done(function (response, jqXHR, code) {
                toastr["success"](response.message, "Faça login novamente");
                $("#password").val('');
            });

            // Caso falha
            request.fail(function (jqXHR, textStatus, errorThrown) {
                // Exibe o erro
                toastr["error"](jqXHR.responseJSON.message);
            });

            request.always(function () {
                Swal.close();
            });
        });


        $("#btnClosedAccount").unbind().click(function (event) {
            event.stopPropagation();
            event.preventDefault();

            Swal.fire({
                title: "Você tem certeza que deseja encerrar sua conta ?",
                icon: "warning",
                showDenyButton: true,
                confirmButtonText: 'Sim, tenho certeza!',
                denyButtonText: `Não, Cancelar!`,
            }).then((result) => {
                if (result.isConfirmed) {
                    messageSwal("OK", "Operação finalizada", "success")

                } else if (result.isDenied) {
                    messageSwal("Cancelado", "Operação cancelada", "error")
                }
            })

        });


        function messageSwal(text, message, icon) {
            Swal.fire(
                text,
                message,
                icon
            )
        }

    </script>

@endsection
