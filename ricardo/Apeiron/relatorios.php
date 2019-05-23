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
   <?php
    //Roda Uma vez só!!!!! na hora de fechar o caixa!!!
    $sql1 = "host = localhost port=5432 dbname=2018_72b_Apeiron user=apeiron password=logos321";
    $conecta2 = pg_connect($sql1);
    if(!$conecta2)
    {
        echo "<script>alert('Problemas com o Servidor');</script>";
        exit;
    }
    $sql_dele = "DELETE FROM rpm.fluxo_caixa";
    $resul_dele = pg_query($conecta2,$sql_dele);
    $sql3 = "SELECT DISTINCT data_compra FROM rpm.compra ORDER BY data_compra";
    $resultado2 = pg_query($conecta2,$sql3);
    $num2 = pg_num_rows($resultado2);
    if($num2 == 0)
    {
        pg_close($conecta2);
        echo "<script>alert('Problemas com as datas da Compra');</script>";
        exit;
    }

    for($i = 0; $i < $num2; $i++)
    {
        $linha = pg_fetch_array($resultado2);
        $data = $linha[0];
        $sqlvalor = "SELECT SUM(total)as entrada FROM rpm.compra WHERE data_compra = '$data'";
        $resultadovalor = pg_query($conecta2,$sqlvalor);
        $numvalor = pg_num_rows($resultadovalor);
        if($numvalor == 0)
        {
            pg_close($conecta2);
            echo "<script>alert('Problemas com o total da compra');</script>";
            exit;
        }
        $row = pg_fetch_array($resultadovalor);
        $valor = $row[0];
        if($valor == 0)
            continue;
        $sql = "INSERT INTO rpm.fluxo_caixa VALUES (DEFAULT,'$data','Venda de produtos',$valor,NULL)";
        $resul = pg_query($conecta2,$sql);
        $tot = pg_num_rows($resul);
        if($resul == 0)
        {
            pg_close($conecta2);
            echo "<script>alert('Problemas com o fechamento');</script>";
            exit;
        }
        
    }
    $sql_insere = "INSERT INTO rpm.fluxo_caixa VALUES (DEFAULT,'08-10-2018','Gastos com decoração',NULL,2.0)";
    $resul_insere = pg_query($conecta2,$sql_insere);
    $num_insere = pg_affected_rows($resul_insere);
    if($num_insere == 0)
    {
        pg_close($conecta2);
            echo "<script>alert('Problemas com o Fluxo de Caixa');</script>";
        exit;
    }
    $sql_insere = "INSERT INTO rpm.fluxo_caixa VALUES (DEFAULT,'18-10-2018','Lucro da APM',NULL,113.10)";
    $resul_insere = pg_query($conecta2,$sql_insere);
    $num_insere = pg_affected_rows($resul_insere);
    if($num_insere == 0)
    {
        pg_close($conecta2);
            echo "<script>alert('Problemas com o Fluxo de Caixa');</script>";
        exit;
    }
    $sql_insere = "INSERT INTO rpm.fluxo_caixa VALUES (DEFAULT,'18-10-2018','Dev. Sócio João Pedro',NULL,50.0)";
    $resul_insere = pg_query($conecta2,$sql_insere);
    $num_insere = pg_affected_rows($resul_insere);
    if($num_insere == 0)
    {
        pg_close($conecta2);
            echo "<script>alert('Problemas com o Fluxo de Caixa');</script>";
        exit;
    }
    $sql_insere = "INSERT INTO rpm.fluxo_caixa VALUES (DEFAULT,'18-10-2018','Dev. Sócio Ricardo',NULL,28.0)";
    $resul_insere = pg_query($conecta2,$sql_insere);
    $num_insere = pg_affected_rows($resul_insere);
    if($num_insere == 0)
    {
        pg_close($conecta2);
            echo "<script>alert('Problemas com o Fluxo de Caixa');</script>";
        exit;
    }
    $sql_insere = "INSERT INTO rpm.fluxo_caixa VALUES (DEFAULT,'18-10-2018','Dev. Sócio Pedro',NULL,58.9)";
    $resul_insere = pg_query($conecta2,$sql_insere);
    $num_insere = pg_affected_rows($resul_insere);
    if($num_insere == 0)
    {
        pg_close($conecta2);
            echo "<script>alert('Problemas com o Fluxo de Caixa');</script>";
        exit;
    }
    $sql_insere = "INSERT INTO rpm.fluxo_caixa VALUES (DEFAULT,'01-09-2018','Capital Inicial',50.0,NULL)";
    $resul_insere = pg_query($conecta2,$sql_insere);
    $num_insere = pg_affected_rows($resul_insere);
    if($num_insere == 0)
    {
        pg_close($conecta2);
            echo "<script>alert('Problemas com o Fluxo de Caixa');</script>";
        exit;
    }
    $sql_insere = "INSERT INTO rpm.fluxo_caixa VALUES (DEFAULT,'12-09-2018','Investimento dos sócios',86.9,NULL)";
    $resul_insere = pg_query($conecta2,$sql_insere);
    $num_insere = pg_affected_rows($resul_insere);
    if($num_insere == 0)
    {
        pg_close($conecta2);
            echo "<script>alert('Problemas com o Fluxo de Caixa');</script>";
        exit;
    }
    $sql_insere = "INSERT INTO rpm.fluxo_caixa VALUES (DEFAULT,'19-09-2018','Compra das embalagens',NULL,8.0)";
    $resul_insere = pg_query($conecta2,$sql_insere);
    $num_insere = pg_affected_rows($resul_insere);
    if($num_insere == 0)
    {
        pg_close($conecta2);
            echo "<script>alert('Problemas com o Fluxo de Caixa');</script>";
        exit;
    }
    $sql_insere = "INSERT INTO rpm.fluxo_caixa VALUES (DEFAULT,'25-09-2018','Compra dos produtos',NULL,126.90)";
    $resul_insere = pg_query($conecta2,$sql_insere);
    $num_insere = pg_affected_rows($resul_insere);
    if($num_insere == 0)
    {
        pg_close($conecta2);
            echo "<script>alert('Problemas com o Fluxo de Caixa');</script>";
        exit;
    }
    pg_close($conecta2);
    
    
    //Roda Uma vez só!!!!! na hora de fechar o Controle de Estoque!!!
    $sql1 = "host = localhost port=5432 dbname=2018_72b_Apeiron user=apeiron password=logos321";
    $conecta2 = pg_connect($sql1);
    if(!$conecta2)
    {
        echo "<script>alert('Problemas com o Servidor');</script>";
        exit;
    }
    $sql_dele = "DELETE FROM rpm.controle_estoque";
    $resul_dele = pg_query($conecta2,$sql_dele);


    $sql3 = "SELECT rpm.compra.data_compra, SUM(rpm.item_compra.qtde) AS qtde FROM rpm.compra, rpm.item_compra WHERE rpm.compra.cod = rpm.item_compra.id_compra GROUP BY rpm.compra.data_compra ORDER BY rpm.compra.data_compra";
    $resultado2 = pg_query($conecta2,$sql3);
    $num2 = pg_num_rows($resultado2);
    
    $sql_3 = "SELECT rpm.compra.data_compra, SUM(rpm.compra.total) AS total FROM rpm.compra GROUP BY rpm.compra.data_compra ORDER BY rpm.compra.data_compra";
    $resultado_2 = pg_query($conecta2,$sql_3);
    if($num2 == 0)
    {
        pg_close($conecta2);
        echo "<script>alert('Problemas com as datas de compra');</script>";
        exit;
    }

    for($i = 0; $i < $num2; $i++)
    {
        $linha = pg_fetch_array($resultado2);
        $line = pg_fetch_array($resultado_2);
        if($linha[1] == 0)
            continue;
        $sql = "INSERT INTO rpm.controle_estoque VALUES (DEFAULT,'Comércio dos Bottons',0,$linha[1],$line[1]/$linha[1],'$linha[0]')";
        $resul = pg_query($conecta2,$sql);
        $tot = pg_num_rows($resul);
        if($resul == 0)
        {
            pg_close($conecta2);
            echo "<script>alert('Problemas com o fechamento');</script>";
            exit;
        }
        
    }


    $sql_insere = "INSERT INTO rpm.controle_estoque VALUES (DEFAULT,'Compra dos Bottons',100,0,1.349,'25-09-2018')";
    $resul_insere = pg_query($conecta2,$sql_insere);
    $num_insere = pg_affected_rows($resul_insere);
    if($num_insere == 0)
    {
        pg_close($conecta2);
            echo "<script>alert('Problemas com o Controle de Estoque');</script>";
        exit;
    }
    
    
    //Roda Uma vez só!!!!! na hora de fechar o demosntração de resultados!!!
    $sql_dele = "DELETE FROM rpm.demonstracao";
    $resul_dele = pg_query($conecta2,$sql_dele);
    $sql3 = "SELECT DISTINCT data_compra FROM rpm.compra ORDER BY data_compra";
    $resultado2 = pg_query($conecta2,$sql3);
    $num2 = pg_num_rows($resultado2);
    if($num2 == 0)
    {
        pg_close($conecta2);
        echo "<script>alert('Problemas com as datas da Compra');</script>";
        exit;
    }

    for($i = 0; $i < $num2; $i++)
    {
        $linha = pg_fetch_array($resultado2);
        $data = $linha[0];
        $sqlvalor = "SELECT SUM(total)as entrada FROM rpm.compra WHERE data_compra = '$data'";
        $resultadovalor = pg_query($conecta2,$sqlvalor);
        $numvalor = pg_num_rows($resultadovalor);
        if($numvalor == 0)
        {
            pg_close($conecta2);
            echo "<script>alert('Problemas com o total da compra');</script>";
            exit;
        }
        $row = pg_fetch_array($resultadovalor);
        $valor = $row[0];
        if($valor == 0)
            continue;
        $sql = "INSERT INTO rpm.demonstracao VALUES (DEFAULT,'$data',$valor,0)";
        $resul = pg_query($conecta2,$sql);
        $tot = pg_num_rows($resul);
        if($resul == 0)
        {
            pg_close($conecta2);
            echo "<script>alert('Problemas com o fechamento');</script>";
            exit;
        }
        
    }
    $sql_insere = "INSERT INTO rpm.demonstracao VALUES (DEFAULT,'11-10-2018',0,136.9)";
    $resul_insere = pg_query($conecta2,$sql_insere);
    $num_insere = pg_affected_rows($resul_insere);
    if($num_insere == 0)
    {
        pg_close($conecta2);
            echo "<script>alert('Problemas com a Demonstração');</script>";
        exit;
    }
    pg_close($conecta2);
?>
    <div class="wrapper">
        <div class="sidebar"  data-image="assets/img/relat1.PNG">
            <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

        Tip 2: you can also add an image using data-image tag
    -->
            <div class="sidebar-wrapper">
                <ul class="nav">
                    <li >
                        <a class="nav-link" href="charts.php">
                           <i class="nc-icon nc-chart-pie-35"></i>
                            Gráficos
                        </a>
                    </li>
                    <li class="nav-item active">
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
                    #particles-js{/*background-color: #222d32*/; height: 47vh;}
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
                   
                    <a class="navbar-brand" href="charts.php"> Gráficos</a> 
                    <a class="navbar-brand" href="relatorios.php">  Relatórios </a>
                    <a class="navbar-brand" href="promocao.php">  Promoções</a>
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
                   <h2>Relatórios para Gerenciamento<h2>
                    <div class="row">
                        <div class="col-md-7">
                            <div class="card ">
                                <div class="card-header ">
                                    <h4 class="card-title">Fluxo de Caixa</h4>
                                    <p class="card-category">Semana do Colégio</p>
                                </div>
                                <div class="card-body ">
                                    
                                        <div class="button-container">
                                            <a href="docs/mostra_fluxo.php" target="_blank" class="btn btn-block btn-info"><strong>Mostrar<strong></a>
                                        </div>
                                        <img src="assets/img/relat1.PNG" width="100%"/>
                                        <br>
                                        <br>
                                        <div class="button-container" align = "center">
                                            <a href="docs/envia_fluxo.php" target="_blank" class="btn btn-social btn-outline btn-facebook btn-round sharrre btn-fill btn-alert">Enviar</a>
                                        </div>
                                </div>
                                <div class="card-footer ">
                                    <hr>
                                        <div class="button-container" align = "right">
                                            <a align = "left" href="docs/baixa_fluxo.php" target="_blank" class="btn btn-fill btn-alert">Baixar arquivo (.xls)</a>
                                        </div>
                                    <div class="stats" align="left">
                                        <i class="fa fa-clock-o" align="right"></i> Gerado Eletronicamente
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                            <div class="col-md-7">
                            <div class="card ">
                                <div class="card-header ">
                                    <h4 class="card-title">Demonstração de Resultados</h4>
                                    <p class="card-category">Semana do Colégio</p>
                                </div>
                                <div class="card-body ">
                                    
                                        <div class="button-container">
                                            <a href="docs/mostra_demonstracao.php" target="_blank" class="btn btn-block btn-info"><strong>Mostrar<strong></a>
                                        </div>
                                        <img src="assets/img/demo.png" width="100%"/>
                                        <br>
                                        <br>
                                        <div class="button-container" align = "center">
                                            <a href="docs/envia_demo.php" target="_blank" class="btn btn-social btn-outline btn-facebook btn-round sharrre btn-fill btn-alert">Enviar</a>
                                        </div>
                                </div>
                                <div class="card-footer ">
                                    <hr>
                                        <div class="button-container" align = "right">
                                            <a align = "left" href="docs/baixa_demo.php" target="_blank" class="btn btn-fill btn-alert">Baixar arquivo (.xls)</a>
                                        </div>
                                    <div class="stats" align="left">
                                        <i class="fa fa-clock-o" align="right"></i> Gerado Eletronicamente
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="row">
                        <div class="col-md-7">
                            <div class="card ">
                                <div class="card-header ">
                                    <h4 class="card-title">Controle de Estoque</h4>
                                    <p class="card-category">Semana do Colégio</p>
                                </div>
                                <div class="card-body ">
                                    
                                        <div class="button-container">
                                            <a href="docs/mostra_controle.php" target="_blank" class="btn btn-block btn-info"><strong>Mostrar</strong></a>
                                        </div>
                                        <img src="assets/img/relat2.PNG" width="100%"/>
                                        <br>
                                        <br>
                                        <div class="button-container" align = "center">
                                            <a href="docs/envia_controle.php" target="_blank" class="btn btn-social btn-outline btn-facebook btn-round sharrre btn-fill btn-alert ">Enviar</a>
                                        </div>
                                    
                                </div>
                                <div class="card-footer ">
                                    <hr>
                                    <div class="button-container" align = "right">
                                            <a align = "left" href="docs/baixa_controle.php" target="_blank" class="btn btn-fill btn-alert">Baixar arquivo (.xls)</a>
                                    </div>
                                    <div class="stats">
                                        <i class="fa fa-clock-o"></i> Gerado Eletronicamente
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-7">
                            <div class="card ">
                                <div class="card-header ">
                                    <h4 class="card-title">Cubos em movimento</h4>
                                    <p class="card-category">Animação com three.js</p>
                                </div>
                                <div class="card-body " id = "corpo">
                                <img src="assets/img/anima.PNG" width="100%"/>   
                                </div>
                                <div class="card-footer ">
                                    <hr>
                                    <div class="button-container" align = "right">
                                            <a align = "left" href="docs/animacao.php" target="_blank" class="btn btn-fill btn-alert">Animar</a>
                                    </div>
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