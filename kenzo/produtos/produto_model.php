<?php
try {
    session_start();
    include "../util/conexao_produtos.php";
} catch (Exception $e) {
    echo 'Exceção capturada: ', $e->getMessage(), "\n";
}


// Pega extensão da imagem

$cod = $_POST['cod'];
$nome = preg_replace('/[^[:alpha:]_]/', ' ', $_POST['nome']);
$detalhes =   $_POST['detalhes'];
$preco = $_POST['preco'];
$categoria =preg_replace('/[^[:alpha:]_]/', ' ', $_POST['categoria']);
$estoque = $_POST['estoque'];
$cor = preg_replace('/[^[:alpha:]_]/', ' ', $_POST['cor']);
$hoje = date("Y-m-d");
//image stuff

//---------------------------------------------------------------------//

/* Essas rotinas recebem por POST o value "acao", para determinar Cadastro e
alteração */

// ROTINA DE  CADASTRAR

if ($_POST["acao"] == "SALVAR") {
    $sqlId = "SELECT nextval('rpm.produto_cod_seq')";
    $resId = pg_query($conexao, $sqlId);
    $id = pg_fetch_array($resId);

    if ($_FILES['foto']['error'] == 0) {
        /** @var TYPE_NAME $ext */
        $ext = substr($_FILES['foto']['name'], -4);
        $destino = '../imgup/'.$nome . strtolower($ext);
        $arquivo_tmp = $_FILES['foto']['tmp_name'];
        $foto = $string =  $nome.strtolower($ext);
        move_uploaded_file($arquivo_tmp, $destino);
    }

    $sql = "  INSERT INTO rpm.produto(cod,nome,detalhes,preco,categoria,estoque,excluido,foto,cor) VALUES (";
    $sql .= "$id[0],'$nome','$detalhes',$preco,'$categoria',$estoque,'false','$foto','$cor')";
    $resultado = pg_query($conexao, $sql);
    $linhas = pg_affected_rows($resultado);
    if ($linhas > 0) {
        $_SESSION["salvo"] = "Salvo";
        header('Location: index.php');
    } else {
        echo "Erro na gravação do produto !! <br> <br>";
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
        $destino = '../imgup/'.$nome . strtolower($ext);
        $arquivo_tmp = $_FILES['foto']['tmp_name'];
        $foto = $string =  $nome.strtolower($ext);
        move_uploaded_file($arquivo_tmp, $destino);

    } else {
        $foto = false;
    }

    $sql = "UPDATE rpm.produto SET nome='$nome',detalhes='$detalhes',preco='$preco',categoria='$categoria',estoque='$estoque',
        cor='$cor'";
    $sql .= ($foto) ? ", foto='$foto' " : null;
    $sql .= " WHERE cod='$cod'";

    $resultado = pg_query($conexao, $sql);
    $linhas = pg_affected_rows($resultado);
    if ($linhas > 0) {
        move_uploaded_file($arquivo_tmp, $destino);
        $_SESSION["salvo"] = "Alterado";
        header('Location: ../produtos/index.php');
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

    /*
    $sql_data = "SELECT CURDATE();";
    $query = pg_query($conexao, $sql_data);
    $mostra_data = pg_fetch_array($query);
    $sql = "UPDATE rpm.produto SET excluido='true', data_exclusao='" . date($mostra_datadate,'Y-m-d') . "' WHERE cod='$cod'";
    */
    $sql = "UPDATE rpm.produto SET excluido='true', data_exclusao='$hoje'  WHERE cod='$cod'";
    $conexao_prod = pg_connect("host=localhost port=5432 dbname=2018_72b_Apeiron user=apeiron password=logos321");
    $resultado = pg_query($conexao_prod, $sql);

    header('Location:index.php');
} else if ($_GET['acao'] == "RESTAURAR") {
    $cod = $_GET['cod'];
    /*
     * $sql = "UPDATE rpm.produto SET excluido='false', data_exclusao=NULL  WHERE cod='$cod'";
     * */
    $sql = "UPDATE rpm.produto SET excluido='false',data_exclusao=NULL   WHERE cod='$cod'";
    $resultado = pg_query($conexao, $sql);
    header('Location:index.php');

}

function gravaImagem($id)
{

}
