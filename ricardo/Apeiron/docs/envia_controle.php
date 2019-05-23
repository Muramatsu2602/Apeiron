<!DOCTYPE html>
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
        $email = "ricdemello1@gmail.com";
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
                "<div class='row' id='data'>$linha[3]/$linha[2]/$linha[1]</div>
                <div class='row' id='descricao'>$linha[4]</div>
                <div class='row' id='num'>$linha[5]</div>
                <div class='row' id='num'>$linha[6]</div>
                <div class='row' id='num'>$saldo</div>
                <div class='row' id='num'>$str_l7</div>
                <div class='row' id='num'>$cust</div>
                <div class='row' id='num'>$cust</div>
                <hr>";
                $tot = $linha[7]*$saldo;
                continue;
            }
            $custo = $linha[6]*$linha[7];
            $tot -= $custo;
            $custo_str = number_format($custo,2,',',' ');
            $tot_str = number_format($tot,2,',',' ');
            $string .= 
                "<div class='row' id='data'>$linha[3]/$linha[2]/$linha[1]</div>
                <div class='row' id='descricao'>$linha[4]</div>
                <div class='row' id='num'>$linha[5]</div>
                <div class='row' id='num'>$linha[6]</div>
                <div class='row' id='num'>$saldo</div>
                <div class='row' id='num'>$str_l7</div>
                <div class='row' id='num'>$custo_str</div>
                <div class='row' id='num'>$tot_str</div>
                <hr>";
           
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
            <div class='logo'><img src='logo.png' height='42'></div>
            <div class='empresa'>
                <strong>APEIRON LTDA - CONTROLE DE ESTOQUE</strong>
                <br><div class='valor'>Valores Expressos em Reais</div>
                    <div class='valor' id='item'>Item 01.0001 - <strong>Botton<strong></div>
            </div>
            
            <div class='head'><strong>DATA</strong></div>
            <div class='head' id='descricao'><strong>HISTÓRICO</strong></div>
            <div class='head'><strong>ENTRADA</strong></div>
            <div class='head'><strong>SAÍDA</strong></div>
            <div class='head'><strong>SALDO</strong></div>
            <div class='head'><strong>CUSTO UNI.</strong></div>
            <div class='head'><strong>CUSTO TOT.</strong></div>
            <div class='head'><strong>VALOR</strong></div>
            <br>
            ".$string.
            "            
            <div class='row' id='data'><strong></strong></div>
            <div class='row' id='descricao'><strong>Totais</strong></div>
            <div class='row' id='num'><strong>$entrada</strong></div>
            <div class='row' id='num'><strong>$saida</strong></div>
            <div class='row' id='num'><strong>$saldo<strong></div>
            <div class='row' id='num'><strong><strong></div>
            <div class='row' id='num'><strong><strong></div>
            <div class='row' id='num'><strong>$tot_str<strong></div>
            <hr>
            ";
        $mpdf=new mPDF(); 
        $mpdf->SetDisplayMode('fullpage');
        $css = file_get_contents("css_controle/estilo.css");
        $mpdf->WriteHTML($css,1);
        $mpdf->WriteHTML($html);
        $mpdf->Output('/public_sites/ricardomello/Apeiron/docs/pdf/ControleEstoque.pdf','F');//usei comando acima no putty para abrir os privilégios(o diretorio eh o que contém a base dos arquivos php, no caso chmod -R 0777 /public_sites/ricardomello/send_vitor)
        /*Enviando por email*/
        $mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->SMTPDebug = 0; 
		$mail->SMTPAuth = true;	
		$mail->SMTPSecure = 'ssl';
        $mail->Host = 'smtp.gmail.com'; 
		$mail->Port = 465;
		$mail->SMTPAuth = true; 
        $mail->Username = 'apeironnoresponse@gmail.com';//já configurei!!! 
        $mail->Password = 'logos321';
		$mail->SetFrom('apeironnoresponse@gmail.com','APEIRON'); 
		$mail->AddAddress($email,"Professora Jovita"); //Muda Aqui para as variaveis que vem do SELECT
        $mail->IsHTML(true); 
        $mail->CharSet = 'utf-8'; 
        $mail->Subject  = "Envio do Controle de Estoque - APEIRON"; // Assunto da mensagem
        $mail->Body .= "Prezada Professora,<br><br>Segue, em anexo, o controle de estoque referente à semana do colégio.<br><br>Cordialmente, Equipe Apeiron";     
        $mail->addAttachment("pdf/ControleEstoque.pdf"); 
        $enviado = $mail->Send();
        $mail->ClearAllRecipients();
        $mail->ClearAttachments();
        if (!$enviado) 
        {
            echo "<script>alert('Falha ao enviar o Email');</script>";
		
        } 
        echo "<script>window.close();</script>";
    ?>
</body>
</html>