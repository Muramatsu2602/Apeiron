function apareceBarra() {
    $('#produtos-pesquisa').css({
        'display':'block'
    });
}
$('#barra-fecha').click(function() {
    $('#produtos-pesquisa').css({
        'display':'none'
    });
});