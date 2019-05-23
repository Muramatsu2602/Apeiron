<?php
 	session_start();
    include "executa/conectarApeiron.php";
    $sqlEndereco = "SELECT id_endereco FROM endereco WHERE id_usuario =".$_SESSION['id'].";";
    $resultadoBuscaEndereco = pg_query($conecta_Apeiron, $sqlEndereco);
    $endereco = pg_fetch_array($resultadoBuscaEndereco);
?>

    <!DOCTYPE html>
    <html lang="pt-br">

    <head>
        <?php
    include "padrao/meta.php";
    ?>
            <title>CADASTRO CLIENTE</title>
    </head>

    <body>
        <?php
        include "padrao/header.php";
        ?>
            <section class="apres">
                <h1>CADASTRO DE CLIENTE</h1>
                <p>Escolha um endereço</p>
            </section>

            <main class="back">
             <section class="escolhe-endereco" id="box-endereco">
                 
             </section>
             <script src="js/ajaxPaginacoEndereco.js" type="text/javascript"></script>
             <script src="js/ajaxLinkCompra.js"       type="text/javascript"></script>
            </main>
        <?php
            include "padrao/footer.php";
        ?>
    </body>
   

    </html>
