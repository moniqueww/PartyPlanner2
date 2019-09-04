<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Login - Partyplann</title>
  <?php include_once "include/head.php"; ?>
  
  <style>

    #email{
      position: relative;
    }
    #senha{
      position: relative;
      margin-bottom: 25px;
    }
    #span_alertas{
      position: absolute;
      margin-top: 60px;
      color: #cc4c43;
      left: 5px;
    }

  </style>

  <script src="http://code.jquery.com/jquery-1.11.1.js"></script>

	<script type="text/javascript">
		
		$(document).ready(function() {
			$('form').submit(function(){
				var email = $("#email").val();
				var senha = $("#senha").val();

				if ((email == "" || email == " ") && (senha == "" || senha == " ")){
					$("#span_alertas").html('Por favor, digite seu email e sua senha!');
					return false;
				} else if (email == "" || email == " "){
					$("#span_alertas").html('Por favor, digite seu email!');
					return false;
				} else if (senha == "" || senha == " "){
					$("#span_alertas").html('Por favor, digite sua senha!');
					return false;
				}

			});
			return true;
		});

	</script>
</head>
<body class="bg-white">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<!-- jQuery -->
  <script src="js/jquery.js" crossorigin="anonymous"></script>
	<!-- Meu js -->
	<script src="js/main.js"></script>
  <!-- Popper.JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
  <!-- Bootstrap JS -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
  <script src="http://code.jquery.com/jquery-1.11.1.js"></script>
  <div class="main-content">
  <?php include_once "include/cabecalho.php"; ?>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
          <div style="border: none !important;" class="card bg-secondary">
            <div style="height: 90px;" class="container">
              <div class="header-body text-center mb-7">
                <div class="row justify-content-center">
                  <div style="position: relative; top: 25px;" class="col-lg-5 col-md-6">
                    <h1 class="text-primary2">Login</h1>
                  </div>
                </div>
              </div>
            </div>
            <div style="padding-bottom: 1rem !important; border: none !important;" class="card-header bg-transparent pb-5">
              <form novalidate id="form" action="login.php" method="post" name="formLog">
                <div class="form-group mb-3">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span style="height: 46px;" class="input-group-text"><i class="ni ni-email-83"></i></span>
                    </div>
                    <input class="form-control" id="email" value="" name="email" placeholder="Email" type="email">
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span style="height: 46px;" class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input class="form-control" id="senha" value="" name="senha" placeholder="Senha" type="password">
                    <span id="span_alertas"></span>
                  </div>
                </div>
                <div class="custom-control custom-control-alternative custom-checkbox">
                  <input class="custom-control-input" id="customCheckLogin" type="checkbox">
                  <label class="custom-control-label" for="customCheckLogin">
                    <span class="text-muted">Lembrar de mim</span>
                  </label>
                </div>
                <div class="text-center">
                  <button type="submit" name="entrar" class="btn btn-primary my-4">Entrar</button>
                  <input type="hidden" value="1" name="validar">
                </div>
              </form>
              <?php
					      include_once "seguranca.php";
				      ?>
            </div>
            </div>
          <div style="position: relative; top: -15px;" class="row mt-3">
            <div class="col-6">
              <a class="text-primary"><span>Esqueceu sua senha?</span></a>
            </div>
            <div class="col-6 text-right">
              <a href="escolhercadastro.php" class="text-primary"><span>Criar nova conta</span></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>