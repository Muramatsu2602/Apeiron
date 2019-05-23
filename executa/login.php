<?php
    session_start();
    include "conectarApeiron.php";
    $nome = preg_replace('/[^[:alpha:]_]/', ' ',$_POST['nome']);
    $senha = md5($_POST['senha']);
    $sql = "SELECT id_usuario, login, senha, valido, privilegio FROM usuario WHERE login = '$nome' AND senha = '$senha' AND valido = 1 AND excluido = 'n' AND privilegio = FALSE;";
    $resultado = pg_query($conecta_Apeiron,$sql);
    $linha = pg_fetch_array($resultado);
    $id_usuario = $linha['id_usuario'];
    $qtd = pg_affected_rows($resultado);
    $_SESSION['LOGINN'] = FALSE;
    if($qtd > 0 ):
        $_SESSION['LOGINN'] = TRUE;
        $_SESSION['id'] = $id_usuario;
        $_SESSION['nome'] = $nome;
        $sqlVerefiva = "SELECT cod_usu FROM rpm.carrinho WHERE cod_usu = $id_usuario;";
        $resultadoExistencia = pg_query($conecta_Apeiron, $sqlVerefiva);
        $existeNumero = pg_affected_rows($resultadoExistencia);
        if($existeNumero == 0):
            $sqlGeraCarrinho = "INSERT INTO rpm.carrinho VALUES(DEFAULT, $id_usuario, 0);";
            pg_query($conecta_Apeiron, $sqlGeraCarrinho);
        endif;
        pg_close($conecta_Apeiron);
        header("Location: ../index.php"); 
    else:
        $sqlAdmin = "SELECT login, senha, valido, privilegio FROM usuario WHERE login = '$nome' AND senha = '$senha' AND valido = 1 AND excluido = 'n' AND privilegio = TRUE;";
        $admin = pg_query($conecta_Apeiron, $sqlAdmin);
        $existeAdmin = pg_affected_rows($admin);
        if($existeAdmin != 0):
            header("Location: http://200.145.153.175/marcosdias/apeiron/kenzo/usuarios/");
        else:
            pg_close($conecta_Apeiron);
            header("Location: ../index.php");
        endif;
    endif;
?>
