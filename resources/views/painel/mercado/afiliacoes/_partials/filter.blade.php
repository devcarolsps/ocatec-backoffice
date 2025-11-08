<div id="mdlFilter" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="txtMoreFilter" aria-hidden="true">
		<div class="modal-dialog">
				<div class="modal-content">
						<div class="modal-header">
								<h4 class="modal-title" id="txtMoreFilter">Mais Filtros</h4>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
						</div>
						<div class="modal-body">
								<form id="formMoreFiltro">
										<div class="row">
												<div class="form-group col-md-6">
														<label for="example-textarea">Tipo de Afiliação</label>
														<select name="selTpAfiliacao" id="selTpAfiliacao" class="form-select form-control-light mb-2">
																<option value="">Escolha uma opção</option>
																<option value="1">Afiliação com um clique</option>
																<option value="2">Afiliação por aprovação</option>
														</select>
												</div>
												<div class="form-group col-md-6">
														<label for="example-textarea">% Comissão</label>
														<select name="selLocalizacao" id="selLocalizacao"	class="form-select form-control-light mb-2">
																<option value="">Escolha uma opção</option>
																<option value="0_1">0% a 1%</option>
																<option value="1_2">1% a 2%</option>
																<option value="2_3">2% a 3%</option>
																<option value="3_4">3% a 4%</option>
																<option value="4_5">4% a 5%</option>
																<option value="5_6">5% a 6%</option>
																<option value="acima_6">Acima de 6%</option>
														</select>
												</div>
												<div class="form-group col-md-6">
														<label for="example-textarea">Regra de comissionamento</label>
														<select name="selLocalizacao" id="selLocalizacao"	class="form-select form-control-light mb-2">
																<option value="">Escolha uma opção</option>
																<option value="ultima_indicacao">Última indicação</option>
																<option value="primeira_indicacao">Primeira indicação</option>
																<option value="multipla_indicacao">Múltipla indicação</option>
														</select>
												</div>
												<div class="form-group col-md-6">
														<label for="example-textarea">Preço</label>
														<select name="selLocalizacao" id="selLocalizacao"	class="form-select form-control-light mb-2">
																<option value="">Escolha uma opção</option>
																<option value="0_500">0 á 500 mil</option>
																<option value="500_1">500 á 1 mil</option>
																<option value="1_5">1mil á 5 mil</option>
																<option value="5_10">5 mil á 10 mil</option>
																<option value="10_50">10 mil á 50 mil</option>
																<option value="acima_500">Acima de 50 mi</option>
														</select>
												</div>
										</div>
								</form>

						</div>
						<div class="modal-footer">
								<button type="button" class="btn btn-light btnFecharModal" data-bs-dismiss="modal" id="">Fechar</button>
								<button type="button" class="btn btn-warning" id="btnFiltrar"><i class="mdi mdi-note-search">Pesquisar</i></button>
						</div>
				</div>
		</div>
</div>

