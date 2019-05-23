$('#cadastro-novo-endereco').click(function() {
            $.ajax({
                method:'post',
                url: 'padrao/form.php',
                success: function(data) {
                    $('#cadastro_cliente-box').html(data);
                },
                error: function() {
                    alert("erro");
                }
            });
        });