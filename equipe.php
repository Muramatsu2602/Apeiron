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
    <title> DESENVOLVEDORES </title>
</head>
<body>
      <?php
        $quePagina = 3;
        include "padrao/header.php";
        ?>
        <div class="apres">
            <h1>DESENVOLVEDORES</h1>
            <p>Conheça as mentes por trás dessa empresa!</p>
        </div>
        <div class="meio">
              <div class="textos-esquerda">
               <div class="texto-alex">
                   <ul class="lista-alex">
                    <li>
                        <h3>ALEX CRIVELARO - N°01</h3>
                    </li>
                    <hr>
                    <li><p>-VISUAL DESIGN</p></li>
                    <li><p>-HTML</p></li>
                    <li><p>-CSS</p></li>
                  </ul>
                 </div>
                 <div class="texto-kenzo">
                   <ul class="lista-kenzo">
                    <li>
                        <h3>PEDRO KENZO - N°31</h3>
                    </li>
                    <hr>
                    <li><p>-FUNÇÕES PHP</p></li>
                    <li><p>-LÍDER</p></li>
                    <li><p>-HTML</p></li>
                  </ul>
                 </div>
                </div>
                <div class="textos-centro">
                 <div class="texto-marcos">
                   <ul class="lista-marcos">
                    <li>
                        <a href="http://71bpolitica.blogspot.com/p/inicial.html"><h3>MARCOS JOSUÉ - N°25</h3></a>
                        
                    </li>
                    <hr>
                    <li><p>-DESING DE PÁGINAS</p></li>
                    <li><p>-HTML E PHP</p></li>
                    <li><p>-CSS GERAL</p></li>
                  </ul>
                 </div>
                </div>
                <div class="textos-direita">
                 <div class="texto-ricardo">
                   <ul class="lista-ricardo">
                    <li>
                        <h3>RICARDO PINAL - N°31</h3>
                    </li>
                    <hr>
                    <li><p>-FUNÇÕES BANCO DE DADOS</p></li>
                    <li><p>-FUNÇÕES PHP</p></li>
                    <li><p>-HTML</p></li>
                  </ul>
                 </div>
                 <div class="texto-jp">
                   <ol class="lista-jp">
                    <li>
                        <h3>JOÃO PILASTRI - N°19</h3>
                    </li>
                    <hr>
                    <li><p>-FUNÇÕES BANCO DE DADOS</p></li>
                    <li><p>-FINANCIAMENTO</p></li>
                    <li><p>-FUNÇÕES PHP</p></li>
                  </ol>
                 </div>
                </div>
                <div class="fotos-esquerda">
                   <mostra-texto>
                        <div class="alex"></div>
                    </mostra-texto>
                    <mostra-texto>
                        <div class="kenzo"></div>
                    </mostra-texto>
                </div>
                <div class="fotos-meio">
                   <mostra-texto>
                        <div class="marcos"></div>
                   </mostra-texto>
                </div>
                <div class="fotos-direita">
                    <mostra-texto>
                        <div class="ric"></div>
                    </mostra-texto>
                    <mostra-texto>
                        <div class="jp"></div>
                    </mostra-texto>
                </div>
        </div>
        <script>
        $(".alex").hover(function(){
            $(this).css("box-shadow", "0px 0px  45px 2px #ff0000");
            $(".texto-alex").css("box-shadow", "0px 0px  45px -5px #ff0000");
                }, function(){
                $(this).css("box-shadow", "none");
                $(".texto-alex").css("box-shadow", "none");
        });
            
        $(".texto-alex").hover(function(){
            $(this).css("box-shadow", "0px 0px  45px 2px #ff0000");
            $(".alex").css("box-shadow", "0px 0px  45px 2px #ff0000");
                }, function(){
                $(this).css("box-shadow", "none");
                $(".alex").css("box-shadow", "none");
        }); 
            
        
         $(".kenzo").hover(function(){
            $(this).css("box-shadow", "0px 0px  45px 2px #ff0000");
            $(".texto-kenzo").css("box-shadow", "0px 0px  45px -5px #ff0000");
                }, function(){
                $(this).css("box-shadow", "none");
                $(".texto-kenzo").css("box-shadow", "none");
        });
            
        $(".texto-kenzo").hover(function(){
            $(this).css("box-shadow", "0px 0px  45px 2px #ff0000");
            $(".kenzo").css("box-shadow", "0px 0px  45px 2px #ff0000");
                }, function(){
                $(this).css("box-shadow", "none");
                $(".kenzo").css("box-shadow", "none");
        });
            
        
         $(".marcos").hover(function(){
            $(this).css("box-shadow", "0px 0px  45px 2px #ffffff");
            $(".texto-marcos").css("box-shadow", "0px 0px  45px -5px #ffffff");
                }, function(){
                $(this).css("box-shadow", "none");
                $(".texto-marcos").css("box-shadow", "none");
        });
            
        $(".texto-marcos").hover(function(){
            $(this).css("box-shadow", "0px 0px  45px 2px #ffffff");
            $(".marcos").css("box-shadow", "0px 0px  45px 2px #ffffff");
                }, function(){
                $(this).css("box-shadow", "none");
                $(".marcos").css("box-shadow", "none");
        });
            
            
         $(".ric").hover(function(){
            $(this).css("box-shadow", "0px 0px  45px 2px #98aefd");
            $(".texto-ricardo").css("box-shadow", "0px 0px  45px -5px #98aefd");
                }, function(){
                $(this).css("box-shadow", "none");
                $(".texto-ricardo").css("box-shadow", "none");
        });
            
        $(".texto-ricardo").hover(function(){
            $(this).css("box-shadow", "0px 0px  45px 2px #98aefd");
            $(".ric").css("box-shadow", "0px 0px  45px 2px #98aefd");
                }, function(){
                $(this).css("box-shadow", "none");
                $(".ric").css("box-shadow", "none");
        });
            
            
         $(".jp").hover(function(){
            $(this).css("box-shadow", "0px 0px  45px 2px #98aefd");
            $(".texto-jp").css("box-shadow", "0px 0px  45px -5px #98aefd");
                }, function(){
                $(this).css("box-shadow", "none");
                $(".texto-jp").css("box-shadow", "none");
        });
            
        $(".texto-jp").hover(function(){
            $(this).css("box-shadow", "0px 0px  45px 2px #98aefd");
            $(".jp").css("box-shadow", "0px 0px  45px 2px #98aefd");
                }, function(){
                $(this).css("box-shadow", "none");
                $(".jp").css("box-shadow", "none");
        });
        
    
    
        </script>
        <?php
            include "padrao/footer.php";
        ?>   
</body>
</html>