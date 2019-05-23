    <?php
        /*Incluindo Classes*/
        include "sql.php";
        include("mpdf60/mpdf.php");
        require_once("class.phpmailer.php");
        require_once("class.smtp.php"); 
        $dia;
        $mes;
        $ano;
        $strmes;
        $total;
        $produto;
        $preco;
        $ht;
        for($i=0; $i < $num2; $i++)
        {
            $linha = pg_fetch_array($resultado2);
            $dia = $linha[3];
            $mes = $linha[4];
            $ano = $linha[5];
            $total = $linha[0];
            $nome = $linha[1];
            $preco = $linha[2];
            $qtde =$linha[7];
            $prec = $linha[6];
            $prec_str = number_format($prec,2,',',' ');
            $preco_str = number_format($preco,2,',',' ');
            $ht .= "   <div class='left'>$nome</div>
                     <div class='right'><div class='uni'>$prec_str R$</div>  <div class='uni'>$qtde</div>   <div class='uni'> $preco_str R$</div></div>";
        }
        $linha1 = pg_fetch_array($resultado);
        $nome = $linha1[0];
        $sobrenome = $linha1[1];
        $linhamail = pg_fetch_array($resultadomail);
        $email = $linhamail[0];
        switch ($mes)
        {
                case 1:
                        $strmes = "janeiro";
                        break;
                case 2:
                        $strmes = "fevereiro";
                        break;
                case 3:
                        $strmes = "março";
                        break;
                case 4:
                        $strmes = "abril";
                        break;
                case 5:
                        $strmes = "maio";
                        break;
                case 6:
                        $strmes = "junho";
                        break;
                case 7:
                        $strmes = "julho";
                        break;
                case 8:
                        $strmes = "agosto";
                        break;
                case 9:
                        $strmes = "setembro";
                        break;
                case 10:
                        $strmes = "outubro";
                        break;
                case 11:
                        $strmes = "novembro";
                        break;
                case 12:
                        $strmes = "dezembro";
                        break;
        }
        $valor = pg_fetch_array($resul_preco);
        Shtml;
        $desc = $valor[0] - $total;
        $desc_str = number_format($desc,2,',',' ');
        $total_str = number_format($total,2,',',' ');
        $valor_str = number_format($valor[0],2,',',' ');
        if(!($valor[0] > $total))
        {
            $html = "
        <fieldset>
            <h1>Confirmação de Compra</h1>
            <p class='center sub-titulo'>Apeiron LTDA - XXVI Semana do Colégio</p>
            <div class='left'><strong>Produto<strong></div>
            <div class='right'><div class='uni'><strong>Preço Uni.<strong></div>   <div class='uni'><strong>Quantidade<strong></div>   <div class='uni'>        <strong>Preço Tot.<strong></div></div><br><br>"
            .$ht.
            "<br><br><p class='direita'><font color='red'><strong>Total: $total_str R$<strong></font></p>
            <p>Agradecemos ao(a) cliente $nome $sobrenome</p>
            <p class='direita'>Bauru, $dia de $strmes de $ano</p>
        </fieldset>
            ";
        }
        else
        {
            $html = "
        <fieldset>
            <h1>Confirmação de Compra</h1>
            <p class='center sub-titulo'>Apeiron LTDA - XXVI Semana do Colégio</p>
            <div class='left'><strong>Produto<strong></div>
            <div class='right'><div class='uni'><strong>Preço Uni.<strong></div>   <div class='uni'><strong>Quantidade<strong></div>   <div class='uni'>        <strong>Preço Tot.<strong></div></div><br><br>"
            .$ht.
            "<br><br><div id='direita'><strong>Soma:</strong> $valor_str R$</div>
            <br><div id='direita'><strong>Desc.:</strong> $desc_str R$</div>
            <br><div id='direita'><font color='red'><strong>Total: $total_str R$<strong></font></div>
            <br><p>Agradecemos ao(a) cliente $nome $sobrenome</p>
            <p class='direita'>Bauru, $dia de $strmes de $ano</p>
        </fieldset>
            ";          
        }
        /*Gerando pdf com html*/

        $mpdf=new mPDF(); 
        $mpdf->SetDisplayMode('fullpage');
        $css = file_get_contents("/public_sites/marcosdias/apeiron/executa/confirmacao/css/estilo.css");
        $mpdf->WriteHTML($css,1);
        $mpdf->WriteHTML($html);
        //$mpdf->Output('/public_sites/ricardomello/PHP_PDF/relatorios/teste.pdf','F'); //gera o pdf pela pasta que eu dei todos os privilegios!!!!
        //chmod -R 0777 /mydirectory
        //$mpdf->Output();
        $s = "/public_sites/marcosdias/apeiron/executa/confirmacao/pdf/$id2.pdf";
        $mpdf->Output($s,'F');//usei comando acima no putty para abrir os privilégios(o diretorio eh o que contém a base dos arquivos php, no caso chmod -R 0777 /public_sites/ricardomello/send_vitor)
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
		$mail->AddAddress($email,$nome.$sobrenome); //Muda Aqui para as variaveis que vem do SELECT
        $mail->IsHTML(true); 
        $mail->CharSet = 'utf-8'; 
        $mail->Subject  = "Confirmação de Compra - APEIRON"; // Assunto da mensagem
        $mail->Body .= "Prezado Cliente,<br><br>Segue, em anexo, seu comprovante<br><br>Cordialmente, Equipe Apeiron.";     
        $mail->addAttachment("/public_sites/marcosdias/apeiron/executa/confirmacao/pdf/$id2.pdf"); 
        $enviado = $mail->Send();
        $mail->ClearAllRecipients();
        $mail->ClearAttachments();
        if (!$enviado) 
        {
            echo "<script>alert('Falha ao enviar o Email');</script>";
		
        } 
        
    ?>
       