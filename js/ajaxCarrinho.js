function carrinho(page) {
            $.ajax({
                url: "executa/carrinho_produtos.php",
                method: "POST",
                data: {
                    page:page
                },
                success: function(data) {
                    $('#carrinho').html(data);
                },
                error: function() {
                    alert('erro');
                }
            });
        }