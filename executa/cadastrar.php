<?php
    session_start();
    include "conectarApeiron.php";
    $nome = preg_replace('/[^[:alpha:]_]/', ' ',$_POST['nome']);
    $senha = md5($_POST['senha']);
    $email = $_POST['email'];
    $nascimento =preg_replace('/[^[:alpha:]_]/', ' ', $_POST['nascimento']);
    $sexo =preg_replace('/[^[:alpha:]_]/', ' ', $_POST['sexo']);
    $sql = "INSERT INTO usuario VALUES(DEFAULT, '$nome', '$email', '$senha','n', DEFAULT, 1, FALSE);";
    $cadastro=pg_query($conecta_Apeiron,$sql);
    $sqlBusca = "SELECT max(id_usuario) FROM usuario";
    $resultado = pg_query($conecta_Apeiron,$sqlBusca);
    $existe = pg_affected_rows($cadastro);
    if($existe > 0 ):
        echo "Foi cadastrado. Verifique o seu email ou caixa de span";
        $linha = pg_fetch_array($resultado);
        $key = $linha['max'];
        include "confirmaphp.php";
    else: 
        echo "Veja se não há um cadastro já";
    endif;
    pg_close($conecta_Apeiron); 
?>