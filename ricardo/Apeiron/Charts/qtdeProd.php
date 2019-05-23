<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Qtde de Produtos Vendidos</title>
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
    $sql = "SELECT rpm.produto.nome,SUM(rpm.item_compra.qtde) AS qtde  FROM rpm.item_compra,rpm.produto WHERE  rpm.item_compra.cod_produto = rpm.produto.cod GROUP BY rpm.produto.nome ORDER BY rpm.produto.nome";
    $resultado = pg_query($conecta,$sql);
    $num = pg_num_rows($resultado);
    if($num == 0)
    {
        pg_close($conecta);
        echo "<script>alert('Erro com o SELECT');</script>";
        exit;
    }
    $prod = array($num);
    $qtde = array($num);
    for($i = 0; $i < $num; $i++)
    {
        $linha = pg_fetch_array($resultado);
        $prod[$i] = $linha[0];
        $qtde[$i] = $linha[1];
    }
    pg_close($conecta);
    echo 
    "<script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
            labels: ['$prod[0]','$prod[1]','$prod[2]','$prod[3]','$prod[4]','$prod[5]','$prod[6]','$prod[7]'],
            datasets: 
            [{
                label: 'Quantidade Vendida',
                data: [$qtde[0],$qtde[1],$qtde[2],$qtde[3],$qtde[4],$qtde[5],$qtde[6],$qtde[7]],
                backgroundColor: [
                    'rgba(200, 33, 33, 1)',
                    'rgba(33, 200, 33, 1)',
                    'rgba(33, 33, 200, 1)',
                    'rgba(200, 33, 33, 1)',
                    'rgba(33, 200, 33, 1)',
                    'rgba(33, 33, 200, 1)',
                    'rgba(200, 33, 33, 1)'
                ],
                borderColor: [
                    'rgba(200, 33, 33, 1)',
                    'rgba(33, 200, 33, 1)',
                    'rgba(33, 33, 200, 1)',
                    'rgba(200, 33, 33, 1)',
                    'rgba(33, 200, 33, 1)',
                    'rgba(33, 33, 200, 1)',
                    'rgba(200, 33, 33, 1)'
                ],
                borderWidth: 2,
                hoverBackgroundColor: ['rgba(255, 0, 0, 1)','rgba(0, 255, 0, 1)','rgba(0, 0, 255, 1)','rgba(255, 0, 0, 1)','rgba(0, 255, 0, 1)','rgba(0, 0, 255, 1)','rgba(255, 0, 0, 1)'],
                hoverBorderColor: ['rgba(255, 0, 0, 1)','rgba(0, 255, 0, 1)','rgba(0, 0, 255, 1)','rgba(255, 0, 0, 1)','rgba(0, 255, 0, 1)','rgba(0, 0, 255, 1)','rgba(255, 0, 0, 1)']
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