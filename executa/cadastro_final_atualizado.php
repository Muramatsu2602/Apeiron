<?php
    session_start();
    include "conectarApeiron.php";
    $id = $_SESSION['id'];
    $novo = (isset($_POST['novo']))? ($_POST['novo']) : false;
    if($novo):
        $telefone = $_POST['telefone'];
        $celular = $_POST['celular'];
        $endereco = $_POST['endereco'];
        $numero = $_POST['numero'];
        $complemento = $_POST['complemento'];
        $bairro = $_POST['bairro'];
        $CEP = $_POST['CEP'];
        $cidade = $_POST['cidade'];
        $estado = $_POST['estados'];
        $pais = $_POST['pais'];
        $sql_endereco="INSERT INTO endereco VALUES( DEFAULT, $id, '$endereco', '$numero', '$complemento', '$bairro', '$CEP', '$cidade','$estado', '$pais', 'n', NULL)";
        pg_query($conecta_Apeiron, $sql_endereco);
    endif;
    /* COLOCA EM COMPRA*/
    $sqlPegaValorCarrinho = "SELECT total FROM rpm.carrinho WHERE cod_usu = $id";
    $resultadoPegaValorCarrinho = pg_query($conecta_Apeiron, $sqlPegaValorCarrinho);
    $valorCarrinho = pg_fetch_array($resultadoPegaValorCarrinho);
    /**/
    $vereficaMetodo = (isset($_POST['endereco']))? true : false;
    if($vereficaMetodo):
        $idEndereco = $_POST['endereco'];
    else:
        $sqlBuscaIdEndereco = "SELECT id_endereco FROM endereco WHERE id_usuario = $id ORDER BY id_endereco DESC";
        $resultadosqlBuscaIdEndereco = pg_query($conecta_Apeiron, $sqlBuscaIdEndereco);
        $idEndereco = pg_fetch_array($resultadosqlBuscaIdEndereco);
    endif;
    /**/
    $sqlBuscaData = "SELECT CAST(NOW() AS DATE);";
    $resultadoBuscaData = pg_query($conecta_Apeiron, $sqlBuscaData);
    $data = pg_fetch_array($resultadoBuscaData);
    $dataa = $data['now'];
    if($vereficaMetodo):
        $sqlColocaCompra = "INSERT INTO rpm.compra VALUES( DEFAULT, $id, ".$valorCarrinho['total'].", ".$idEndereco.", '$dataa');";
    else:
        $sqlColocaCompra = "INSERT INTO rpm.compra VALUES( DEFAULT, $id, ".$valorCarrinho['total'].", ".$idEndereco['id_endereco'].", '$dataa');";
    endif;
    pg_query($conecta_Apeiron, $sqlColocaCompra);
    /**/
    /* COLOCA item.compra */
    $sqlBuscaCodCarrinho = "SELECT cod FROM rpm.carrinho WHERE cod_usu =".$_SESSION['id'].";";
    $resultado = pg_query($conecta_Apeiron, $sqlBuscaCodCarrinho);
    $linhaa = pg_fetch_array($resultado);
    /*pegando cod de compra*/
    $sqlBuscaCodCompra = "SELECT cod FROM rpm.compra WHERE cod_usuario =".$_SESSION['id'].";";
    $resultadoBuscaCodCompra = pg_query($conecta_Apeiron, $sqlBuscaCodCompra);
    $codCompra = pg_fetch_array($resultadoBuscaCodCompra);
    $sqlTabelaItemCarrinho = "SELECT * FROM rpm.item_carrinho WHERE id_carrinho =".$linhaa['cod'].";";
    $resultadoItemCarrinho = pg_query($conecta_Apeiron, $sqlTabelaItemCarrinho);
    while($itemCarrinho = pg_fetch_array($resultadoItemCarrinho)):
        $sqlColocaItemCompra = "INSERT INTO rpm.item_compra VALUES(DEFAULT, ".$codCompra['cod'].", ".$itemCarrinho['cod_produto'].", ".$itemCarrinho['qtde'].", ".$itemCarrinho['valor'].");";
        pg_query($conecta_Apeiron, $sqlColocaItemCompra);
    endwhile;
    /**/
    /*  APAGA rpm.item_carrinho */
   
    $sqlApagaItem_Carrinho = "DELETE FROM rpm.item_carrinho WHERE id_carrinho =".$linhaa['cod'].";";
    pg_query($conecta_Apeiron, $sqlApagaItem_Carrinho);
    pg_close($conecta_Apeiron);
    /**/
    include "confirmacao/send.php";
    ?>
        <article class="finalizado">
        <p>SUA COMPRA FOI FINALIZADA.</p>
        <i class="fas fa-shopping-bag"></i>
        <P>VERIFIQUE O SEU EMAIL.</P>
        <script src="js/compra.js" type="text/javascript"></script>
    </article>
    <?php
?>