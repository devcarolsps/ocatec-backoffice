<div id="mdlResetPass" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fullWidthModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="fullWidthModalLabel">Nova Senha</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form id="frmNew">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12">
                            <div class="card d-block">
                                <div class="card-body">

                                    <div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }}">
                                        <label for="new-password" class="col-md-4 control-label">Senha Atual</label>

                                        <div class="col-md-12">
                                            <input id="current-password" type="password" class="form-control"
                                                   name="current-password" required>

                                            @if ($errors->has('current-password'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('current-password') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('new-password') ? ' has-error' : '' }}">
                                        <label for="new-password" class="col-md-12 control-label">Nova Senha</label>

                                        <div class="col-md-12">
                                            <input id="new-password" type="password" class="form-control"
                                                   name="new-password" required>

                                            @if ($errors->has('new-password'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('new-password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light btnFecharModal" data-bs-dismiss="modal" id="">Fechar
                    </button>
                    <button type="button" class="btn btn-primary" id="btnAlterarSenha">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
