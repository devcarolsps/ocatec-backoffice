@extends('layouts.layout')

@section('content')

		<div class="container-fluid">
				<div class="row">
						<div class="col-12">
								<div class="page-title-box">
										<div class="page-title-right">'
												<ol class="breadcrumb m-0">
														<li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
														<li class="breadcrumb-item"><a href="javascript: void(0);">Empreendimentos</a></li>
														<li class="breadcrumb-item active">Hospedagens</li>
												</ol>
												<form class="d-flex">
														<div class="input-group">
														</div>
														<a href="javascript: void(0);" title="Filtro" class="btn btn-outline-warning ms-2" 	id="btnShowFilter"> <i class="mdi mdi-filter"></i></a>
														<a href="javascript: void(0);" title="Atualizar Tela" class="btn btn-outline-secondary ms-2" 	id="btnAtualizarTela">	<i class="mdi mdi-autorenew"></i></a>
												</form>
										</div>
										<h4 class="page-title">Hospedagens</h4>

										<div class="col-md-12 mb-3">
												<div class="mb-12">
														<a class="btn btn-outline-primary" id="btnNew">
																<i class="mdi mdi-plus mr-1"></i> Novo Terreno
														</a>
												</div>
										</div>
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
																				<th>Informações</th>
																				<th>Caracteristicas</th>
																		</tr>
																</thead>
																<tbody>
																</tbody>
														</table>
										</div>
								</div>
						</div>
				</div>


		</div>

		<!-- Modal's -->
		@include('painel.empreendimentos.hospedagens._partials.create')
		@include('painel.empreendimentos.hospedagens._partials.edit')

		<!-- Scripts -->
		<script src="{{ asset('js/view/_scripts/empreendimentos/hospedagens/index.js')}}"></script>
@endsection