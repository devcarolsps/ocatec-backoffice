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
														<li class="breadcrumb-item active">Minhas Afiliações </li>
												</ol>
												<form class="d-flex">
														<div class="input-group">
														</div>
														<a href="javascript: void(0);" title="Filtro" class="btn btn-outline-warning ms-2" 	id="btnShowFilter"> <i class="mdi mdi-filter"></i></a>
														<a href="javascript: void(0);" title="Atualizar Tela" class="btn btn-outline-secondary ms-2" 	id="btnAtualizarTela">	<i class="mdi mdi-autorenew"></i></a>
												</form>
										</div>
										<h4 class="page-title">Minhas Afiliações </h4>
										<p>Nesta página ficam os Empreendimentos que vc se afiliou, ou pedidos que você solicitou</p>
								</div>
						</div>
				</div>
				<br>




				<div class="col-xl-12 col-lg-12">
						<ul class="nav nav-pills bg-nav-pills nav-justified mb-3" id="myTabFull" role="tablist">
								<li class="nav-item">
										<a class="nav-link rounded-0 active" data-bs-toggle="tab" href="#empreendimentos" role="tab" id="empreendimentos"		aria-controls="empreendimentos" arial-expanded="false">Empreendimentos</a>
								</li>
								<li class="nav-item">
										<a class="nav-link" data-bs-toggle="tab" href="#empreendimentosPendentes" role="tab" 	id="empreendimentosPendentes" aria-controls="empreendimentosPendentes">Pedidos Enviados</a>
								</li>
						</ul>

						<div class="tab-content" id="tblAll">
								<div class="tab-pane active" id="empreendimentos">
												<div class="row" id="tabelaCarregando">
												<div class="col-12">
														<p>Estes são os Produtos aos quais você já é Afiliado(a). Visualize comissões e acesse links de divulgação, chamados OcaLinks</p>
														<div class="card">
																<div class="card-body">
																		<table class="table table-centered table-striped w-100 nowrap" id="tblCompleta">
																				<thead class="thead-light">
																				<tr>
																						<th>Foto</th>
																						<th>Empreendimento</th>
																						<th>Preço Máximo</th>
																						<th>Status</th>
																						<th>Link de divulgação</th>
																						<th>#</th>
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

								<div class="tab-pane" id="empreendimentosPendentes">
										<div class="row" id="tabelaCarregandoPendentes">
												<div class="col-12">
														<p>Estes são os Produtos aos quais você já é Afiliado(a). Visualize comissões e acesse links de divulgação, chamados OcaLinks</p>
														<div class="card">
																<div class="card-body">
																		<table class="table table-centered table-striped w-100 nowrap" id="tblCompleta">
																				<thead class="thead-light">
																				<tr>
																						<th>Foto</th>
																						<th>Empreendimento</th>
																						<th>Preço Máximo</th>
																						<th>Status</th>
																						<th>Link de divulgação</th>
																						<th>#</th>
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
						</div>

				</div>

				<div class="row" id="tblNada" style="display: none;">
						<div class="col-12">
								<div class="card">
										<div class="card-body">
												<h4 class="text-center">Sem hospedagens disponíveis no momento</h4>
										</div>
								</div>
						</div>
				</div>

		</div>

		@include('painel.empreendimentos.afiliacoes._partials.view')
		<!-- Scripts -->
		<script src="{{ asset('js/view/_scripts/empreendimentos/afiliacoes/index.js')}}"></script>
@endsection