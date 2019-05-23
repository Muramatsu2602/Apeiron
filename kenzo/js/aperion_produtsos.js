//CKEDITOR.replace( 'textarea' );

$(document).ready(function () {
    $.fn.select2.defaults.set('language', 'pt-BR');
    $("select").select2();

    $('table tfoot th').each(function () {
        var title = $(this).text();
        $(this).html('<input type="text" placeholder="" >');
    });

    var table = $("table").DataTable({
        responsive: true,
        pagingType: "full_numbers",
        columnDefs: [
            {targets: [6 ], orderable: false,}
        ],
        language: {
            decimal: ",",
            thousands: "."
        },
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
        "language": {
            "sEmptyTable": "Nenhum registro encontrado",
            "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
            "sInfoFiltered": "(Filtrados de _MAX_ registros)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "sLengthMenu": "_MENU_ resultados por página",
            "sLoadingRecords": "Carregando...",
            "sProcessing": "Processando...",
            "sZeroRecords": "Nenhum registro encontrado",
            "sSearch": "Pesquisar",
            "oPaginate": {
                "sFirst": "<i class='fa fa-angle-double-left'></i>",
                "sLast": "<i class='fa fa-angle-double-right'></i>",
                "sNext": "<i class='fa fa-angle-right'></i>",
                "sPrevious": "<i class='fa fa-angle-left'></i>"
            },
            "oAria": {
                "sSortAscending": ": Ordenar colunas de forma ascendente",
                "sSortDescending": ": Ordenar colunas de forma descendente"
            },
        }
    });

    table.columns().every(function () {
        var that = this;
        $('input', this.footer()).on('keyup change', function () {
            if (that.search() !== this.value) {
                that
                    .search(this.value)
                    .draw();
            }
        });
    });

//Mascaras para os inputs
    $(".mask_date").inputmask("99/99/9999");
    $(".mask_cpf").inputmask("999.999.999-99");


    $(".mask_date").datepicker({
        language: 'pt-BR'
    });
// teste de força da senha
    $(function () {
        $("#senha").complexify({}, function (valid, complexity) {
            document.getElementById("mtSenha").value = complexity;

        });
    });
});
