function desapareceCompra(valor) {
    $(valor).css({"bottom":"-100%", "transition": "all .2.5s"});
}
function apareceCompra(valor) {
    $(valor).animate({bottom:0},100);
}