
    <?php
        $conecta = pg_connect("host=localhost port=5432 dbname=2018_72b_Apeiron user=apeiron password=logos321");
        if(!conecta)
        {
            echo "\nErro ao Conectar";
            exit;
        }
        $email = $_POST['email'];
        $desc = $_POST['desconto'];
        $sql = "SELECT total FROM rpm.carrinho WHERE cod_usu = (SELECT id_usuario FROM usuario WHERE email = '$email')";
        $resultado = pg_query($conecta,$sql);
        $num = pg_num_rows($resultado);
        if($num == 0)
        {
            pg_close($conecta);
            print "\nErro ao buscar no Servidor!!\n\nUsuário Inexistente";
            exit;
        }
        $row = pg_fetch_array($resultado);
        $banco = $row[0];
        if(($banco - $desc) < 0)
        {
            pg_close($conecta);
            print "\nProblemas com o Desconto!!\n\nNão existe valor negativo";
            exit;
        }
        $novo = $banco - $desc;
        $sql = "UPDATE rpm.carrinho SET total = $novo WHERE cod_usu = (SELECT id_usuario FROM usuario WHERE email = '$email')";
        $resultado = pg_query($conecta,$sql);
        pg_close($conecta);
        $banco_str = number_format($banco,2,',',' ');
        $novo_str = number_format($novo,2,',',' ');
        print "\nSucesso!!!\n\n"; 
        print "Antigo : ".$banco_str." R$"."\n\nNovo: ".$novo_str." R$";
    ?>
