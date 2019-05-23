<?php
try {
    session_start();
    include "../util/conexao.php";
} catch (Exception $e) {
    echo 'Exceção capturada: ', $e->getMessage(), "\n";
}


// Pega extensão da imagem

$nome = preg_replace('/[^[:alpha:]_]/', ' ', $_POST['nome']);
$cod = $_POST['cod'];
$senha = md5(preg_replace('/\s+/', '', $_POST['senha']));
$email = preg_replace('/\s+/', '', $_POST['email']);
/** @var TYPE_NAME $sexo */
$sexo = $_POST['sexo'];
$data_nasc = date('Y-m-d', strtotime(str_replace("/", "-", $_POST['data_nasc'])));
$privilegio = ($_POST['privilegio'] == 't') ? 'true' : 'false';

//image stuff

//---------------------------------------------------------------------//

/* Essas rotinas recebem por POST o value "acao", para determinar Cadastro e
alteração */

// ROTINA DE  CADASTRAR

if ($_POST["acao"] == "SALVAR") {
    $sqlId = "SELECT nextval('rpm.usuario_cod_seq')";
    $resId = pg_query($conexao, $sqlId);
    $id = pg_fetch_array($resId);

    if ($_FILES['foto']['error'] == 0) {
        $ext = substr($_FILES['foto']['name'], -4);
        $destino = '../imgup/' . preg_replace('/\s+/', '', $id[0] . "_" . date("YmdHis")) . strtolower($ext);
        $arquivo_tmp = $_FILES['foto']['tmp_name'];
        $foto = $string = preg_replace('/\s+/', '', $id[0] . "_" . date("YmdHis")) . strtolower($ext);
        move_uploaded_file($arquivo_tmp, $destino);
    }

    $sql = "INSERT INTO rpm.usuario (cod,nome,senha,email,data_nasc,sexo,privilegio,foto,excluido) VALUES ";
    $sql .= "($id[0],'$nome','$senha','$email','$data_nasc','$sexo','$privilegio','$foto','false' );";
    $resultado = pg_query($conexao, $sql);
    $linhas = pg_affected_rows($resultado);
    if ($linhas > 0) {
        $_SESSION["salvo"] = "Salvo";
        header('Location: index.php');
    } else {
        echo "Erro na gravação do usuario !! <br> <br>";
        echo pg_last_error();
    }
    pg_close($conexao);

} // ROTINA DE ALTERAR
else if ($_POST["acao"] == "ALTERAR") {
    $foto_old = $_POST["foto_old"];
    $cod = $_POST['cod'];
    if ($_FILES['foto']['error'] == 0) {

        unlink('../imgup/'.$foto_old);

        $ext = substr($_FILES['foto']['name'], -4);
        $destino = '../imgup/' . preg_replace('/\s+/', '', $cod . "_" . date("YmdHis")) . strtolower($ext);
        $arquivo_tmp = $_FILES['foto']['tmp_name'];
        $foto = $string = preg_replace('/\s+/', '', $cod . "_" . date("YmdHis")) . strtolower($ext);
        move_uploaded_file($arquivo_tmp, $destino);

    } else {
        $foto = false;
    }


    $sql = "UPDATE rpm.usuario SET senha='$senha',nome='$nome',email='$email',sexo='$sexo',data_nasc='$data_nasc',
        privilegio='$privilegio'";
    $sql .= ($foto) ? ", foto='$foto' " : null;
    $sql .= " WHERE cod='$cod'";

    $resultado = pg_query($conexao, $sql);
    $linhas = pg_affected_rows($resultado);
    if ($linhas > 0) {
        move_uploaded_file($arquivo_tmp, $destino);
        //$_SESSION["salvo"] = "Alterado";
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

    $cod = base64_decode($_GET['cod']);
    $sql = "UPDATE rpm.usuario SET excluido='true', data_exclusao='" . date('Y-m-d') . "' WHERE cod='$cod'";
    $resultado = pg_query($conexao, $sql);
    header('Location:index.php');
} else if ($_GET['acao'] == "RESTAURAR") {
    $cod = base64_decode($_GET['cod']);
    $sql = "UPDATE rpm.usuario SET excluido='false', data_exclusao=NULL  WHERE cod='$cod'";
    $resultado = pg_query($conexao, $sql);
    header('Location:index.php');

}

function gravaImagem($id)
{

}
