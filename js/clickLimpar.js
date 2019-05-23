$('#carrinho-exclui').click(function() {
    $.ajax({
                url: "executa/excluItemCarrinho.php",
                success: function(data) {
                    alert(data);
                },
                error: function() {
                    alert('erro');
                }
            });
});