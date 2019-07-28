<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>

	<title>Login - Biblioteca IFRS</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/login.css">
	<link href='//fonts.googleapis.com/css?family=Montserrat:thin,extra-light,light,100,200,300,400,500,600,700,800' 
rel='stylesheet' type='text/css'>



	<script src="http://code.jquery.com/jquery-1.11.1.js"></script>

	<script type="text/javascript">
		
		$(document).ready(function() {
			$('form').submit(function(){
				var usuario = $("#usuario").val();
				var senha = $("#senha").val();

				if ((usuario == "" || usuario == " ") && senha == "" || senha == " "){
					$("#helpusuario").html('Por favor, digite seu usuário!');
					$("#helpsenha").html('Por favor, digite sua senha!');
					return false;
				} else if (usuario == "" || usuario == " "){
					$("#helpusuario").html('Por favor, digite seu usuário!');
					return false;
				} else if (senha == "" || senha == " "){
					$("#helpsenha").html('Por favor, digite sua senha!');
					return false;
				}

			});
			return true;
		});

	</script>

</head>
<body>

	<div id="all">
		<div id="div1">
			<img id="imglogoif" src="img/logoif.png">
		</div>
		<div id="div2">
			<div id="divform">
				<img id="img" src="img/logo5black.png"><span id="biblio">Biblioteca Instituto Federal</span><br/><span id="biblio2">Campus Bento Gonçalves</span>
				<form novalidate id="form" action="login.php" method="post" name="formLog">
					<div id="logindiv">
						<label for="inp" class="inp">
						  	<input type="text" value="" name="usuario" id="usuario" class="inp" placeholder="&nbsp;">
						  	<span class="label">Usuário</span>
						  	<span class="border"></span>
						</label>
					</div>
					<span id="helpusuario"></span>
					<span style="color: #535252;" id="digiteusuario"></span>
					<div id="senhadiv">
						<label for="inp" class="inp">
						  	<input type="password" value="" name="senha" id="senha" class="inp" placeholder="&nbsp;">
						  	<span class="label">Senha</span>
						  	<span class="border"></span>
						</label>
					</div>
					<span id="helpsenha"></span>
					<span style="color: #535252;" id="digitesenha"></span>
					<button type="submit" class="button" name="enviar"><span class="spana">Entrar</span></button>
					<input type="hidden" value="1" name="validar">

				</form>
				<?php
					include_once "seguranca.php";
				?>
			</div>
		</div>
	</div>

</body>
</html>