<?php
    session_start();
    include "conectarApeiron.php";
    /*BUSCA ID DO CARRINHO*/
    $sqlBuscaCodCarrinho = "SELECT cod FROM rpm.carrinho WHERE cod_usu =".$_SESSION['id'].";";
    $resultado = pg_query($conecta_Apeiron, $sqlBuscaCodCarrinho);
    $linha = pg_fetch_array($resultado);
    /**/
    /*   ATUALIZA O VALOR DO ESTOQUE   */
    $sqlBusca = "SELECT * FROM rpm.item_carrinho WHERE id_carrinho = ".$linha['cod'].";";
    $resultadoBusca = pg_query($conecta_Apeiron, $sqlBusca);
    while($valoresItem_carrinho = pg_fetch_array($resultadoBusca)):
        /* PEGA O VALOR DO ESTOQUE*/
        $sqlValorMaxEstoque = "SELECT estoque FROM rpm.produto WHERE cod =".$valoresItem_carrinho['cod_produto'].";";
        $resultadoBuscaMaxEstoque = pg_query($conecta_Apeiron, $sqlValorMaxEstoque);
        $valorMaxEstoque = pg_fetch_array($resultadoBuscaMaxEstoque);
        /**/
        $novo = $valorMaxEstoque['estoque'] + $valoresItem_carrinho['qtde'];
        $sqlNovoEstoque = "UPDATE rpm.produto SET estoque = $novo WHERE cod =".$valoresItem_carrinho['cod_produto'].";";
        pg_query($conecta_Apeiron, $sqlNovoEstoque);
    endwhile;
    /**/
    /*DELETA O CARRINHO*/
    $sqlExclui = "DELETE FROM rpm.item_carrinho WHERE id_carrinho = ".$linha['cod'].";";
    pg_query($conecta_Apeiron, $sqlExclui);
    echo "Seu carrinho está vazio";
    /*ATUALIZA O VALOR DO CARRINHO*/
    $sqlMudaCarrinho = "UPDATE rpm.carrinho SET total = 0 WHERE cod_usu = ".$_SESSION['id'].";";
    pg_query($conecta_Apeiron, $sqlMudaCarrinho);
    /**/
    pg_close($conecta_Apeiron);
?>