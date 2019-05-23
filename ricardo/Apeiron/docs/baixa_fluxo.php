<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Enviando PDF</title>
</head>
<body>
    <?php
        /*Incluindo Classes*/
        $string;
        $saldo = 0;
        $entrada = 0;
        $saida = 0;
        $saldo_str;
        $conecta = pg_connect("host = localhost port=5432 dbname=2018_72b_Apeiron user=apeiron password=logos321");
        if(!$conecta)
        {
            echo "<script>alert('Problemas com o Servidor');</script>";
            exit;
        }
        $sql = "SELECT data,EXTRACT(YEAR FROM data) as ano, EXTRACT(MONTH FROM data) as mes, EXTRACT(DAY FROM data) as dia, descricao,entrada,saida FROM rpm.fluxo_caixa ORDER BY data";
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
            $str_1 = number_format($linha[5],2, ',', ' ');
            $str_2 = number_format($linha[6],2, ',', ' ');
            $saldo_str = number_format($saldo,2, ',', ' ');
            $string .= 
            "<tr>
            <td>$linha[3]/$linha[2]/$linha[1]</td>
            <td>$linha[4]</td>
            <td>$str_1</td>
            <td>$str_2</td>
            <td>$saldo_str</td>
            </tr>";
        }
        $saldo_str = number_format($saldo,2, ',', ' ');
        $entrada_str = number_format($entrada,2, ',', ' ');
        $saida_str = number_format($saida,2, ',', ' ');
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
                <td colspan='5'>
                <strong>APEIRON LTDA - FLUXO DE CAIXA DIÁRIO</strong>
                 (Valores Expressos em Reais)
                </td>
            </tr>
            <tr>
            <td><strong>DATA</strong></td>
            <td><strong>DESCRIÇÃO</strong></td>
            <td><strong>ENTRADA</strong></td>
            <td><strong>SAÍDA</strong></td>
            <td><strong>SALDO</strong></td>
            </tr>
            ".$string.
            " 
            <tr>
            <td><strong></strong></td>
            <td><strong>Totais</strong></td>
            <td><strong>$entrada_str</strong></td>
            <td><strong>$saida_str</strong></td>
            <td><strong>$saldo_str<strong></td>
            </tr>
        </table>
            ";
    $arquivo = "fluxo_caixa.xls"; 
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