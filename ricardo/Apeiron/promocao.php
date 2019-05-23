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
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <!-- jquery -->
    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <!-- bootstrap -->
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    

    <!-- chamada da função -->
    <script type="text/javascript">
       jQuery(document).ready(function(){
		jQuery('#form').submit(function(){
			var dados = jQuery( this ).serialize();
			jQuery.ajax({
				type: "POST",
				url: "./docs/promo.php",
				data: dados,
				success: function( data )
				{
                    swal({
                        title: "Comando Processado!",
                        text: data,
                        icon: "success",
                        button: "OK",
                        });
				}
			});
			
			return false;
		});
	}); 
    </script>
    
 
</head>

<body>
<!-- Modal -->
<div class="modal fade" id="oi" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Aviso:</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Comando Processado
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>
    <div class="wrapper">
        <div class="sidebar" data-color="black" data-image="assets/img/fundo2.jpg">
            <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

        Tip 2: you can also add an image using data-image tag
    -->
            <div class="sidebar-wrapper">
                <ul class="nav">
                    <li>
                        <a class="nav-link" href="charts.php">
                           <i class="nc-icon nc-chart-pie-35"></i>
                            Gráficos
                        </a>
                    </li>
                    <li>
                        <a  class="nav-link" href="relatorios.php">
                           <i class="nc-icon nc-paper-2"></i>
                            Relatórios
                        </a>
                    </li>
                    <li class="nav-item active">
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
                   
                    <a class="navbar-brand" href="charts.php"> Gráficos</a> 
                    <a class="navbar-brand" href="relatorios.php">  Relatórios </a>
                    <a class="navbar-brand" href="promocao.php">   Promoções</a>
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
                    <div class="section">
                        <h2>Promoções</h2><br><br>
                       
                        <form method="post" action="" id="form">
                            User Email:<input type="email" class = "form-control" name="email" required aria-describedby="emailHelp" placeholder="Email do Usuário"/><small id="emailHelp" class="form-text text-muted">Email que será buscado no banco.</small><br>
                            Total Desc.: <input type="number" class ="form-control" name="desconto" required min="0" placeholder="valor de desconto" step="0.05" max="300"/>
                            <small id="emailHelp" class="form-text text-muted">Valor do Desconto.</small><br><br>
                            <input type="submit" value="Calcular" class="btn  btn-outline btn-facebook btn-round sharrre btn-fill btn-alert"/>
                        </form>
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