function item(id) {
    alert("Espere, não click mais");
    var endereco = $(id).val();
    $.ajax({
                url: "executa/cadastro_final_atualizado.php",
                method: "POST",
                data: {
                    endereco:endereco
                },
                success: function(data) {
                    $('#box-endereco').html(data);
                },
                error: function() {
                    alert('erro');
                }
            });
};