$(document).ready(function () {
    // ----- VARIAVEIS -----
    let tblCompleta = $('#tblCompleta');


    // ----- BOTOES -----
    let btnNew = $("#btnNew");
    let btnCadastrar = $("#btnCadastrar");
    let btnAtualizarTela = $("#btnAtualizarTela");
    let btnView = "btnView";


    // ----- PAGE ON LOAD -----
    carregaTabela('aprovado');


    function carregaTabela(status){
        try
        {
            let request;
            jQuery.support.cors = true;

            request = $.ajax({
                url: "/empreendimentos/afiliacoes/tabela/" + status,
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
                                'data' : 'foto',
                                "defaultContent": " "
                            },
                            {
                                'data' : 'nome_empreendimento',
                                "defaultContent": " "
                            },
                            {
                                'data' : 'preco_max',
                                "defaultContent": " "
                            },
                            {
                                'data' : 'status',
                                "defaultContent": " "
                            },
                            {
                                'data' : 'link',
                                "defaultContent": " "
                            },
                            {
                                'data' : 'acao',
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


    btnNew.unbind().click(function(event) {
        event.stopPropagation();
        event.preventDefault();

        $("#mdlNew").modal("show");
        $("#fullWidthModalLabel").html('Cadastrar Novo Terreno');
    });


    btnAtualizarTela.unbind().click(function(event) {
        event.stopPropagation();
        event.preventDefault();

        carregaTabela('aprovado');
        carregaTabela('pendente');
    });


    $("#myTabFull").on("click", '[role="tab"]', function(event) {
        event.stopPropagation();
        event.preventDefault();

        let idTab = $(this).attr("id");
        if (idTab) {
            switch (idTab) {
                case 'empreendimentos':
                    carregaTabela('aprovado')
                    break;
                case 'empreendimentosPendentes':
                    carregaTabela('pendente')

            }
        }
    });

    $(document).on('click', '.' + btnView, function(event){
        event.stopPropagation();
        event.preventDefault();

        $("#mdlView").modal("show");
        let id = $(this).attr('id');
        let nome = $(this).closest("tr").find('td').eq(1).text();
        $("#txtModelView").html('Detalhes do empreendimento: ' + nome);
    });



});