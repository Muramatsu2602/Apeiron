﻿<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Enviando PDF</title>
</head>
<body>
    <?php
        /*Incluindo Classes*/
        include("/public_sites/marcosdias/apeiron/executa/confirmacao/mpdf60/mpdf.php");
        require_once("class.phpmailer.php");
        require_once("class.smtp.php");
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
            "<div class='row' id='data'>$linha[3]/$linha[2]/$linha[1]</div>
            <div class='row' id='descricao'>$linha[4]</div>
            <div class='row' id='num'>$str_1</div>
            <div class='row' id='num'>$str_2</div>
            <div class='row' id='num'>$saldo_str</div>
            <hr>";
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
            <div class='logo'><img src='logo.png' height='42'></div>
            <div class='empresa'>
                <strong>APEIRON LTDA - FLUXO DE CAIXA DIÁRIO</strong>
                <br><div class='valor'>Valores Expressos em Reais</div>
            </div>
            
            <div class='head'><strong>DATA</strong></div>
            <div class='head' id='descricao'><strong>DESCRIÇÃO</strong></div>
            <div class='head'><strong>ENTRADA</strong></div>
            <div class='head'><strong>SAÍDA</strong></div>
            <div class='head'><strong>SALDO</strong></div>
            <br>
            ".$string.
            "            
            <div class='row' id='data'><strong></strong></div>
            <div class='row' id='descricao'><strong>Totais</strong></div>
            <div class='row' id='num'><strong>$entrada_str</strong></div>
            <div class='row' id='num'><strong>$saida_str</strong></div>
            <div class='row' id='num'><strong>$saldo_str<strong></div>
            <hr>
            ";
        $mpdf=new mPDF(); 
        $mpdf->SetDisplayMode('fullpage');
        $css = file_get_contents("css_fluxo/estilo.css");
        $mpdf->WriteHTML($css,1);
        $mpdf->WriteHTML($html);
        //$mpdf->Output('/public_sites/ricardomello/PHP_PDF/relatorios/teste.pdf','F'); //gera o pdf pela pasta que eu dei todos os privilegios!!!!
        //chmod -R 0777 /mydirectory
        //$mpdf->Output('FluxoCaixa.pdf','D');
        $mpdf->Output();
    ?>
</body>
</html>