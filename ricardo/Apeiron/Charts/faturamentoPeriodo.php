<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Faturamento Durante a Semana</title>
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
    $sql = "SELECT EXTRACT(DAY FROM data_compra) AS dia,EXTRACT(MONTH FROM data_compra) AS mes,EXTRACT(YEAR FROM data_compra) AS ano,SUM(total) AS total  FROM rpm.compra GROUP BY data_compra ORDER BY data_compra";
    $resultado = pg_query($conecta,$sql);
    $num = pg_num_rows($resultado);
    if($num == 0)
    {
        pg_close($conecta);
        echo "<script>alert('Erro com o SELECT');</script>";
        exit;
    }
    $dias = array($num);
    $total = array($num);
    for($i = 0; $i < $num; $i++)
    {
        $linha = pg_fetch_array($resultado);
        $dias[$i] = $linha[0]."/".$linha[1]."/".$linha[2];
        $total[$i] = $linha[3];
    }
    pg_close($conecta);
    echo 
    "<script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
            labels: ['$dias[0]','$dias[1]','11/10/2018'],
            datasets: 
            [{
                label: 'Faturamento total R$',
                data: [$total[0],$total[1],0],
                backgroundColor: [
                    'rgba(255, 255, 255, 0)'
                ],
                borderColor: [
                    'rgba(132,99,255,1)'
                    
                ],
                borderWidth: 2,
                pointBackgroundColor: [  'rgba(132, 99, 255, 1)'],
                pointBorderWidth: 6,
                pointStyle: 'rect',
                pointHoverBackgroundColor: [  'rgba(255, 99, 132, 1)','rgba(255, 99, 132, 1)','rgba(255, 99, 132, 1)'],
                pointHoverBorderColor: [  'rgba(255, 99, 132, 1)','rgba(255, 99, 132, 1)','rgba(255, 99, 132, 1)']
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