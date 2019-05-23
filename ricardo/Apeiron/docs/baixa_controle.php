<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Enviando PDF</title>
</head>
<body>
    <?php
    
        $saldo = 0;
        $entrada = 0;
        $saida = 0;
        $tot = 0;
        $string;
        $conecta = pg_connect("host = localhost port=5432 dbname=2018_72b_Apeiron user=apeiron password=logos321");
        if(!$conecta)
        {
            echo "<script>alert('Problemas com o Servidor');</script>";
            exit;
        }
        $sql = "SELECT data,EXTRACT(YEAR FROM data) as ano, EXTRACT(MONTH FROM data) as mes, EXTRACT(DAY FROM data) as dia, historico,entrada,saida,custo_uni FROM rpm.controle_estoque ORDER BY data";
        $resultado = pg_query($conecta,$sql);
        $num = pg_num_rows($resultado);
        if($num == 0)
        {
            pg_close($conecta);
            echo "<script>alert('Erro no Servidor');</script>";
            exit;
        }
        for($i = 0; $i < $num; $i++)
        {
            $linha = pg_fetch_array($resultado);
            $saldo += $linha[5];
            $saldo -= $linha[6];
            $entrada += $linha[5];
            $saida += $linha[6];
            $str_l7 = number_format($linha[7],2,',',' ');
            if($i == 0)
            {
                $cust = number_format($linha[7]*$saldo,2,',',' ');
                 $string .= 
                "<tr>
                <td>$linha[3]/$linha[2]/$linha[1]</td>
                <td>$linha[4]</td>
                <td>$linha[5]</td>
                <td>$linha[6]</td>
                <td>$saldo</td>
                <td>$str_l7</td>
                <td>$cust</td>
                <td>$cust</td>
                </tr>";
                $tot = $linha[7]*$saldo;
                continue;
            }
            $custo = $linha[6]*$linha[7];
            $tot -= $custo;
            $custo_str = number_format($custo,2,',',' ');
            $tot_str = number_format($tot,2,',',' ');
            $string .= 
                "<tr>
                <td>$linha[3]/$linha[2]/$linha[1]</td>
                <td>$linha[4]</td>
                <td>$linha[5]</td>
                <td>$linha[6]</td>
                <td>$saldo</td>
                <td>$str_l7</td>
                <td>$custo_str</td>
                <td>$tot_str</td>
                </tr>";
           
        }
        /*$resul = pg_query($conecta,"SELECT EXTRACT(YEAR FROM CAST(NOW() as DATE)),EXTRACT(MONTH FROM CAST(NOW() as DATE)),EXTRACT(DAY FROM CAST(NOW() as DATE))");
        $num = pg_num_rows($resul);
        if($num == 0)
        {
            pg_close($conecta);
            echo "<script>alert('Erro no Servidor');</script>";
            exit;
        }
        $row = pg_fetch_array($resul);*/
        pg_close($conecta);
        /*Gerando pdf com html*/
        $html = "
        <table>
            <tr>
            <td colspan='8'>
                <strong>APEIRON LTDA - CONTROLE DE ESTOQUE</strong>
                (Valores Expressos em Reais)
                Item 01.0001 - <strong>Botton<strong>
            </td>
            </tr>
            <tr>
            <td><strong>DATA</strong></td>
            <td><strong>HISTÓRICO</strong></td>
            <td><strong>ENTRADA</strong></td>
            <td><strong>SAÍDA</strong></td>
            <td><strong>SALDO</strong></td>
            <td><strong>CUSTO UNI.</strong></td>
            <td><strong>CUSTO TOT.</strong></td>
            <td><strong>VALOR</strong></td>
            </tr>
            ".$string.
            "   
            <tr>
            <td><strong></strong></td>
            <td><strong>Totais</strong></td>
            <td><strong>$entrada</strong></td>
            <td><strong>$saida</strong></td>
            <td><strong>$saldo<strong></td>
            <td><strong><strong></td>
            <td><strong><strong></td>
            <td><strong>$tot_str<strong></td>
            </tr>
            </table>
            ";
    $arquivo = "controle_estoque.xls"; 
    header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
    header ("Cache-Control: no-cache, must-revalidate");
    header ("Pragma: no-cache");
    header ("Content-type: application/x-msexcel");
    header ("Content-Disposition: attachment; filename=\"{$arquivo}\"" );
    header ("Content-Description: PHP Generated Data" );
    echo $html;
    ?>
</body>
</html>