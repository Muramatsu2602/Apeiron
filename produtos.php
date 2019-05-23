<?php
 	session_start();
    $_SESSION['LOGIN'] = $_GET['logou'];

?>
    <!DOCTYPE html>
    <html lang="pt-br">

    <head>

        <?php
        include "padrao/meta.php";
        ?>
            <title>PRODUTOS</title>
    </head>

    <body onload="mostraSlide(slideMarcador);slideTimer()">
        <?php
        $quePagina = 2;
        include "padrao/header.php";
        ?>
            <section id="vetrine">
                <a class="setaAnte" onclick="mudaSlide(-1)">&#10094;</a>
                <a class="setaProx" onclick="mudaSlide(+1)">&#10095;</a>
                <p>COMPRE NOSSOS BOTTONS</p>
                <img src="img/slider1.jpg" class="slide ">
                <img src="img/slider2.jpg" class="slide ">
                <img src="img/slider3.jpg" class="slide ">
                <script src="js/slide.js" type="text/javascript"></script>
            </section>
            <section class="itemDecora">
                <article class="explica">
                    <p>Aqui você coloca no carrinho seus produtos, mas isso não significa que a compra foi efetuada ainda.</p>
                </article>
                <article class="explica">
                    <p>Aqui, voce escolhe o quanto deseja levar, há apresentação mais detalhada.</p>
                </article>
                <article class="explica">
                    <p>Faça boas compras, obrigado pela preferência</p>
                </article>
            </section>
            <main class="contem-produto" id="main">
                <a href="#produtos-pesquisa" onclick="apareceBarra()"><i class="fas fa-search"></i></a>
                <section class="barra" id="produtos-pesquisa">
                    <button class="btn-fecha" id="barra-fecha"><i class="far fa-times-circle"></i></button>
                    <p>FILTROS</p>
                    <hr>
                    <form action="pesquisa.php" method="post" target="_blank">
                        <input type="text" class="input" name="produto_pesquisado" placeholder="palavras-chaves">

                        <div class="conjunto-radio">
                            <p class="cont">Cor predominante</p>
                            <label class="radio item-1"><input type="radio" name="cor" value="vermelho">Vermelho</label>
                            <label class="radio item-2"><input type="radio" name="cor" value="azul">Azul</label>
                            <label class="radio item-3"><input type="radio" name="cor" value="amarelo">Amarelo</label>
                            <label class="radio item-4"><input type="radio" name="cor" value="rosa">Rosa</label>
                        </div>
                        <div class="contem-busca">
                            <input type="reset" value="LIMPAR" class="input muda">
                            <input type="submit" value="BUSCAR" class="input muda">
                        </div>
                    </form>
                    <script src="js/clickPesquisaBarra.js" type="text/javascript"></script>
                </section>
                <!--  POLITICA               -->
                <section class="block pr1">
                    <article class="tex">
                        <p>
                            POLÍTICA
                        </p>
                        <hr>
                    </article>
                    <article class="prod" id="sectionPolitica">
                    </article>
                </section>
                <!--            CULTURA POP                     -->
                <section class="block pr2">
                    <article class="tex">
                        <p>
                            VARIEDADES
                        </p>
                        <hr>
                    </article>
                    <article class="prod" id="sectionCulturaPop">
                    </article>
                </section>
                <!--                cti                        -->
                <section class="block pr3">
                    <article class="tex">
                        <p>
                            CTI
                        </p>
                        <hr>
                    </article>
                    <article class="prod" id="sectionCti">
                    </article>
                </section>
                <script src="js/anima.js" type="text/javascript"></script>
                <script src="js/ajax.js" type="text/javascript"></script>
                <script>
                    $(window).resize(function() {
                        var tela = $(window).width();
                        i = 0;
                        if(tela >= 750 && i == 0) {
                        $('#produtos-pesquisa').css({'display':'flex'});
                            i++;
                        }
                    }); 
                </script>
        </main>
            <?php
            include "padrao/footer.php";
        ?>
    </body>

    </html>
