<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>PartyPlanner - Login</title>
  <!--<link type="text/css" rel="stylesheet" href="css/materialize/css/materialize.min.css"  media="screen,projection"/>-->

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Comfortaa" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/main.css">
	
	<!-- Favicon -->
	<link href="../assets/img/brand/favicon.png" rel="icon" type="image/png">
	<!-- Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
	<!-- Icons -->
	<link href="../assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
	<link href="../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
	<!-- Argon CSS -->
	<link type="text/css" href="../assets/css/argon.css?v=1.0.0" rel="stylesheet">
</head>

<body class="bg-default">
  <div class="main-content">


    <!-- Navbar -->
    <nav class="navbar navbar-top navbar-horizontal navbar-expand-md navbar-dark">
      <div class="container px-4">
        <a class="navbar-brand" href="#">
          <img width="250px" src="../img/outrologo2.png" />
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
          <div class="card bg-secondary shadow border">
            <div style="height: 90px;" class="container">
              <div class="header-body text-center mb-7">
                <div class="row justify-content-center">
                  <div style="position: relative; top: 25px;" class="col-lg-5 col-md-6">
                    <h1 class="text-primary2" style="width:250px">Nova senha</h1>
                    <p class="text-light2">Bem vindo!</p>
                  </div>
                </div>
              </div>
            </div>
            <?php
                        if ($_POST) {
                            $senha = isset($_POST['senha']) ? $_POST['senha'] : '';
                            $token = isset($_POST['token']) ? $_POST['token'] : '';
                            if (empty($token)) {
                                echo "<div class='alert alert-danger'>";
                                echo "<strong>Alerta!</strong> Você precisa acessar o link enviado para o seu e-mail!";
                                echo "</div>";
                            } else if (empty($senha)) {
                                echo "<div class='alert alert-warning'>";
                                echo "<strong>Alerta!</strong> Informe a nova senha!";
                                echo "</div>";
                            } else {
                                include_once '../inc/conexao.inc.php';
                                $tokenvazio = "";

                                $sql = " UPDATE login SET " .
                                        " senha = ?, token = ? " .
                                        " WHERE token = ? ";
                                $stmt = $conexao->prepare($sql);
                                $stmt->bind_param("sss", $senha, $tokenvazio, $token);
                                $stmt->execute();
                                if ($stmt->affected_rows === 0) {
                                    echo "<div class='alert alert-danger'>";
                                    echo "<strong>Alerta!</strong> Houve um erro na geração da nova senha!";
                                    echo "</div>";
                                } else {
                                    echo "<div class='alert alert-success'>";
                                    echo "<strong>Sucesso!</strong> Nova senha gerada com sucesso!<br>Acesse o sistema novamente <a href='login.php'>aqui</a>!";
                                    echo "</div>";
                                }
                                $stmt->close();
                                $conexao->close();
                            }
                        }
                        ?>
            <div style="padding-bottom: 1rem !important;" class="card-header bg-transparent pb-5">
              <form role="form">
              <div class="form-group mb-3">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                    </div>
                    <input class="form-control" placeholder="Email" type="email">
                  </div>
                </div>
                <div class="text-center">
                  <button type="button" class="btn btn-primary my-4">Enviar</button>
                </div>
              </form>
            </div>
          </div>
          <div style="position: relative; top: -15px;" class="row mt-3">
            <div class="col-6 text-right">
              <a href="#" class="text-primary"><small>Criar nova conta</small></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- Footer -->


  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="../css\argon-dashboard-master/assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="../css\argon-dashboard-master/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Argon JS -->
  <script src="../css\argon-dashboard-master/assets/js/argon.js?v=1.0.0"></script>
</body>

</html>