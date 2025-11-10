$(document).ready(function () {
    let tblCompleta = $('#tblCompleta');
    let btnAtualizarTela = $("#btnAtualizarTela");

    carregaTabela();

    function carregaTabela() {
        try {
            jQuery.support.cors = true;

            $.ajax({
                url: "/formularios/list",
                method: "GET",
                contentType: "application/json",
                dataType: "json",
                cache: false,
                crossDomain: true,
                beforeSend: function () {
                    Swal.fire({
                        icon: "warning",
                        title: "Aguarde!",
                        html: "Carregando informações...",
                        allowOutsideClick: false,
                        showCancelButton: false,
                        showConfirmButton: false,
                        didOpen: () => {
                            Swal.showLoading();
                        },
                    });
                },
                success: function (response) {
                    if (!Array.isArray(response)) {
                        toastr["error"]("Retorno inesperado do servidor.", "Erro");
                        return;
                    }

                    if ($.fn.DataTable.isDataTable(tblCompleta)) {
                        tblCompleta.DataTable().clear().destroy();
                    }

                    tblCompleta.DataTable({
                        language: {
                            url: "https://cdn.datatables.net/plug-ins/1.12.1/i18n/pt-BR.json",
                        },
                        responsive: true,
                        data: response,
                        columns: [
                            { data: "oca_id", title: "OCA ID", defaultContent: "—" },
                            { data: "nome", title: "Nome", defaultContent: "—" },
                            { data: "telefone", title: "Telefone", defaultContent: "—" },
                            { data: "email", title: "E-mail", defaultContent: "—" },
                            { data: "categoria", title: "Categoria", defaultContent: "—" },
                            { data: "endereco", title: "Endereço", defaultContent: "—" },
                            { data: "metragem", title: "Metragem", defaultContent: "—" },
                            { data: "observacoes", title: "Observações", defaultContent: "—" },
                            { data: "data", title: "Data", defaultContent: "—" },
                            {
                                data: null,
                                orderable: false,
                                searchable: false,
                                className: "text-center",
                                responsivePriority: 1,
                                render: function (data, type, row) {
                                    return `
                                        <button class="btn btn-success btn-sm btn-aprovar" data-id="${row.oca_id}" title="Aprovar">
                                            <i class="mdi mdi-check"></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm btn-reprovar" data-id="${row.oca_id}" title="Reprovar">
                                            <i class="mdi mdi-close"></i>
                                        </button>
                                    `;
                                },
                            },
                        ],
                    });
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    toastr["error"](
                        textStatus + ": " + errorThrown,
                        "Erro ao carregar os dados"
                    );
                },
                complete: function () {
                    Swal.close();
                },
            });
        } catch (ex) {
            console.error("Erro inesperado:", ex);
        }
    }

    // Recarregar tabela
    btnAtualizarTela.on("click", function () {
        carregaTabela();
    });

    // Eventos dos botões de ação
    $(document).on("click", ".btn-aprovar", function (event) {
        event.stopPropagation();
        event.preventDefault();

        let ocaId = $(this).data("id");
        console.log("Clicou em APROVAR:", ocaId);
        acaoEmpreendimento(ocaId, "aprovar");
    });

    $(document).on("click", ".btn-reprovar", function (event) {
        event.stopPropagation();
        event.preventDefault();

        let ocaId = $(this).data("id");
        console.log("Clicou em REPROVAR:", ocaId);
        acaoEmpreendimento(ocaId, "reprovar");
    });

    function acaoEmpreendimento(ocaId, acao) {
        console.log('aqui ')
        Swal.fire({
            title: acao === "aprovar" ? "Aprovar empreendimento?" : "Reprovar empreendimento?",
            icon: "question",
            showCancelButton: true,
            confirmButtonText: "Sim",
            cancelButtonText: "Cancelar",
            confirmButtonColor: acao === "aprovar" ? "#28a745" : "#dc3545",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "/formularios/acao",
                    method: "POST",
                    data: {
                        oca_id: ocaId,
                        acao: acao,
                        _token: $('meta[name="csrf-token"]').attr("content"),
                    },
                    success: function () {
                        toastr["success"]("Ação concluída com sucesso!", "Sucesso");
                        carregaTabela();
                    },
                    error: function (xhr) {
                        toastr["error"]("Erro ao processar ação: " + xhr.statusText, "Erro");
                    },
                });
            }
        });
    }
});
