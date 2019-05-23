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
        <!--<script src="js/cadastra.js" type="text/javascript"></script>-->
    </head>

    <body>
        <?php
        include "padrao/header.php";
        ?>
        <?php
        include "padrao/footer.php";
        ?>
    </body>
</html>