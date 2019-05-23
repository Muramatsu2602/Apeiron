<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="assets/img/apeiron.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Apeiron - Análise dos Resultados</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <!-- CSS Files -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/light-bootstrap-dashboard.css?v=2.0.1" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="assets/css/demo.css" rel="stylesheet" />
</head>

<body>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    <div class="wrapper">
        <div class="sidebar" data-color="black" data-image="assets/img/fundo2.jpg">
            <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

        Tip 2: you can also add an image using data-image tag
    -->
             <div class="sidebar-wrapper">
                <ul class="nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="charts.php">
                           <i class="nc-icon nc-chart-pie-35"></i>
                            Gráficos
                        </a>
                    </li>
                    <li >
                        <a  class="nav-link" href="relatorios.php">
                           <i class="nc-icon nc-paper-2"></i>
                            Relatórios
                        </a>
                    </li>
                    <li >
                        <a class="nav-link" href="promocao.php">
                           <i class="nc-icon nc-notes"></i>
                            Promoções
                        </a>
                    </li>
                    <li >
                        <a class="nav-link" href="http://200.145.153.175/marcosdias/apeiron/kenzo/usuarios/index.php">
                           <i class="nc-icon nc-notes"></i>
                            CRUD
                        </a>
                    </li>
                </ul>
                <style>
                    #particles-js{/*background-color: #b61924;*/ height: 47vh;}
                </style>
                <div id="particles-js"></div>
                        
                <script src="particles.js"></script>
                <script src="js/app.js"></script>
            </div>
        </div>
        <div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg " color-on-scroll="500">
                <div class=" container-fluid  ">
                    <a class="navbar-brand" href="charts.php">Gráficos</a> 
                    <a class="navbar-brand" href="relatorios.php"> Relatórios </a>
                    <a class="navbar-brand" href="promocao.php">Promoções</a>
                    <a class="navbar-brand" href="http://200.145.153.175/marcosdias/apeiron/kenzo/usuarios/index.php">  CRUD</a>
                    <button href="" class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar burger-lines"></span>
                        <span class="navbar-toggler-bar burger-lines"></span>
                        <span class="navbar-toggler-bar burger-lines"></span>
                    </button>
                </div>
            </nav>
            <!-- End Navbar -->
            <div class="content">
                <div class="container-fluid">
                   <h2>Gráficos dos Resultados<h2>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card ">
                                <div class="card-header ">
                                    <h4 class="card-title">Faturamento por período</h4>
                                    <p class="card-category">Semana do Colégio</p>
                                </div>
                                <div class="card-body ">
                                   <canvas id="c1"></canvas>
                                       <br>
                                        <div class="button-container">
                                            <a href="Charts/faturamentoPeriodo.php" target="_blank" class="btn btn-fill btn-alert"><strong>Visualizar<strong></a>
                                        </div>
                                        
                                </div>
                                <div class="card-footer ">
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-clock-o"></i> Gerado Eletronicamente
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card ">
                                <div class="card-header ">
                                    <h4 class="card-title">Quantidade por período</h4>
                                    <p class="card-category">Semana do Colégio</p>
                                </div>
                                <div class="card-body ">
                                    <canvas id="c2"></canvas>
                                       <br>
                                        <div class="button-container">
                                            <a href="Charts/qtdeProdData.php" target="_blank" class="btn btn-fill btn-alert"><strong>Visualizar<strong></a>
                                        </div>
                                </div>
                                <div class="card-footer ">
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-clock-o"></i> Gerado Eletronicamente
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card ">
                                <div class="card-header ">
                                    <h4 class="card-title">Porcentagem por período</h4>
                                    <p class="card-category">Semana do Colégio</p>
                                </div>
                                <div class="card-body ">
                                    <canvas id="c3"></canvas>
                                       <br>
                                        <div class="button-container">
                                            <a href="Charts/perProdData.php" target="_blank" class="btn btn-fill btn-alert"><strong>Visualizar<strong></a>
                                        </div>
                                </div>
                                <div class="card-footer ">
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-clock-o"></i> Gerado Eletronicamente
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card ">
                                <div class="card-header ">
                                    <h4 class="card-title">Quantidade vendida </h4>
                                    <p class="card-category">Semana do Colégio</p>
                                </div>
                                <div class="card-body ">
                                    <canvas id="c4"></canvas>
                                       <br>
                                        <div class="button-container">
                                            <a href="Charts/qtdeProd.php" target="_blank" class="btn btn-fill btn-alert"><strong>Visualizar<strong></a>
                                        </div>
                                </div>
                                <div class="card-footer ">
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-clock-o"></i> Gerado Eletronicamente
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>              
                </div>
            </div>
            <footer class="footer">
                <div class="container">
                    <nav>
                        <ul class="footer-menu">
                            <li>
                                <a href="charts.php">
                                    Gráficos
                                </a>
                            </li>
                            <li>
                                <a href="relatorios.php">
                                    Relatórios
                                </a>
                            </li>
                            <li>
                                <a href="promocao.php">
                                    Promoções
                                </a>
                            </li>
                            <li >
                                <a href="http://200.145.153.175/marcosdias/apeiron/kenzo/usuarios/index.php">
                                   CRUD
                                </a>
                            </li>
                             <li>
                             <li>
                            <a href="http://200.145.153.175/ricardomello/Sistema/index.php" target="_blank">
                                   Passatempo
                            </a>
                            </li>
                        </ul>
                        <p class="copyright text-center">
                            ©
                            <script>
                                document.write(new Date().getFullYear())
                            </script>
                            <a href="http://200.145.153.175/marcosdias/apeiron">APEIRON LTDA</a>
                        </p>
                    </nav>
                </div>
            </footer>
        </div>
    </div>
    <!--   -->
    <!-- <div class="fixed-plugin">
    <div class="dropdown show-dropdown">
        <a href="#" data-toggle="dropdown">
            <i class="fa fa-cog fa-2x"> </i>
        </a>

        <ul class="dropdown-menu">
			<li class="header-title"> Sidebar Style</li>
            <li class="adjustments-line">
                <a href="javascript:void(0)" class="switch-trigger">
                    <p>Background Image</p>
                    <label class="switch">
                        <input type="checkbox" data-toggle="switch" checked="" data-on-color="primary" data-off-color="primary"><span class="toggle"></span>
                    </label>
                    <div class="clearfix"></div>
                </a>
            </li>
            <li class="adjustments-line">
                <a href="javascript:void(0)" class="switch-trigger background-color">
                    <p>Filters</p>
                    <div class="pull-right">
                        <span class="badge filter badge-black" data-color="black"></span>
                        <span class="badge filter badge-azure" data-color="azure"></span>
                        <span class="badge filter badge-green" data-color="green"></span>
                        <span class="badge filter badge-orange" data-color="orange"></span>
                        <span class="badge filter badge-red" data-color="red"></span>
                        <span class="badge filter badge-purple active" data-color="purple"></span>
                    </div>
                    <div class="clearfix"></div>
                </a>
            </li>
            <li class="header-title">Sidebar Images</li>

            <li class="active">
                <a class="img-holder switch-trigger" href="javascript:void(0)">
                    <img src="../assets/img/sidebar-1.jpg" alt="" />
                </a>
            </li>
            <li>
                <a class="img-holder switch-trigger" href="javascript:void(0)">
                    <img src="../assets/img/sidebar-3.jpg" alt="" />
                </a>
            </li>
            <li>
                <a class="img-holder switch-trigger" href="javascript:void(0)">
                    <img src="..//assets/img/sidebar-4.jpg" alt="" />
                </a>
            </li>
            <li>
                <a class="img-holder switch-trigger" href="javascript:void(0)">
                    <img src="../assets/img/sidebar-5.jpg" alt="" />
                </a>
            </li>

            <li class="button-container">
                <div class="">
                    <a href="http://www.creative-tim.com/product/light-bootstrap-dashboard" target="_blank" class="btn btn-info btn-block btn-fill">Download, it's free!</a>
                </div>
            </li>

            <li class="header-title pro-title text-center">Want more components?</li>

            <li class="button-container">
                <div class="">
                    <a href="http://www.creative-tim.com/product/light-bootstrap-dashboard-pro" target="_blank" class="btn btn-warning btn-block btn-fill">Get The PRO Version!</a>
                </div>
            </li>

            <li class="header-title" id="sharrreTitle">Thank you for sharing!</li>

            <li class="button-container">
				<button id="twitter" class="btn btn-social btn-outline btn-twitter btn-round sharrre"><i class="fa fa-twitter"></i> · 256</button>
                <button id="facebook" class="btn btn-social btn-outline btn-facebook btn-round sharrre"><i class="fa fa-facebook-square"></i> · 426</button>
            </li>
        </ul>
    </div>
</div>
 -->
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
        var ctx = document.getElementById('c1').getContext('2d');
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
    $soma;
    for($i = 0; $i < $num; $i++)
    {
        $linha = pg_fetch_array($resultado);
        $dias[$i] = $linha[0]."/".$linha[1]."/".$linha[2];
        $qtde[$i] = $linha[3];
        $soma += $qtde[$i];
    }
    for($i = 0; $i < $num; $i++)
    {
        $qtde[$i] = $qtde[$i] / $soma * 100;
    }
    pg_close($conecta);
    echo 
    "<script>
        var ctx = document.getElementById('c3').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
            labels: ['$dias[0]','$dias[1]','11/10/2018'],
            datasets: 
            [{
                label: 'Quantidade Vendida',
                data: [$qtde[0],$qtde[1],0],
                backgroundColor: [
                    'rgba(200, 33, 33, 1)',
                    'rgba(60, 60, 200, 1)',
                    'rgba(60, 200, 60, 1)'
                ],
                borderColor: [
                    'rgba(200, 33, 33, 1)',
                    'rgba(60, 60, 200, 1)',
                    'rgba(60, 200, 60, 1)'
                    
                ],
                borderWidth: 2,
                hoverBackgroundColor: ['rgba(255, 0, 0, 1)','rgba(0, 0, 255, 1)','rgba(0, 255, 0, 1)'],
                hoverBorderColor: ['rgba(255, 0, 0, 1)','rgba(0, 0, 255, 1)','rgba(0, 255, 0, 1)']
           }]
    }
});
    </script>";
    
    
    
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
        var ctx = document.getElementById('c2').getContext('2d');
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
        var ctx = document.getElementById('c4').getContext('2d');
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
<!--   Core JS Files   -->
<script src="assets/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="assets/js/core/bootstrap.min.js" type="text/javascript"></script>
<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
<script src="assets/js/plugins/bootstrap-switch.js"></script>
<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<!--  Chartist Plugin  -->
<script src="assets/js/plugins/chartist.min.js"></script>
<!--  Notifications Plugin    -->
<script src="assets/js/plugins/bootstrap-notify.js"></script>
<!-- Control Center for Light Bootstrap Dashboard: scripts for the example pages etc -->
<script src="assets/js/light-bootstrap-dashboard.js?v=2.0.1" type="text/javascript"></script>
<!-- Light Bootstrap Dashboard DEMO methods, don't include it in your project! -->
<script src="assets/js/demo.js"></script>

</html>