<?php
    session_start();
    include "conectarApeiron.php";
    $codProduto = $_POST['codProduto'];
    $valorMaxEstoque = $_POST['valorMaxEstoque'];
    $sqlBuscaCodCarrinho = "SELECT cod FROM rpm.carrinho WHERE cod_usu =".$_SESSION['id'].";";
    $resultado = pg_query($conecta_Apeiron, $sqlBuscaCodCarrinho);
    $linha = pg_fetch_array($resultado);
    /*atualiza o rpm.produto(estoque)*/
    $sqlBuscaQtd = "SELECT qtde FROM rpm.item_carrinho WHERE id_carrinho = ".$linha['cod']." AND cod_produto = $codProduto";
    $resultadoBuscaQtd = pg_query($conecta_Apeiron, $sqlBuscaQtd);
    $valor = pg_fetch_array($resultadoBuscaQtd);
    $novo = $valorMaxEstoque + $valor['qtde'];
    $sqlNovoEstoque = "UPDATE rpm.produto SET estoque = $novo WHERE cod = $codProduto;";
    pg_query($conecta_Apeiron, $sqlNovoEstoque);
    /*exclui o item do carrinho*/
    $sqlExclui = "DELETE FROM rpm.item_carrinho WHERE id_carrinho = ".$linha['cod']." AND cod_produto = $codProduto;";
    pg_query($conecta_Apeiron, $sqlExclui);
    /*atualiza carrinho*/
    $buscaPrecoCarrinho = "SELECT Sum(item_carrinho.valor) FROM rpm.item_carrinho WHERE id_carrinho= ".$linha['cod'].";";
    $resultadoPrecoCarrinho = pg_query($conecta_Apeiron, $buscaPrecoCarrinho);
    $totalCarrinho = pg_fetch_array($resultadoPrecoCarrinho);
    $novoPreco = $totalCarrinho['sum'];
    if($novoPreco == NULL)
        $novoPreco = 0;
    $sqlPrecoCarrinho = "UPDATE rpm.carrinho SET total = $novoPreco WHERE cod = ".$linha['cod'].";";
    pg_query($conecta_Apeiron, $sqlPrecoCarrinho);
    pg_close($conecta_Apeiron);
?>