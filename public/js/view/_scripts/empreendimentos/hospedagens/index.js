$(document).ready(function () {
    // ----- VARIAVEIS -----
    let tblCompleta = $('#tblCompleta');


    // ----- BOTOES -----
    let btnNew = $("#btnNew");
    let btnCadastrar = $("#btnCadastrar");
    let btnAtualizar = $("#btnAtualizar");
    let btnEdit = "btnEdit";
    let btnShowFilter = $("#btnShowFilter");
    let btnAtualizarTela = $("#btnAtualizarTela");


    // ----- PAGE ON LOAD -----
    carregaTabela();


    function carregaTabela(){
        try
        {
            let request;
            jQuery.support.cors = true;

            request = $.ajax({
                url: "/empreendimentos/hospedagens/tabela",
                contentType: 'application/json',
                cache: false,
                method: 'GET',
                crossDomain: true,
                dataType: 'json',
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

                    tblCompleta.DataTable().destroy();
                    tblCompleta.DataTable({
                        language: {
                            "url": "//cdn.datatables.net/plug-ins/1.12.1/i18n/pt-BR.json"
                        },
                        data : response,
                        columns: [
                            {
                                'data' : 'informacoes',
                                "defaultContent": " "
                            },
                            {
                                'data' : 'caracteristicas',
                                "defaultContent": " "
                            }
                        ]
                    })
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

    function show(id) {
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
                    $("#selStatus").val(response.data.status_id);
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

    // ----- PROCESS UPLOAD -----

    let id = '#myAwesomeDropzone';
    Dropzone.autoDiscover = false;

    let myDropzone = new Dropzone(id, {
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "/empreendimentos/hospedagens/upload",
        params:{
            'hospedagem_id': $("#inpHospedagemIdGerado").val()
        },
        method:'post',
        addRemoveLinks: true,
        uploadMultiple: true,
        maxFiles: 5,
        // acceptedFiles: 'text/csv,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        autoProcessQueue: false,
        maxfilesexceeded: function(file) {
            this.removeAllFiles();
            this.addFile(file);
        },
        sending: function(file, xhr, formData) {
            formData.append("hospedagem_id", $("#inpHospedagemIdGerado").val());
        },
        success: function (file, response) {

            if(response.success){
                swal("Ótimo!", "Solicitação realizada com sucesso, Aguarde para finalizar o processo", "success");
                this.removeAllFiles()
                $("#mdlNew").modal("hide")
                $("#selTipo").val("");
                carregaTabela();
            }else{
                let mensagem = "Extensão do Arquivo inválida"
                if(response.message)
                    mensagem = response.message

                swal("Ops...!", mensagem, "warning");
            }
        },
        error: function (file, response) {

            swal("Ops...!", "Não foi possível solicitar a importação, tente novamente", "warning");
        }
    });

    btnNew.unbind().click(function(event) {
        event.stopPropagation();
        event.preventDefault();

        $("#mdlNew").modal("show");
        $("#fullWidthModalLabel").html('Cadastrar Novo Terreno');

    });

    btnCadastrar.unbind().click(function(event) {
        event.stopPropagation();
        event.preventDefault();
        let frmNewInformacoes = $("#frmNewInformacoes").serializeObject();
        let frmNewPrecificacao = $("#frmNewPrecificacao").serializeObject();

        let payload = Object.assign({}, frmNewInformacoes, frmNewPrecificacao);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        request = $.ajax({
            url: "/empreendimentos/hospedagens/store",
            contentType: 'application/json',
            method: 'POST',
            dataType: 'json',
            data: JSON.stringify(payload),
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
                console.log(response)
                if(response['status'] === "success"){
                    $("#inpHospedagemIdGerado").val(response['dados']['id']);

                    myDropzone.processQueue();
                    toastr["success"]("Cadastro realizado com sucesso.", "Terreno cadastrado");
                    $("#frmNewInformacoes")[0].reset();
                    $("#frmNewPrecificacao")[0].reset();
                    $("#mdlNew").modal('hide');
                    carregaTabela();
                }
            }
        });

        // Caso falha
        request.fail(function (jqXHR, textStatus, errorThrown) {
            toastr["error"](textStatus + ": " + errorThrown, "Houve um erro na requisição");
        });

        // Sempre executa, seja falha ou sucesso
        request.always(function () {
            Swal.close();
        });
    });

    btnAtualizarTela.unbind().click(function(event) {
        event.stopPropagation();
        event.preventDefault();

        carregaTabela();
    });

    $("#tblCompleta").on('click', '.' + btnEdit, function(event){
        event.stopPropagation();
        event.preventDefault();

        $("#mdlEdit").modal("show");
        let id = $(this).attr('data-id');
        let nome = $(this).attr('data-name');
        $("#txtEdiHospedagem").html('Detalhes do empreendimento: ' + nome);
        $("#inpHospedagemIdGeradoEdit").val(id);
        show(id);

    });

    btnAtualizar.unbind().click(function(event) {
        event.stopPropagation();
        event.preventDefault();
        let frmEdit = $("#frmEdit").serializeObject();
        let id = frmEdit['inpHospedagemIdGerado'];
        let dados = {
            'status' : frmEdit['selStatus']
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        request = $.ajax({
            url: "/empreendimentos/hospedagens/update/" + id,
            contentType: 'application/json',
            method: 'PUT',
            dataType: 'json',
            data: JSON.stringify(dados),
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
                if(response['status'] === "success"){
                    toastr["success"]("Atualizado com sucesso.", "Terreno atualizado");
                    $("#frmEdit")[0].reset();
                    $("#mdlEdit").modal('hide');
                    carregaTabela();
                }
            }
        });

        // Caso falha
        request.fail(function (jqXHR, textStatus, errorThrown) {
            toastr["error"](textStatus + ": " + errorThrown, "Houve um erro na requisição");
        });

        // Sempre executa, seja falha ou sucesso
        request.always(function () {
            Swal.close();
        });
    });



});