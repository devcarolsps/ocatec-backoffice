<div id="mdlNew" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-full-width">
				<div class="modal-content">
						<div class="modal-header">
								<h4 class="modal-title" id="fullWidthModalLabel">Solicitar Atendimento</h4>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
						</div>
						<div class="modal-body">
								<div class="row">
												<input type="hidden" name="inpHospedagemIdGerado" id="inpHospedagemIdGerado">
{{--										<form id="frmNew">--}}
													<div class="col-xl-12 col-lg-12">
														<ul class="nav nav-pills bg-nav-pills nav-justified mb-3" id="myTabFull" role="tablist">
																<li class="nav-item">
																		<a class="nav-link rounded-0 active" data-bs-toggle="tab" href="#informacoes" role="tab"
																					aria-controls="informacoes" arial-expanded="false">Informações</a>
																</li>
																<li class="nav-item">
																		<a class="nav-link" data-bs-toggle="tab" href="#precificacao" role="tab"
																					aria-controls="precificacao">Precificação</a>
																</li>
																<li class="nav-item">
																		<a class="nav-link" data-bs-toggle="tab" href="#imagens" role="tab"
																					aria-controls="imagens">Fotos do Empreendimento</a>
																</li>
														</ul>

														<div class="tab-content">
																		<div class="tab-pane active" id="informacoes">
																				<form id="frmNewInformacoes">
																					<div class="row mt-2 mb-3">
																						<div class="col-xl-12 col-lg-12">
																								<div class="card">
																										<div class="card-body">
																												<div class="col-xl-12 col-lg-12">
																														<div class="row">
																																<div class="col-lg-4 mb-3">
																																		<p class="text-muted">
																																				<strong>Nome Empreendimento:</strong>
																																		</p>
																																		<input type="text" autocomplete="off" class="form-control" id="nome_empreendimento" name="nome_empreendimento" placeholder="Nome Empreendimento">
																																</div>
																																<div class="col-lg-4 mb-3">
																																		<p class="text-muted"><strong>Permitir Afiliação:</strong></p>
																																		<select class="form-select" name="permite_afiliacao"
																																										id="permite_afiliacao">
																																				<option value="0">Selecione uma opção</option>
																																				<option value="1">SIM</option>
																																				<option value="2">NÃO</option>
																																		</select>
																																</div>
																																<div class="col-lg-4 mb-3">
																																		<p class="text-muted"><strong>Tipo de
																																						Afiliação:</strong></p>
																																		<select class="form-select" name="tipo_afiliacao"
																																										id="tipo_afiliacao">
																																				<option value="0">Selecione uma opção</option>
																																				<option value="1">Afiliação por um clique</option>
																																				<option value="2">Afiliação por aprovação</option>
																																		</select>
																																</div>
																														</div>

																														<div class="row">
																																<div class="col-lg-4 mb-3">
																																		<p class="text-muted"><strong>Regra de
																																						Comissionamento:</strong></p>
																																		<select class="form-select" name="regra_comissionamento"
																																										id="regra_comissionamento">
																																				<option value="0">Selecione uma opção</option>
																																				<option value="1">Última indicação</option>
																																				<option value="2">Primeira indicação</option>
																																				<option value="3">Multi indicação</option>
																																		</select>
																																</div>

																																<div class="col-lg-4 mb-3">
																																		<p class="text-muted"><strong>Região para
																																						comercialização:</strong></p>
																																		<select class="form-select"
																																										name="regiao_comercializacao"
																																										id="regiao_comercializacao">
																																				<option value="AC">Acre</option>
																																				<option value="AL">Alagoas</option>
																																				<option value="AP">Amapá</option>
																																				<option value="AM">Amazonas</option>
																																				<option value="BA">Bahia</option>
																																				<option value="CE">Ceará</option>
																																				<option value="DF">Distrito Federal</option>
																																				<option value="ES">Espírito Santo</option>
																																				<option value="GO">Goiás</option>
																																				<option value="MA">Maranhão</option>
																																				<option value="MT">Mato Grosso</option>
																																				<option value="MS">Mato Grosso do Sul</option>
																																				<option value="MG">Minas Gerais</option>
																																				<option value="PA">Pará</option>
																																				<option value="PB">Paraíba</option>
																																				<option value="PR">Paraná</option>
																																				<option value="PE">Pernambuco</option>
																																				<option value="PI">Piauí</option>
																																				<option value="RJ">Rio de Janeiro</option>
																																				<option value="RN">Rio Grande do Norte</option>
																																				<option value="RS">Rio Grande do Sul</option>
																																				<option value="RO">Rondônia</option>
																																				<option value="RR">Roraima</option>
																																				<option value="SC">Santa Catarina</option>
																																				<option value="SP">São Paulo</option>
																																				<option value="SE">Sergipe</option>
																																				<option value="TO">Tocantins</option>
																																		</select>
																																</div>

																														</div>
																												</div>

																												<div class="row">
																														<div class="col-lg-12 mb-3">
																																<p class="text-muted"><strong>Regras para
																																				Afiliação:</strong></p>
																																<textarea class="form-control" name="regra_afiliacao"
																																										id="regra_afiliacao" rows="5"></textarea>
																														</div>
																												</div>
																										</div>r
																								</div>
																						</div>

																				</div>
																				</form>

																		</div>

																		<div class="tab-pane" id="precificacao">
																				<form id="frmNewPrecificacao">
																						<div class="row mt-2 mb-3">
																									<div class="col-xl-12 col-lg-12">
																										<div class="card">
																												<div class="card-body">
																														<div class="col-xl-12 col-lg-12">
																																<div class="row">
																																		<div class="col-lg-6 mb-3">
																																				<p class="text-muted">
																																						<strong>Comissionamento Total</strong>
																																				</p>
																																				<input type="text" autocomplete="off" class="form-control"
																																											id="comissao_total" name="comissao_total" value="0">
																																		</div>
																																		<div class="col-lg-6 mb-3">
																																				<p class="text-muted">
																																						<strong>Comissionamento Oca</strong>
																																				</p>
																																				<input type="text" autocomplete="off" 	class="form-control" id="comissao_oca" 	name="comissao_oca" value="0">
																																		</div>

																																		<div class="col-lg-6 mb-3">

																																				<p class="text-muted">
																																						<strong>Comissionamento Afiliado</strong>
																																				</p>

																																				<div class="row g-2">
																																						<div class="col-sm-6">
																																								<label class="form-label">Primeira Indicação</label>
																																								<input class="form-control" type="text" id="primeira_indicacao" name="primeira_indicacao" value="0">
																																						</div>
																																						<div class="col-sm-6">
																																								<label for="formFileMultiple" class="form-label">Segunda Indicação</label>
																																								<input class="form-control" type="text" id="segunda_indicacao" name="segunda_indicacao" value="0">
																																						</div>
																																				</div>

																																		</div>
																																</div>
																														</div>


																														<div class="col-xl-12 col-lg-12">
																																<div class="row">
																																		<div class="col-lg-4 mb-3">
																																				<p class="text-muted">
																																						<strong>Periodo de Carência</strong>
																																				</p>
																																				<input type="number" autocomplete="off" class="form-control"  value="1"			id="periodo_carencia" name="periodo_carencia">
																																				<span class="help-block">
																																						<small>Nesta campo você definirá os dias que o incorporador quando receber uma indicação de algum empreendimento através da plataforma OCATEC, ficará impossibilitado de receber de outro afiliado a mesma indicação do mesmo empreendimento.
																																						Após este período ficará valendo a regra de comissionamento definida, reiniciando os dias após outra indicação.
																																						Esta opção garante exclusividade por um tempo ao afiliado que fez a indicação.
																																						</small>
																																		</span>
																																		</div>
																																</div>
																														</div>

																												</div>
																										</div>
																								</div>
																						</div>
																				</form>

																		</div>

																<div class="tab-pane" id="imagens">
																		<div class="mt-2 mb-3">
																				<div class="alert alert-warning bg-warning text-white border-0" role="alert">
																						<strong>Atenção - </strong> Apenas com os documentos cadastrados você conseguirá
																						ser um afiliado
																				</div>
																		</div>
																		<div class="col-md-12">
																				<!-- File Upload -->
																				<form  class="dropzone" id="myAwesomeDropzone">
																						<div class="fallback">
																								<input name="file" type="file" />
																						</div>

																						<div class="dz-message needsclick">
																								<i class="h1 text-muted dripicons-cloud-upload"></i>
																								<h3>Clique ou arraste o arquivo para esta área para fazer o upload.</h3>
																						</div>
																				</form>

																		</div>
																</div>

														</div>
												</div>
{{--										</form>--}}
								</div>
						</div>
						<div class="modal-footer">
								<button type="button" class="btn btn-light btnFecharModal" data-bs-dismiss="modal" id="">Fechar</button>
								<button type="button" class="btn btn-primary" id="btnCadastrar">Cadastrar</button>
						</div>
				</div>
		</div>


</div>

