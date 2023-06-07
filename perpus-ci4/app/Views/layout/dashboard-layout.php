<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Agra LiMaS</title>
  <base href="/">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- daterange picker -->
  <!-- <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css"> -->
  <!-- iCheck for checkboxes and radio inputs -->
  <!-- <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css"> -->
  <!-- Bootstrap Color Picker -->
  <!-- <link rel="stylesheet" href="plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css"> -->
  <!-- Tempusdominus Bootstrap 4 -->
  <!-- <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css"> -->
  <!-- Select2 -->
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Bootstrap4 Duallistbox -->
  <!-- <link rel="stylesheet" href="plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css"> -->
  <!-- BS Stepper -->
  <!-- <link rel="stylesheet" href="plugins/bs-stepper/css/bs-stepper.min.css"> -->
  <!-- dropzonejs -->
  <!-- <link rel="stylesheet" href="plugins/dropzone/min/dropzone.min.css"> -->
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="<?= current_url() ?>" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
        <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Agra LiMaS</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block">Admin</a>
          </div>
        </div> -->

        <!-- SidebarSearch Form -->
        <div class="form-inline mt-3">
          <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="dashboard" class="nav-link <?= (current_url() == base_url('dashboard')) ? 'active' : ''; ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Home</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="dashboard/author" class="nav-link <?= (current_url() == base_url('dashboard/author')) ? 'active' : ''; ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Author</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="dashboard/category" class="nav-link <?= (current_url() == base_url('dashboard/category')) ? 'active' : ''; ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Category</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="dashboard/rules" class="nav-link <?= (current_url() == base_url('dashboard/rules')) ? 'active' : ''; ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Rules</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="bibliography" class="nav-link <?= (current_url() == base_url('bibliography')) ? 'active' : ''; ?>">
                <i class="nav-icon fas fa-book"></i>
                <p>
                  Bibliography
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="circulation/loan" class="nav-link <?= (current_url() == base_url('circulation/loan')) ? 'active' : ''; ?>">
                <i class="nav-icon fas fa-sync"></i>
                <p>
                  Circulation
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="member" class="nav-link <?= (current_url() == base_url('member')) ? 'active' : ''; ?>">
                <i class="nav-icon fas fa-user"></i>
                <p>
                  Membership
                </p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0"><?= isset($pageTitle) ? $pageTitle : 'Hello!'; ?></h1>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="content">
        <div class="container-fluid">
          <?= $this->renderSection('content') ?>
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">
      <!-- To the right -->
      <div class="float-right d-none d-sm-inline">
        .
      </div>
      <!-- Default to the left -->
      <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>

  <!-- ADDTIONAL SCRIPTs -->

  <!-- Select2 -->
  <script src="plugins/select2/js/select2.full.min.js"></script>
  <!-- Bootstrap4 Duallistbox -->
  <!-- <script src="plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script> -->
  <!-- InputMask -->
  <!-- <script src="plugins/moment/moment.min.js"></script> -->
  <!-- <script src="plugins/inputmask/jquery.inputmask.min.js"></script> -->
  <!-- date-range-picker -->
  <!-- <script src="plugins/daterangepicker/daterangepicker.js"></script> -->
  <!-- bootstrap color picker -->
  <!-- <script src="plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script> -->
  <!-- Tempusdominus Bootstrap 4 -->
  <!-- <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script> -->
  <!-- Bootstrap Switch -->
  <!-- <script src="plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script> -->
  <!-- BS-Stepper -->
  <!-- <script src="plugins/bs-stepper/js/bs-stepper.min.js"></script> -->
  <!-- dropzonejs -->
  <!-- <script src="plugins/dropzone/min/dropzone.min.js"></script> -->

  <!-- My Script -->
  <script src="assets/script.js"></script>
</body>

</html>