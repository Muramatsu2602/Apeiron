<?php
    session_start();
    $sql = "host = localhost port=5432 dbname=2018_72b_Apeiron user=apeiron password=logos321";
    $conecta = pg_connect($sql);
    $id = $_SESSION['id']; //Muda aqui id do usuário!!!
    $sql_2 = "SELECT nome,sobrenome FROM cliente WHERE id_usuario = $id";
    $resultado = pg_query($conecta,$sql_2);
    $num = pg_num_rows($resultado);
    $sql1 = "host = localhost port=5432 dbname=2018_72b_Apeiron user=apeiron password=logos321";
    $conecta2 = pg_connect($sql1);
    $sqlBuscaIdCompra = "SELECT cod FROM rpm.compra WHERE cod_usuario = $id";
    $resultadoBuscaIdCompra = pg_query($conecta2, $sqlBuscaIdCompra);
    $idCompra = pg_fetch_array($resultadoBuscaIdCompra);
    $id2 = $idCompra['cod']; //Muda aqui id da compra!!!
    $sql3 = "SELECT rpm.compra.total,rpm.produto.nome,rpm.item_compra.valor,EXTRACT(DAY FROM rpm.compra.data_compra) as Dia,EXTRACT(MONTH FROM rpm.compra.data_compra) as Mes,EXTRACT(YEAR FROM rpm.compra.data_compra) as Ano,rpm.produto.preco,rpm.item_compra.qtde FROM rpm.compra,rpm.item_compra,rpm.produto WHERE rpm.item_compra.id_compra = rpm.compra.cod AND rpm.item_compra.cod_produto = rpm.produto.cod AND id_compra = $id2";
    $resultado2 = pg_query($conecta2,$sql3);
    $num2 = pg_num_rows($resultado2);
    //$linha2 = pg_fetch_array($resultado2); //pega por linha!!!
    $sqlmail = "SELECT email FROM usuario WHERE id_usuario = $id";
    $resultadomail = pg_query($conecta,$sqlmail);
    $nummail = pg_num_rows($resultadomail);
    $sql_preco = "SELECT SUM(rpm.item_compra.valor) AS SOMA FROM rpm.compra, rpm.item_compra WHERE rpm.compra.cod = rpm.item_compra.id_compra AND rpm.compra.cod = $id2 GROUP BY rpm.compra.cod";
    $resul_preco = pg_query($conecta2,$sql_preco);
    $num_preco = pg_num_rows($resul_preco);
    pg_close($conecta);
    pg_close($conecta2);
    //echo "<br>".$linha2[1];
?>