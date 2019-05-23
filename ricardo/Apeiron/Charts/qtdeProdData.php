<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Qtde. de Produtos vendidos por dia</title>
</head>
<body>
    <canvas id="myChart"></canvas>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    <?php
    $conecta = pg_connect("host=localhost port=5432 dbname=2018_72b_Apeiron user=apeiron password=logos321");
    if(!$conecta)
    {
        echo "<script>alert('Erro com o Servidor');</script>";
        exit;
    }
    $sql = "SELECT EXTRACT(DAY FROM rpm.compra.data_compra) AS dia,EXTRACT(MONTH FROM rpm.compra.data_compra) AS mes,EXTRACT(YEAR FROM rpm.compra.data_compra) AS ano,SUM(rpm.item_compra.qtde) AS qtde  FROM rpm.compra, rpm.item_compra WHERE rpm.compra.cod = rpm.item_compra.id_compra GROUP BY data_compra ORDER BY data_compra";
    $resultado = pg_query($conecta,$sql);
    $num = pg_num_rows($resultado);
    if($num == 0)
    {
        pg_close($conecta);
        echo "<script>alert('Erro com o SELECT');</script>";
        exit;
    }
    $dias = array($num);
    $qtde = array($num);
    for($i = 0; $i < $num; $i++)
    {
        $linha = pg_fetch_array($resultado);
        $dias[$i] = $linha[0]."/".$linha[1]."/".$linha[2];
        $qtde[$i] = $linha[3];
    }
    pg_close($conecta);
    echo 
    "<script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
            labels: ['$dias[0]','$dias[1]','11/10/2018'],
            datasets: 
            [{
                label: 'Quantidade Vendida',
                data: [$qtde[0],$qtde[1],0],
                backgroundColor: [
                    'rgba(200, 33, 33, 1)',
                    'rgba(200, 33, 33, 1)',
                    'rgba(200, 33, 33, 1)'
                ],
                borderColor: [
                    'rgba(200, 33, 33, 1)',
                    'rgba(200, 33, 33, 1)',
                    'rgba(200, 33, 33, 1)'
                    
                ],
                borderWidth: 2,
                hoverBackgroundColor: ['rgba(255, 0, 0, 1)','rgba(255, 0, 0, 1)','rgba(255, 0, 0, 1)'],
                hoverBorderColor: ['rgba(255, 0, 0, 1)','rgba(255, 0, 0, 1)','rgba(255, 0, 0, 1)']
           }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});
    </script>";
    ?>
</body>
</html>