function tamanhoTela() {
    var view = $('#main').width();
    var retorno = 4;
    if(view <= 750) {
        retorno = 3;
    }
    return retorno;
}

function mudaPagina(page,section) {
    $.ajax({
        url: "executa/paginacao.php",
        method: "POST",
        data: {
            page: page,
            section: section,
            item: tamanhoTela()
        },
        success: function(data) {
            if(section == 1)
                $('#sectionPolitica').html(data);
            else if(section == 2) 
                $('#sectionCulturaPop').html(data);
            else 
                $('#sectionCti').html(data);    
        },
        error: function() {
            alert('erro');
        }
    });
}
$(window).resize(function() {
    mudaPagina(1,1);
    mudaPagina(1,2);
    mudaPagina(1,3);
});
$(document).ready(function() {
    mudaPagina(1,1);
    mudaPagina(1,2);
    mudaPagina(1,3);
});
