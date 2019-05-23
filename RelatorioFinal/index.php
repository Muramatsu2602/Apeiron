<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Formatando o PDF</title>
</head>
<body>
     <?php 
        include("mpdf60/mpdf.php");

        $html = '
        <div class="cabecalho">
            <img src="relatorios/cti.jpg" class="cti">
            <img src="relatorios/unesp.png" class="unesp">
        </div>
        <fieldset id="capa">
            <h1><b>COLÉGIO TÉCNICO INDUSTRIAL "PROF. ISAAC PORTAL ROLDÁN"<br>UNESP - CAMPUS BAURU SP<b></h1>
        </fieldset>
        ';

        // Gera pdf
        $mpdf=new mPDF(); 
        $mpdf->SetDisplayMode('fullpage');
        $css = file_get_contents("css/estilo.css");
        $mpdf->WriteHTML($css,1);
        $mpdf->WriteHTML($html);
        $mpdf->Output();
     ?>
</body>
</html>
