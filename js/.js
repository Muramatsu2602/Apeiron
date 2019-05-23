alert('foi');

/*if($('en'))*/
$('#cadastra').submit(function (e) {
    e.preventDefault();
    $.ajax({
        url: 'executa/cadastrar.php',
        type: 'post',
        data: $('#cadastra').serialize(),
        success: function (data) {
            alert('data');
            $('#cadastra').resetForm();
        }
    });
});
