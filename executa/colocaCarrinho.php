<?php
    session_start();
    include "conectarApeiron.php";
    $qtd = $_POST['quantidade'];
    $codProduto = $_POST['codProduto'];
    /*   PEGA O PREÇO DE MANEIRA GENERICA  */
    $sqlBuscaPreco = "SELECT preco FROM rpm.produto WHERE cod = $codProduto";
    $resultadoBuscaPreco = pg_query($conecta_Apeiron, $sqlBuscaPreco);
    $valorQtde = pg_fetch_array($resultadoBuscaPreco);
    /**/
    $valor = $qtd * $valorQtde['preco'];
    $sqlBuscaCodCarrinho = "SELECT cod FROM rpm.carrinho WHERE cod_usu =".$_SESSION['id'].";";
    $resultado = pg_query($conecta_Apeiron, $sqlBuscaCodCarrinho);
    $linha = pg_fetch_array($resultado);
    $valorMaxEstoque = $_POST['valorMaxEstoque'];
    /*VEREFICA SE JÁ EXISTE ESSE ITEM CARRINHO*/
    $existeItemCarrinho = (isset($_POST['e?carrinho']))? ($_POST['e?carrinho']) : false;
    if($existeItemCarrinho):
        /*atualiza rpm.produtos(estoque)*/
        $sqlBuscaQtdItemCarrinho = "SELECT qtde FROM rpm.item_carrinho WHERE id_carrinho =".$linha['cod']." AND cod_produto = $codProduto";
        $resultadoBuscaQtdItemCarrinho = pg_query($conecta_Apeiron, $sqlBuscaQtdItemCarrinho);
        $valorQtde = pg_fetch_array($resultadoBuscaQtdItemCarrinho);
        $novo = $valorQtde['qtde'] - $qtd;
        $novoEstoque = $valorMaxEstoque + $novo;
        $sqlMudaEstoque = "UPDATE rpm.produto SET estoque = $novoEstoque WHERE cod = $codProduto";
        pg_query($conecta_Apeiron, $sqlMudaEstoque);
        /*atualiza rpm.itemCarrinho*/
        $sqlAtulizaItemCarrinho = "UPDATE rpm.item_carrinho SET qtde = $qtd, valor = $valor WHERE cod_produto = $codProduto AND id_carrinho =".$linha['cod'].";";
        $resultadoAtulizaItemCarrinho = pg_query($conecta_Apeiron, $sqlAtulizaItemCarrinho);
        $verificaFuncionamentoAtulizaItemCarrinho = pg_affected_rows($resultadoAtulizaItemCarrinho);
        if($verificaFuncionamentoAtulizaItemCarrinho > 0):
            echo "Carrinho atualizado!";
        else:
            echo "Não está no carrinho!";
        endif;
    else:
        /*insere no rpm.item_carrinho*/
        $sqlInsere= "INSERT INTO rpm.item_carrinho VALUES(DEFAULT, ".$linha['cod'].", $codProduto, $qtd,$valor);";
        $resultadoInsert = pg_query($conecta_Apeiron, $sqlInsere);
        $verificaFuncionamento = pg_affected_rows($resultadoInsert);
        /*atualiza rpm.produtos(estoque)*/
        $qtdAtualizada = $valorMaxEstoque - $qtd;
        $sqlMudaEstoque = "UPDATE rpm.produto SET estoque = $qtdAtualizada WHERE cod = $codProduto";
        pg_query($conecta_Apeiron, $sqlMudaEstoque);
        /*verefica o funcionamento*/
        if($verificaFuncionamento > 0):
            echo "Está no carrinho!";
        else:
            echo "Não está no carrinho!";
        endif;
    endif;
    $buscaPrecoCarrinho = "SELECT Sum(item_carrinho.valor) FROM rpm.item_carrinho WHERE id_carrinho= ".$linha['cod'].";";
    $resultadoPrecoCarrinho = pg_query($conecta_Apeiron, $buscaPrecoCarrinho);
    $totalCarrinho = pg_fetch_array($resultadoPrecoCarrinho);
    $sqlColocaCarrinho = "UPDATE rpm.carrinho SET total = ".$totalCarrinho['sum']." WHERE cod 
    = ".$linha['cod'].";";
    pg_query($conecta_Apeiron, $sqlColocaCarrinho);
    pg_close($conecta_Apeiron);
?>