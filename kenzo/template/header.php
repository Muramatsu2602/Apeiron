<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ADMIN  - Apeiron </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="../js/DataTables/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="../js/datepicker/datepicker.min.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" href="../adminlte/css/AdminLTE.min.css">
    <link rel="stylesheet" href="../adminlte/css/skins/_all-skins.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <![endif]-->

    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-black sidebar-mini">
<div class="wrapper">
    <header class="main-header">
        <a href="../usuarios/index.php" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b><img src="../logo.png" alt="" style="height:35px; width:auto;"></b></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Apeiron ADMIN</b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <div class="navbar-custom-menu" style="background-color: #dd4b39;" >
               
                <ul class="nav navbar-nav">
                    <!-- User Account: style can be found in dropdown.less -->
                
                    <!-- Control Sidebar Toggle Button -->
                    <li>
                        <a class="btn btn-danger" onclick="sair()" ><i class="fa fa-sign-out size fa-large" style="color:white;" ></i></a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <aside class="main-sidebar">
       
        <section class="sidebar">
            <ul class="sidebar-menu" data-widget="tree">
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-table"></i> <span>Tabelas</span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="../usuarios/index.php"><i class="fas fa-users"></i> Usuários</a></li>
                        <li><a href="../produtos/index.php"><i class="fas fa-tags"></i>Produtos</a></li>
                    </ul>
                </li>

                <li class="treeview">
                    <a href="#">
                    <i class="fas fa-clipboard-list"></i>
                        <span>Menu Relatórios </span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="http://200.145.153.175/marcosdias/apeiron/ricardo/Apeiron/relatorios.php"><i class="fas fa-clipboard-check"></i></i>  Relatórios </a></li>
                        <li><a href="http://200.145.153.175/marcosdias/apeiron/ricardo/Apeiron/charts.php"><i class="fas fa-chart-line"></i>  Gráficos</a></li>
                        <li><a href="http://200.145.153.175/marcosdias/apeiron/ricardo/Apeiron/promocao.php"><i  class="fas fa-gift"></i >  Promoções</a></li>
                    </ul>
                </li>

            </ul>
        </section>
         <style>
            #particles-js{background-color: #222d32; height: 650px; }
        </style>
        <div id="particles-js"></div>
                
        <script src="../js/particles.js"></script>
        <script src="../js/js/app.js"></script>
    </aside>
    <div class="content-wrapper">
