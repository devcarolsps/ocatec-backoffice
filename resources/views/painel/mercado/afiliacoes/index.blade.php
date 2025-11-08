@extends('layouts.layout')

@section('content')

		<div class="container-fluid">
				<div class="row">
						<div class="col-12">
								<div class="page-title-box">
										<div class="page-title-right">'
												<ol class="breadcrumb m-0">
														<li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
														<li class="breadcrumb-item"><a href="javascript: void(0);">Mercado</a></li>
														<li class="breadcrumb-item active">Mercado de Afiliações</li>
												</ol>
										</div>
										<h4 class="page-title">Mercado de Afiliações</h4>

								</div>
						</div>
				</div>

				<div class="row">
						<div class="col-12">
								<div class="accordion custom-accordion" id="custom-accordion-one">
										<div class="card mb-0">
												<div class="card-header" id="headingFour" style="background-color: #00404f !important;">
														<h5 class="m-0">
																<a class="custom-accordion-title d-block py-1" style="color: white !important;" data-bs-toggle="collapse" href="#collapseFour" aria-expanded="true" aria-controls="collapseFour">	Filtro<i class="mdi mdi-chevron-down accordion-arrow"></i>
																</a>
														</h5>
												</div>

												<div id="collapseFour" class="collapse hide" aria-labelledby="headingFour"
																	data-parent="#custom-accordion-one">
														<div class="card-body">
																<form id="formFiltro">
																		<div class="row">
																				<div class="form-group col-md-4">
																						<label for="example-textarea">Vocação do Empreendimento</label>
																						<select name="selTpEmpreendimento" id="selTpEmpreendimento" class="form-select form-control-light mb-2">
																								<option value="">Escolha uma opção</option>
																								<option value="Residencial geral">Residencial geral</option>
																								<option value="Residencial geral">Residencial popular</option>
																								<option value="Residencial médio padrão">Residencial médio padrão</option>
																								<option value="Residencial alto padrão">Residencial alto padrão</option>
																								<option value="Comercial geral">Comercial geral</option>
																								<option value="Corporativo">Corporativo</option>
																								<option value="Hotelaria">Hotelaria</option>
																								<option value="Logística">Logística</option>
																						</select>
																				</div>
																				<div class="form-group col-md-4">
																						<label for="example-textarea">Localização</label>
																						<select name="selLocalizacao" id="selLocalizacao"	class="form-select form-control-light mb-2">
																								<option value="">Escolha uma opção</option>
																								<option value="São Paulo">São Paulo</option>
																								<option value="Rio de Janeiro">Rio de Janeiro</option>
																						</select>
																				</div>
																				<div class="form-group col-md-4">
																				</div>
																		</div>
																		<a title="Filtro"  class="btn btn-outline-warning" id="btnMoreFilter"> <i class="mdi mdi-filter">Mais Filtros</i></a>
																		<button type="button" class="btn btn-warning" id="btnFiltrar"><i class="mdi mdi-note-search">Pesquisar</i></button>
																</form>
														</div>
												</div>
										</div>
								</div>
						</div>
				</div>
				<br>

				<div id="tblPrincipal">

						<div class="row" id="tblDados" style="display: none;">
								<div class="col-12">
										<div class="card">
												<div class="card-body">
														<h3 class="card-title">
																Recomendados
																<p class="font-16">Empreendimentos selecionados especialmente para você</p>
														</h3>

														<div class="row" id="tblMercadoAfiliacoesRecomendados">
														</div>
														<nav>
																<ul class="pagination">
																		<li class="page-item">
																				<a class="page-link" href="javascript: void(0);" aria-label="Previous">
																						<span aria-hidden="true">&laquo;</span>
																				</a>
																		</li>
																		<li class="page-item"><a class="page-link" href="javascript: void(0);">1</a></li>
																		<li class="page-item"><a class="page-link" href="javascript: void(0);">2</a></li>
																		<li class="page-item"><a class="page-link" href="javascript: void(0);">3</a></li>
																		<li class="page-item"><a class="page-link" href="javascript: void(0);">4</a></li>
																		<li class="page-item"><a class="page-link" href="javascript: void(0);">5</a></li>
																		<li class="page-item">
																				<a class="page-link" href="javascript: void(0);" aria-label="Next">
																						<span aria-hidden="true">&raquo;</span>
																				</a>
																		</li>
																</ul>
														</nav>
												</div>
										</div>
								</div>
						</div>

						<div class="row" id="tblDadosRecentes" style="display: none;">
								<div class="col-12">
										<div class="card">
												<div class="card-body">
														<h3 class="card-title">Mais Recentes
																<p class="font-16">Empreendimentos que acabaram de chegar</p>
														</h3>
														<div class="row" id="tblMercadoAfiliacoesRecentes">
														</div>
														<nav>
																<ul class="pagination">
																		<li class="page-item">
																				<a class="page-link" href="javascript: void(0);" aria-label="Previous">
																						<span aria-hidden="true">&laquo;</span>
																				</a>
																		</li>
																		<li class="page-item"><a class="page-link" href="javascript: void(0);">1</a></li>
																		<li class="page-item"><a class="page-link" href="javascript: void(0);">2</a></li>
																		<li class="page-item"><a class="page-link" href="javascript: void(0);">3</a></li>
																		<li class="page-item"><a class="page-link" href="javascript: void(0);">4</a></li>
																		<li class="page-item"><a class="page-link" href="javascript: void(0);">5</a></li>
																		<li class="page-item">
																				<a class="page-link" href="javascript: void(0);" aria-label="Next">
																						<span aria-hidden="true">&raquo;</span>
																				</a>
																		</li>
																</ul>
														</nav>
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

		<!-- Modal's -->
		@include('painel.mercado.afiliacoes._partials.view')
		@include('painel.mercado.afiliacoes._partials.filter')
		@include('painel.mercado.afiliacoes._partials.afiliar')

		<!-- Scripts -->
		<script src="{{ asset('js/view/_scripts/mercado/afiliacoes/index.js')}}"></script>
@endsection