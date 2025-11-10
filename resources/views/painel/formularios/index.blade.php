@extends('layouts.layout')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Formulários</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Formulário Site</h4>
                </div>
            </div>
        </div>

        <div class="row" id="tabelaCarregando">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-centered table-striped w-100 nowrap" id="tblCompleta">
                            <thead class="thead-light">
                            <tr>
                                <th>OCA ID</th>
                                <th>Nome Completo</th>
                                <th>Telefone</th>
                                <th>E-mail</th>
                                <th>Categoria</th>
                                <th>Endereço</th>
                                <th>Metragem</th>
                                <th>Observações</th>
                                <th>Data</th>
                                <th>Ação</th>
                            </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/view/_scripts/formularios/index.js') }}?v={{ time() }}"></script>

@endsection
