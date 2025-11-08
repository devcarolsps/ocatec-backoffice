<div id="mdlView" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-full-width">
				<div class="modal-content">
						<div class="modal-header">
								<h4 class="modal-title" id="fullWidthModalLabel">Detalhes do Empreendimento</h4>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
						</div>
						<div class="modal-body">
								<input type="text" name="inpHospedagemId" id="inpHospedagemId">
								<div class="row">
										<div class="col-xl-4 col-lg-5">
												<div class="card text-center">
														<div class="card-body">
																<img  id="imgHospedagem" class="img-thumbnail" alt="Imagem da Hospedagem" style="height: 510px;    width: 988px;">

																<button type="button" class="btn btn-outline-info btn-sm mb-2">Comissão por Ultima apresentação</button>
																<button type="button" class="btn btn-outline-info btn-sm mb-2">Afiliação por aprovação</button>
																<button type="button" class="btn btn-outline-info btn-sm mb-2">Afiliação Nacional</button>
																<button type="button" class="btn btn-outline-info btn-sm mb-2" id="badgeLocalizacao"></button>

																<div class="text-start mt-3">
																		<h4 class="font-13 text-uppercase">Regras de Afiliação</h4>
																		<p class="text-muted font-13 mb-3" style="text-align: justify;" id="txtRegraAfiliacao">
																		</p>
																</div>

																<ul class="social-list list-inline mt-3 mb-0">
																		<li class="list-inline-item">
																				<button type="button" class="btn btn-outline-warning btn-sm pe-2 text-nowrap mb-2 d-inline-block"><i class="mdi mdi-star text-muted"></i></button>
																		</li>
																		<li class="list-inline-item">
																				<button type="button" class="btn btn-outline-danger btn-sm pe-2 text-nowrap mb-2 d-inline-block"><i class="mdi mdi-fire text-muted"></i></button>
																		</li>
																		<li class="list-inline-item">
																				<button type="button" class="btn btn-outline-info btn-sm pe-2 text-nowrap mb-2 d-inline-block"><i class="mdi mdi-file-word text-muted"></i></button>
																		</li>
																</ul>
														</div>
												</div>
										</div>

										<div class="col-xl-8 col-lg-7">
												<div class="card">
														<div class="card-body">
																<ul class="nav nav-pills bg-nav-pills nav-justified mb-3" role="tablist">
																		<li class="nav-item" role="presentation">
																				<a href="#aboutme" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0 active" aria-selected="false" role="tab" tabindex="-1">
																						Empreendimento
																				</a>
																		</li>
																</ul>
																<div class="tab-content">
																		<div class="tab-pane active show" id="aboutme" role="tabpanel">

																				<div class="row">
																							<div class="col-xl-4 col-lg-5">
																									<h5 class="text-uppercase"><i class="mdi mdi-briefcase me-1"></i> Sobre o Corretor</h5>
																										<div class="card text-center">
																												<div class="card-body">
																														<img src="{{ asset('storage/logos/'.Auth::user()->logo) ?? asset('img/logos/sua-foto.png') }}" class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">

																														<h4 class="mb-0 mt-2">{{ Auth::user()->name }}</h4>
																														<p class="text-muted font-14">Ocatec desde: {{ Auth::user()->created_at->format('Y') }}</p>
																														<ul class="social-list list-inline mt-3 mb-0">
																																<li class="list-inline-item">
																																		<div class="flex-shrink-0">
																																				<div class="avatar-sm rounded">
																																								<span class="avatar-title border border-primary rounded-circle h3 my-0">
																																												<i class="mdi mdi-flag-checkered"></i>
																																								</span>
																																				</div>
																																		</div>
																																</li>
																																<li class="list-inline-item">
																																		<div class="flex-shrink-0">
																																				<div class="avatar-sm rounded">
																																								<span class="avatar-title border border-primary rounded-circle h3 my-0">
																																												<i class="mdi mdi-flag-checkered"></i>
																																								</span>
																																				</div>
																																		</div>
																																</li>
																																<li class="list-inline-item">
																																		<div class="flex-shrink-0">
																																				<div class="avatar-sm rounded">
																																								<span class="avatar-title border border-primary rounded-circle h3 my-0">
																																												<i class="mdi mdi-flag-checkered"></i>
																																								</span>
																																				</div>
																																		</div>
																																</li>
																																<li class="list-inline-item">
																																		<div class="flex-shrink-0">
																																				<div class="avatar-sm rounded">
																																								<span class="avatar-title border border-primary rounded-circle h3 my-0">
																																												<i class="mdi mdi-flag-checkered"></i>
																																								</span>
																																				</div>
																																		</div>
																																</li>
																														</ul>
																												</div>
																										</div>

																							</div>

																							<div class="col-xl-8 col-lg-7">
																								<h5 class="text-uppercase"><i class="mdi mdi-briefcase me-1"></i> Sobre o Produto</h5>
																								<div class="card text-center">
																										<div class="card-body">
																												<div class="row">
																														<div class="col-lg-12">
																																<h4 id="txtStatus"></h4>
																																<p class="font-13" id="txtCodigo"></p>

																																<ul class="mb-0 list-inline">
																																		<li class="list-inline-item me-3">
																																				<h5 class="mb-1">Preço Máximo</h5>
																																				<span class="font-20 text-success fw-bold" id="txtPrecoMax"></span>
																																		</li>
																																		<li class="list-inline-item">
																																				<h5 class="mb-1">Comissão de até</h5>
																																				<span class="font-20 text-success fw-bold" id="txtComissao"></span>
																																		</li>
																																</ul>
																														</div>
																														<div class="col-lg-12">
																																<div class="d-grid">
																																		<a style="cursor: pointer;" id="btnSolicitarAfiliacao" class="btn btn-success btn-sm">Solicitar afiliação</a>
																																</div>
																														</div>

																														<div class="col-lg-12">
																																<h4 class="mb-0 mt-2" id="txtNomeEmpreendimento"></h4>
																																<p class="text-muted font-14" style="text-align: justify; " id="txtCaracteristicaDescricao">

																																</p>
																														</div>
																														<div class="col-lg-6" style="text-align: justify;">
																																<h4 class="mb-0 mt-2">Características</h4>

																																<h5 class="mt-2 mb-2">
																																		<a href="#" data-bs-toggle="modal" data-bs-target="#task-detail-modal" class="text-body" id="txtLocalizacao" ></a>
																																</h5>
																																<h5 class="mt-2 mb-2">
																																		<a href="#" data-bs-toggle="modal" data-bs-target="#task-detail-modal" class="text-body">Potencial para o mercado: 26%</a>
																																</h5>
																																<h5 class="mt-2 mb-2">
																																		<a href="#" data-bs-toggle="modal" data-bs-target="#task-detail-modal" class="text-body" id="txtTempoPlataforma"></a>
																																</h5>
																														</div>

																														<div class="col-lg-12">
																																<div class="d-grid">
																																		<a style="cursor: pointer;" type="button" class="btn btn-info ">ACESSO AO ESTUDO COMPLETO <i class="text-white mdi mdi-arrow-top-right-bold-box-outline font-22"></i></a>
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
										</div>
								</div>
						</div>
						<div class="modal-footer">
								<button type="button" class="btn btn-light btnFecharModal" data-bs-dismiss="modal" id="">Fechar</button>
						</div>
				</div>
		</div>


</div>

