<header class="header">
    <div class="envolve-toda-pesquisa">
        <form action="pesquisa.php" method="post">
            <div class="segura-pesquisa-ex">
                <input type="text" name="produto_pesquisado" class="pesquisa-barra" placeholder="Digite o nome do produto a ser pesquisado e tecle ENTER">
                <a class="fecha-pesquisa"><i class="far fa-times-circle"></i></a>
            </div>
        </form>
    </div>
    <h1>
        <a href="index.php" class="leva-ao-home">
            <img src="img/logosite.png" alt="" id="logo">   
        </a>
    </h1>
    <button class="btn-nav" id="btn-nav"><i class="fas fa-bars"></i></button>
    <nav class="nav" id="barra">
       <button class="btn-fecha" id="btn-fecha-nav"><i class="far fa-times-circle"></i></button>
       <script>
           $('#btn-fecha-nav').click(function() {
               $('#barra').css({"display":"none"});
           });
        </script>
        <a href="#" class="pesquisa" onclick="apareceBarra()">
           <i class="fas fa-search"></i>
           <script>
               function apareceBarra() {
                    setTimeout(function(){ $('.envolve-toda-pesquisa').css("display", "flex"); },200);
                    $('.envolve-toda-pesquisa').css("z-index", "100");
                    $('#barra').animate({opacity:"0"},{duration:200}, function(){});
                }
               
               $(".fecha-pesquisa").click(
                function() {
                $('.envolve-toda-pesquisa').css("z-index", "0");
                setTimeout(function(){ $('.envolve-toda-pesquisa').css("display", "none"); },50);
                $('#barra').animate({opacity:"1"},{duration:200}, function(){});
                }
                );
            </script>
        </a>
        <a href="index.php">
            <p <?php if($quePagina==1 ): ?> style="text-decoration:underline; font-weight: 500; color: rgba(200, 10, 10, 0.9); "
                <?php endif; ?>>HOME</p>
        </a>
        <a href="produtos.php">
            <p <?php if($quePagina==2 ): ?> style="text-decoration:underline; font-weight: 500; color: rgba(200, 10, 10, 0.9);"
                <?php endif; ?>>PRODUTOS</p>
        </a>

        <a href="#" class="btn-show">
            <p>LOGIN/CADASTRO</p>
        </a>

        <a href="equipe.php">
            <p <?php if($quePagina==3 ): ?> style="text-decoration:underline; font-weight: 500; color: rgba(200, 10, 10, 0.9);"
                <?php endif; ?>>EQUIPE</p>
        </a>
        <?php
                if($_SESSION['LOGINN'] == TRUE):  
        ?>
            <ul>
                <li class="has-children">
                    <a>
                        <p style="color:rgba(200, 10, 10, 0.9); font-weight:300; text-decoration: underline rgba(200, 10, 10, 0.9);">
                            Oi,
                            <?php
                                echo $_SESSION['nome'];
                            ?>
                        </p>
                    </a>
                    <ul>
                        <li><a href="executa/sair.php" style="color:rgba(200,10,10,0.9)">sair</a></li>
                    </ul>
                </li>
            </ul>
            <?php
                endif;
            ?>
                <a href="#" class="carrinho" onclick="apareceCarrinho()">
                    <i class="fas fa-shopping-cart"></i>
                </a>
    </nav>
    <div class="segura-carrinho" id="carrinho">
    </div>
    <!--<script src=".//js/ajaxCarrinho.js" type="text/javascript"></script>-->
    <script>
        function apareceCarrinho() {
            $('.segura-carrinho').fadeToggle(200);
            $('.segura-carrinho').css({
                'display': 'grid'
            });
            carrinho(1);
        }

    </script>
    <script src=".//js/ajaxCarrinho.js" type="text/javascript"></script>
    <div class="segura">
        <div class="cadastra-login">
            <a href="#" class="btn-fecha" style="display:block">
                        <i class="far fa-times-circle"></i>
                    </a>
            <i class="fas fa-user-circle"></i>
            <li class="segura-cadastro">
                <div class="contem-cadastro">
                    <form action="executa/cadastrar.php" class="form" method="post" id="cadastra">
                        <h3>CADASTRAR</h3>
                        <hr>
                        <input type="text" name="nome" placeholder="*nome, apelido" required>
                        <input type="password" name="senha" placeholder="*senha" required id="forca-senha" onkeyup="verefica()">
                        <p id="mostra-nivel">
                        </p>
                        <script>
                            function verefica() {
                                senha = document.getElementById('forca-senha').value;
                                forca = 0;
                                mostra = document.getElementById('mostra-nivel');
                                if ((senha.length >= 4) && (senha.length <= 7)) {
                                    forca += 10;
                                } else if (senha.length > 7) {
                                    forca += 25;
                                }
                                if (senha.match(/[a-z]+/)) {
                                    forca += 25;
                                }
                                if (senha.match(/[A-Z]+/)) {
                                    forca += 20;
                                }
                                if (senha.match(/[0-9]+/)) {
                                    forca += 15;
                                }
                                if (senha.match(/d+/)) {
                                    forca += 20;
                                }
                                if (senha.match(/W+/)) {
                                    forca += 25;
                                }
                                return mostra_res();
                            }

                            function mostra_res() {
                                if (senha.length == 0)
                                    mostra.innerHTML = 'SEM SENHA';
                                else if (forca < 30 && forca > 0)
                                    mostra.innerHTML = 'SENHA FRACA';
                                else if ((forca >= 30) && (forca < 60))
                                    mostra.innerHTML = 'SENHA MÉDIA';
                                else if ((forca >= 60) && (forca < 85))
                                    mostra.innerHTML = 'SENHA FORTE';
                                else
                                    mostra.innerHTML = 'SENHA EXCELENTE';
                                return confirma();
                            }

                        </script>

                        <input type="password" placeholder="*Confirma senha" required id="confirma-senha" onkeyup="confirma()">
                        <p id="mostra-confirma"></p>
                        <script>
                            function confirma() {
                                var indica = document.getElementById('mostra-confirma');
                                var verefica = document.getElementById('confirma-senha').value;
                                if (verefica.length > 0 && verefica == senha) {
                                    indica.innerHTML = 'SENHAS IGUAIS';
                                } else if (verefica == 0)
                                    indica.innerHTML = 'SEM SENHA PARA CONFIRMAR';
                                else
                                    indica.innerHTML = 'SENHAS DIFERENTES';
                            }

                        </script>
                        <input type="email" name="email" placeholder="*email" required>
                        <li>
                            <input type="reset" value="CANCELAR">
                            <input type="submit" value="CADASTRAR">
                        </li>
                    </form>
                    <a href="#" class="btn-login">Deseja logar uma conta.</a>
                    <hr>
                </div>
            </li>
            <li class="segura-login">
                <div class="contem-login">
                    <form action="executa/login.php" class="form" method="post" id="login">
                        <h3>LOGIN</h3>
                        <hr>
                        <input type="text" name="nome" placeholder="*nome" required>
                        <input type="password" name="senha" placeholder="*senha" required>
                        <li>
                            <input type="reset" value="CANCELAR">
                            <input type="submit" value="LOGAR">
                        </li>
                    </form>
                    <a href="#" class="btn-cadastra">Deseja criar uma conta.</a>
                    <hr>
                </div>
            </li>
        </div>
    </div>
    <script>
        $('#cadastra').submit(function(e) {
            e.preventDefault();
            $('#cadastra').prop("disabled", true);
            $.ajax({
                url: 'executa/cadastrar.php',
                type: 'post',
                data: $('#cadastra').serialize(),
                success: function(data) {
                    alert(data);
                    $("#cadastra").trigger('reset');
                    return limpa_p();
                    $('#cadastra').prop("disabled", false);
                },
                error: function() {
                    alert("erro");
                }
            });
        });

        function limpa_p() {
            var indica = document.getElementById('mostra-confirma');
            mostra = document.getElementById('mostra-nivel');
            indica.innerHTML = '';
            mostra.innerHTML = '';
        }

    </script>
    <script>
        $(".labelm").click(
            function() {
                $(".labelm").css('-webkit-box-shadow', '0px 0px 20px 0px #000000');
                $(".labelm").css('-moz-box-shadow', '0px 0px 20px 0px #000000');
                $(".labelm").css('box-shadow', '0px 0px 20px 0px #000000');
                $(".labelf").css('box-shadow', '0px 0px 10px rgba(0, 0, 0, 0.2)');
            }
        );
        $(".labelf").click(
            function() {
                $(".labelf").css('-webkit-box-shadow', '0px 0px 20px 0px #000000');
                $(".labelf").css('-moz-box-shadow', '0px 0px 20px 0px #000000');
                $(".labelf").css('box-shadow', '0px 0px 20px 0px #000000');
                $(".labelm").css('box-shadow', '0px 0px 10px rgba(0, 0, 0, 0.2)');
            }
        );

    </script>
    <script>
        $(".btn-show").click(
            function() {
                $(".segura").animate({
                    right: "0"
                });
            }
        );
        $(".btn-show").dblclick(
            function() {
                $(".segura").animate({
                    right: "0%"
                });
            }
        );
        $(".btn-fecha").click(
            function() {
                $(".segura").animate({
                    right: "-100%"
                });
            }
        );
        $(".btn-cadastra").click(
            function() {
                $(".segura-login").fadeOut(200);
                $(".segura-cadastro").fadeTo(200, 1);
            }
        );
        $(".btn-login").click(
            function() {
                $(".segura-cadastro").fadeOut(200);
                $(".segura-login").fadeTo(200, 1);
            }
        );

    </script>
</header>
<div class="continua">
    <a href="index.php" class="leva-ao-home">
        <img src="img/logosite.png" alt="" id="logo2">   
    </a>
    <nav class="nav">
       
        <a href="index.php">
            <i class="fas fa-home"></i><p>HOME</p>
        </a>
        <a href="produtos.php">
                    <i class="fas fa-gift"></i><p>PRODUTOS</p>
        </a>
        <a href="#" class="btn-show">
                    <i class="fas fa-sign-in-alt"></i><p>LOGIN/CADASTRO</p>
        </a>
        <a href="equipe.php">
                    <i class="fas fa-code"></i><p>EQUIPE</p>
        </a>

        <a href="perfil.php">
            <i class="fas fa-user-circle"></i>
                <p>
                  
                </p>
        </a>
        <a href="#" class="carrinho">
            <i class="fas fa-shopping-cart"></i>
        </a>

    </nav>
    <button class="btn-nav"><i class="fas fa-bars"></i></button>
</div>
<script>
        var view = $('.header').width();
        if (view <= 750) {
            $('#logo').attr("src", "img/logomobile.png");
            $('#logo2').attr("src", "img/logomobile.png");
            $('.leva-ao-home img').css({'width':'calc(0.08 * 100vw)'});
        }
    $(window).resize(function() {
        var view = $('.header').width();
        if (view <= 750) {
            $('#logo').attr("src", "img/logomobile.png");
            $('#logo2').attr("src", "img/logomobile.png");
        }
        else {
            $('#logo').attr("src", "img/logosite.png");
            $('#logo2').attr("src", "img/logosite.png");
            $('#barra').css({'display':'flex'});
        }
    });
    $('#btn-nav').click(function() {
        $('#barra').css({'display':'flex'});
    });
</script>
