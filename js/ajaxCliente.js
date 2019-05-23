$('#cadastro-cliente').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: 'executa/cadastro_final.php',
                type: 'post',
                data: $('#cadastro-cliente').serialize(),
                success: function(data) {
                    $('#cadastro_cliente-box').html(data);
                },
                error: function() {
                    alert("erro");
                }
            });
        });