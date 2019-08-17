<!DOCTYPE html>
<html>

<?php
$tituloHead = 'Cadastrar';
include_once('include/head.php');
?>
<body class="bg-white">
  <div class="main-content">
    <!-- Navbar -->
    <nav style="height: 166px;" class="navbar navbar-top navbar-horizontal navbar-expand-md navbar-dark">
      <div style="margin-left: 50px;" class="container px-4">
        <a class="navbar-brand" href="#">
          <img style="width: 300px;" src="img/brand/logo-branco.png" />
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse-main" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar-collapse-main">
          <!-- Collapse header -->
          <div class="navbar-collapse-header d-md-none">
            <div class="row">
              <div class="col-6 collapse-brand">
                <a href="#">
                  <img src="css\argon-dashboard-master/assets/img/brand/blue.png">
                </a>
              </div>
              <div class="col-6 collapse-close">
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                  <span></span>
                  <span></span>
                </button>
              </div>
            </div>
          </div>
          <!-- Navbar items -->
        </div>
      </div>
    </nav>
    <!-- Header -->
    <div class="header bg-gradient-primary py-7 py-lg-8">
      <div class="separator separator-bottom separator-skew zindex-100">
      </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
      <div class="row justify-content-center">
        <div border="solid black 1px" class="col-lg-5 col-md-7">
          <div style="border: none;" class="card bg-secondary">
            <div style="height: 90px;" class="container">
              <div class="header-body text-center mb-7">
                <div class="row justify-content-center">
                  <div style="position: relative; top: 25px;" class="col-lg-5 col-md-6">
                    <h1 class="text-primary2" style="width:400px;position: relative; top: 0px;left: -125px;">Escolhe o tipo de cadastro que deseja realizar!</h1>
                  </div>
                </div>
              </div>
            </div>
            <div style="padding-bottom: 1rem !important; border-bottom: none;" class="card-header bg-transparent pb-5">
            <div class="form-group" style="text-align:center">
              <a href="form_organizador.php"><button type="button" style="margin-right: 15px;" class="btn btn-primary my-4" > Organizador </button></a>
              <a href="form_servico.php"><button type="button" class="btn btn-primary my-4" > Serviço </button></a>
            </div>
              <a href="login.php" class="text-primary"><span>Voltar</span></a>
        </div>
      </div>
    </div>
  </div>
  <!-- Footer -->
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="css\argon-dashboard-master/assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="css\argon-dashboard-master/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Argon JS -->
  <script src="css\argon-dashboard-master/assets/js/argon.js?v=1.0.0"></script>
</body>
</html>