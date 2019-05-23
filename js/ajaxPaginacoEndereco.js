function mudaPagina(page) {
    $.ajax({
        url: "executa/paginacaoEndereco.php",
        method: "POST",
        data: {
            page: page,
        },
        success: function(data) {
            $('#box-endereco').html(data);
        },
        error: function() {
            alert('erro');
        }
    });
}
$(document).ready(function() {
    mudaPagina(1);

});