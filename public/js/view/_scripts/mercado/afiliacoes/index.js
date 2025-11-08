$(document).ready(function () {
    // ----- VARIAVEIS -----
    let tblMercadoAfiliacoesRecomendados = $('#tblMercadoAfiliacoesRecomendados');
    let tblMercadoAfiliacoesRecentes = $('#tblMercadoAfiliacoesRecentes');


    // ----- BOTOES -----
    let btnMoreFilter = $("#btnMoreFilter");
    let btnFiltrar = $("#btnFiltrar");
    let btnSolicitarAfiliacao = $("#btnSolicitarAfiliacao");
    let btnCadastrarAfiliacao = $("#btnCadastrarAfiliacao");
    let btnView = "btnView";


    // ----- PAGE ON LOAD -----
    $("#tblNada").hide();
    $("#tblDados").hide();
    carregaTabelaRecomendados();
    carregaTabelaRecentes();


    function carregaTabelaRecomendados(){
        try
        {
            let request;
            request = $.ajax({
                url: "/mercado/empreendimentos/tabela/1",
                contentType: 'application/json',
                cache: false,
                method: 'GET',
                processing: false,
                serverSide: false,
                beforeSend: function() {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Aguarde!',
                        html: 'Carregando Informações',
                        allowOutsideClick: false,
                        showCancelButton: false,
                        showConfirmButton: false,
                        onBeforeOpen: () => {
                            Swal.showLoading()
                        },
                    });

                },
            });

            request.done(function (response, textStatus, jqXHR) {
                // Mensagem de sucesso
                if(response["status"] === "error"){
                    toastr["error"](response["message"], "Erro do Servidor");
                }
                else if(response["status"] === "exception"){
                    toastr["error"](response["message"], "Erro do Servidor");
                }
                else {
                    if(response === ''){
                        $("#tblNada").show();
                        $("#tblDados").hide();
                    }else{
                        $("#tblDados").show();
                        tblMercadoAfiliacoesRecomendados.html(response)
                    }

                }
            });

            request.fail(function (jqXHR, textStatus, errorThrown) {
                toastr["error"](textStatus + ": " + errorThrown, "Houve um erro na requisição");
            });

            request.always(function () {
                Swal.close();
            });
        }
        catch (ex)
        {
            console.log(JSON.stringify(ex));
        }
    }

    function carregaTabelaRecentes(){
        try
        {
            let request;
            request = $.ajax({
                url: "/mercado/empreendimentos/tabela/2",
                contentType: 'application/json',
                cache: false,
                method: 'GET',
                processing: false,
                serverSide: false,
                beforeSend: function() {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Aguarde!',
                        html: 'Carregando Informações',
                        allowOutsideClick: false,
                        showCancelButton: false,
                        showConfirmButton: false,
                        onBeforeOpen: () => {
                            Swal.showLoading()
                        },
                    });

                },
            });

            request.done(function (response, textStatus, jqXHR) {
                // Mensagem de sucesso
                if(response["status"] === "error"){
                    toastr["error"](response["message"], "Erro do Servidor");
                }
                else if(response["status"] === "exception"){
                    toastr["error"](response["message"], "Erro do Servidor");
                }
                else {
                    if(response === ''){
                        $("#tblNada").show();
                        $("#tblDadosRecentes").hide();
                    }else{
                        $("#tblDadosRecentes").show();
                        tblMercadoAfiliacoesRecentes.html(response)
                    }

                }
            });

            request.fail(function (jqXHR, textStatus, errorThrown) {
                toastr["error"](textStatus + ": " + errorThrown, "Houve um erro na requisição");
            });

            request.always(function () {
                Swal.close();
            });
        }
        catch (ex)
        {
            console.log(JSON.stringify(ex));
        }
    }

    function show(id, mdlAfiliar = false) {
        let request;
        jQuery.support.cors = true;

        // Enviando AJAX
        request = $.ajax({
            url: "/empreendimentos/hospedagens/"+id,
            contentType: 'application/json',
            cache: false,
            method: 'GET',
            crossDomain: true,
            dataType: 'json',
            beforeSend: function() {
                Swal.fire({
                    icon: 'warning',
                    title: 'Aguarde!',
                    html: 'Buscando Informações',
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
        request.done(function (response, textStatus, jqXHR) {
            // Mensagem de sucesso
            if(response["status"] === "error"){
                toastr["error"](response["message"], "Erro do Servidor");
            }
            else if(response["status"] === "exception"){
                toastr["error"](response["message"], "Erro do Servidor");
            }
            else {
                if(response.data){
                    if(mdlAfiliar){
                        console.log("Mdl afiliar")
                    }else{
                        $("#imgHospedagem").attr('src' , response.data.imagem);
                        $("#txtRegraAfiliacao").html(response.data.regra_afiliacao);
                        $("#txtLocalizacao").html('Localização: ' + response.data.regiao_comercializacao);
                        $("#badgeLocalizacao").html(response.data.regiao_comercializacao);
                        $("#txtStatus").html(response.data.status);
                        $("#txtCodigo").html('Código: ' + response.data.codigo);
                        $("#txtComissao").html('R$ ' + response.data.comissao_total);
                        $("#txtPrecoMax").html('R$ ' + response.data.preco_max);
                        $("#txtNomeEmpreendimento").html(response.data.nome_empreendimento);
                        $("#txtCaracteristicaDescricao").html(response.data.caracteristica_descricao);
                        $("#txtTempoPlataforma").html('Tempo na plataforma: ' + response.data.dias_cadastro + ' dias');
                    }
                }
            }
        });

        // Caso falha
        request.fail(function (jqXHR, textStatus, errorThrown) {
            // Exibe o erro
            toastr["error"](textStatus + ": " + errorThrown, "Houve um erro na requisição");
        });

        // Sempre executa, seja falha ou sucesso
        request.always(function () {
            Swal.close();
        });
    }

    function cadastrarAfiliado(hospedagem_id){
        let request;
        jQuery.support.cors = true;
        let postData = {
            'hospedagem_id': hospedagem_id
        }
        // Enviando AJAX
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        request = $.ajax({
            url: "/mercado/empreendimentos/afiliar",
            contentType: 'application/json',
            method: 'POST',
            dataType: 'json',
            data: JSON.stringify(postData),
            beforeSend: function() {
                Swal.fire({
                    icon: 'warning',
                    title: 'Aguarde!',
                    html: 'Cadastrando Informações',
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
        request.done(function (response, textStatus, jqXHR) {
            // Mensagem de sucesso
            if(response["status"] === "error"){
                toastr["error"](response["message"], "Erro do Servidor");
            }
            else if(response["status"] === "exception"){
                toastr["error"](response["message"], "Erro do Servidor");
            }
            else {
                toastr["success"]('Agora você é um afiliado!!', "Agora você é um afiliado!!");
            }
        });

        // Caso falha
        request.fail(function (jqXHR, textStatus, errorThrown) {
             toastr["error"](jqXHR.responseJSON.message, "Houve um erro na requisição");
        });

        // Sempre executa, seja falha ou sucesso
        request.always(function () {
            Swal.close();
            $("#mdlAfiliar").modal('hide');
        });

    }

    btnMoreFilter.unbind().click(function(event) {
        event.stopPropagation();
        event.preventDefault();

        $("#mdlFilter").modal("show")

    });

    $("#tblPrincipal").on('click', '.' + btnView, function(event){
        event.stopPropagation();
        event.preventDefault();

        $("#mdlView").modal("show")
        let hospedagem_id = $(this).attr("data-id");
        $("#inpHospedagemId").val(hospedagem_id)
        show(hospedagem_id)

    });

    btnSolicitarAfiliacao.unbind().click(function(event) {
        event.stopPropagation();
        event.preventDefault();

        $("#mdlAfiliar").modal("show")
        let hospedagem_id = $("#inpHospedagemId").val();
        show(hospedagem_id, true)

    });


    btnCadastrarAfiliacao.unbind().click(function(event) {
        event.stopPropagation();
        event.preventDefault();
        let hospedagem_id =  $("#inpHospedagemId").val();

        if($('#checkbox-signup:checked').val() !== '1'){
            return Swal.fire("Alerta!" , "Você precisa aceitar os Termos para continuar", 'warning');
        }

        Swal.fire({
            title: 'Você confirma que deseja realizar essa solicitaçao ?',
            showDenyButton: true,
            confirmButtonText: 'Prosseguir',
            denyButtonText: `Cancelar`,
            icon: "warning"
        }).then((result) => {
            if (result.isConfirmed) {
                cadastrarAfiliado(hospedagem_id);
            } else if (result.isDenied) {
                Swal.fire('Solicitação cancelada', '', 'info')
            }
        })
    });


});