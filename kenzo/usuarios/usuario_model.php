<?php
try {
    session_start();
    include "../util/conexao.php";
} catch (Exception $e) {
    echo 'Exceção capturada: ', $e->getMessage(), "\n";
}

$nome = preg_replace('/[^[:alpha:]_]/', ' ', $_POST['nome']);
$cod = $_POST['cod'];
$senha = md5(preg_replace('/\s+/', '', $_POST['senha']));
$email = preg_replace('/\s+/', '', $_POST['email']);
/** @var TYPE_NAME $sexo */
$sexo = $_POST['sexo'];
$data_nasc = date('Y-m-d', strtotime(str_replace("/", "-", $_POST['data_nasc'])));
$privilegio = ($_POST['privilegio'] == 't') ? 'true' : 'false';
$hoje = date("Y-m-d");

//image stuff

//---------------------------------------------------------------------//

/* Essas rotinas recebem por POST o value "acao", para determinar Cadastro e
alteração */

// ROTINA DE  CADASTRAR

if ($_POST["acao"] == "SALVAR") {

        $sql = "INSERT INTO usuario (id_usuario,senha,login,email,privilegio,excluido,valido) VALUES ";
        $sql .= "(default,'$senha','$nome','$email','$privilegio','n','1' );";
        $resultado = pg_query($conexao, $sql);
        $linhas = pg_affected_rows($resultado);
        if ($linhas > 0) {
            $_SESSION["salvo"] = "Salvo";
            header('Location: index.php');
        } else {

            $_SESSION["duplicata"] = "Este E-mail já está sendo utilizado!";
            header('Location: iuUsuarios.php');

        }
        pg_close($conexao);

} // ROTINA DE ALTERAR
else if ($_POST["acao"] == "ALTERAR") {

    $cod = $_POST['cod'];
    $sql = "UPDATE usuario SET senha='$senha',login='$nome',email='$email', privilegio='$privilegio' ";
    $sql .= " WHERE id_usuario='$cod'";

    $resultado = pg_query($conexao, $sql);
    $linhas = pg_affected_rows($resultado);
    if ($linhas > 0) {
        $_SESSION["salvo"] = "Alterado";
        header('Location: ../usuarios/index.php');
    } else {
        echo "Erro na alteração do produto !! <br> <br>";
        echo pg_last_error();
    }
    pg_close($conexao);
    echo "Conexão encerrada";

}

//------------------------------------------------------------------------------//

/* Estas rotinas recebem por POST o value "acao", para determinar deleção e restauração */


if ($_GET['acao'] == "DELETAR") {

    $cod = $_GET['cod'];
    $sql = "UPDATE usuario SET excluido='s' , data_exclusao='$hoje'  WHERE id_usuario='$cod';";
    $resultado = pg_query($conexao, $sql);
    echo "OK";
} else if ($_GET['acao'] == "RESTAURAR") {
    $cod = $_GET['cod'];
    $sql = "UPDATE usuario SET excluido='n', data_exclusao=null    WHERE id_usuario='$cod';";
    $resultado = pg_query($conexao, $sql);
    echo "OK";
    header('Location:index.php');

}

function gravaImagem($id)
{

}
