<?php
 	session_start();    
?>
    <!DOCTYPE html>
    <html lang="pt-br">

    <head>
        <?php
        include "padrao/meta.php";
        ?>
            <title>APEIRON</title>
    </head>

    <body>
        <?php
        $quePagina = 1;
        include "padrao/header.php";
        if(isset($_SESSION['LOGINN']) and $_SESSION['LOGINN'] == FALSE):
            echo '<script>alert("não logou");</script>';
            session_destroy();   
        endif;        
        ?>
            <section class="banner">
                <h2>MELHORES BOTTONS</h2>
                <hr>
                <p>
                    Desenvolvidos, selecionados e pensados com muito amor!
                </p>
                <a href="produtos.php" class="botaog">SAIBA MAIS</a>
            </section>
            <main>
                <section class="ideal">
                    <h2>NOSSOS IDEAIS</h2>
                    <p>
                        <p>
                            "Cremos que, o desejo de servir a humanidade, seja o substrato para qualquer realização humana. E nossa empresa não foge dessa regra! Aqui temos Botttons planejados para maximizar a sua experiência."
                        </p>
                        <p>
                            -Equipe Apeiron
                        </p>
                        <hr>
                </section>
                <section class="diversos">
                    <div class="item foto1">
                        <div class="mostra">
                            <p>
                                Bottons desde à mulher maravilha ao superman! Que os heróis te acompanhem!
                            </p>
                            <a href="produtos.php" class="botaog">
                                Veja!
                           </a>
                        </div>
                        <div id="particles-js" class="efeito-framework"></div>
                        <script src="js/particles.js"></script>
                        <script src="js/app.js"></script>
                    </div>
                    <div class="item foto2">
                        <div class="mostra">
                            <p>
                                Bottons sobre política, compre e garanta o seu Lula ou Bolsonaro #2018!
                            </p>
                            <a href="produtos.php" class="botaog">
                         Veja!
                        </a>
                        </div>
                        <div id="particles-js" class="efeito-framework"></div>
                        <script src="js/particles.js"></script>
                        <script src="js/app.js"></script>
                    </div>
                    <?php
                    if(isset($_GET['compra']))
                        echo "<script>alert('Compra finalizada e verifique o seu email');</script>";
                ?>
                        <div class="item foto3">
                            <div class="mostra">
                                <p>
                                    Compre os bottons de seus respectivos cursos!
                                </p>
                                <a href="produtos.php" class="botaog">
                         Veja!
                        </a>
                            </div>
                            <div id="particles-js" class="efeito-framework"></div>
                            <script src="js/particles.js"></script>
                            <script src="js/app.js"></script>
                        </div>
                        <div class="item foto4">
                            <div class="mostra">
                                <p>
                                    De uma olhada na variedade de bottons disponíveis!
                                </p>
                                <a href="produtos.php" class="botaog">
                                     Veja!
                                </a>
                            </div>
                            <div id="particles-js" class="efeito-framework"></div>
                            <script src="js/particles.js"></script>
                            <script src="js/app.js"></script>
                        </div>
                </section>
            </main>
            <section class="video">
                <article class="envolve">
                    <iframe src="https://www.youtube.com/embed/UwouRTQJUeo" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                </article>
                <article>
                    <p>
                        <i class="fas fa-arrow-alt-circle-left"></i> Um pequeno vídeo que visa facilitar e ampliar o conhecimento de nossa empresa e de seus produtos!
                    </p>
                </article>

            </section>
            <?php
            include "padrao/footer.php";
        ?>
    </body>

    </html>
