<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Título -->
  <title>@yield('titulo', 'CEAA')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('css/ionicons.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('css/AdminLTE.min.css') }}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ asset('css/skin-blue.min.css') }}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <!-- Mis estilos -->
  <link rel="stylesheet" href="{{ asset('css/mis-estilos.css') }}">
  <!-- Agregar estilos -->
  @yield('estilos')
  <!-- Favicon -->
  <link rel="favicon" href="{{ asset('img/sistema/favicon.png') }}" />
  <link rel="shortcut icon" href="{{ asset('img/sistema/favicon.ico') }}" />
</head>
<!-- ADD THE CLASS fixed TO GET A FIXED HEADER AND SIDEBAR LAYOUT -->
<!-- the fixed layout is not compatible with sidebar-mini -->
<body class="hold-transition skin-blue fixed sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="../../index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">
        <img src="{{ asset('img/sistema/logo_blanco.png') }}" class="logo-mini-tamanio" alt="Mini logo" />
      </span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">Anastasio Aquino</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Navegación</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{ asset('img/users/user_default.jpg') }}" class="user-image" alt="Imagen de usuario">
              <span class="hidden-xs">Nombre de usuario</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{ asset('img/users/user_default.jpg') }}" class="img-circle" alt="Imagen de usuario">

                <p>
                  Nombre de usuario
                  <small>Rol de usuario</small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Inicio</a>
                </div>
                <div class="pull-right">
                  <a href="#" class="btn btn-default btn-flat">Cerrar sesión</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset('img/users/user_default.jpg') }}" class="img-circle" alt="Imagen de usuario">
        </div>
        <div class="pull-left info">
          <p>Nombre de usuario</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">GESTIÓN ACADÉMICA</li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-graduation-cap"></i> <span>Grados</span>
          </a>
        </li>
        <li class="header">PERSONAL</li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i> <span>Docentes</span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-clock-o"></i> <span>Jornada Laboral</span>
          </a>
        </li>
        <li class="header">ADMINISTRACIÓN</li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-book"></i> <span>Reportes</span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-cog"></i> <span>Configuración</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-circle-o"></i> Años escolares</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Niveles educativos</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Materias</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-shield"></i> <span>Seguridad</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-circle-o"></i> Usuarios</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Roles de usuario</a></li>
          </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        @yield('encabezado', 'Encabezado')
        <small>@yield('subencabezado')</small>
      </h1>
      <ol class="breadcrumb">
        @yield('breadcrumb')
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      @include('flash::message')
      @yield('contenido')
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0
    </div>
    <strong>Copyright &copy; 2018 <a href="#">Centro Escolar Anastasio Aquino</a></strong>
  </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{ asset('js/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<!-- SlimScroll -->
<script src="{{ asset('js/jquery.slimscroll.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('js/fastclick.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('js/demo.js') }}"></script>
<!-- Agregar scripts -->
@yield('scripts')
</body>
</html>
