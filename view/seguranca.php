<?php
if (isset($_POST['validar']) == 1){
    // session_start inicia a sessão
	include_once '../autoload.php';

    // resgata variáveis do formulário
	$usuarioControle = new ControleUsuario();
	$usuarios = array();
    $usuarios = $usuarioControle->controleAcao("listarTodos");
	$email = isset($_POST['email']) ? $_POST['email'] : '';
    $senha = isset($_POST['senha']) ? $_POST['senha'] : '';
	if(!empty($usuarios)){
        foreach ($usuarios as $us) {
            if($us->getEmail()==$email && $us->getSenha()==$senha){
				unset($_SESSION['usuario']);
				$_SESSION['usuario'] = $us->getNome();
				$_SESSION['email'] = $us->getEmail();
				$_SESSION['id'] = $us->getId();
				$_SESSION['tipo'] = $us->getTipo();	
				if($_SESSION['tipo'] == 'O'){
					echo '<script>window.location.href = "home.php";</script>';
				}else{
					echo "<script>window.location.href='edit_servico.php?servico=".$_SESSION['id']."';</script>";
				}
			}else if($us->getSenha()!=$senha){
				echo '<script>$("#span_alertas").html("Email e/ou senha incorretos"); $("#email").val("'.$email.'");</script>';
			}
        }
    }
}
/*
<?php

//senha: admin1!AAA
include_once '../inc/conexao.inc.php';

if (!empty($_POST)) {
$emailcrip = isset($_POST['email']) ? $_POST['email'] : '';
$senhacrip = isset($_POST['senha']) ? $_POST['senha'] : '';
$custo = '08';
$salt = 'Cf1f11ePArKlBJomM0F6aJ';
$hash = crypt($senhacrip, '$2a$' . $custo . '$' . $salt . '$');
$_SESSION['email'] = $_POST['email'];
$_SESSION['senha'] = $hash;
//$criptografada = '$2a$08$Cf1f11ePArKlBJomM0F6a.Q4YleY6vbeY7dNsm.pHcp3naC8V66Iu';
$sql = "SELECT nome FROM login WHERE senha='{$hash}'";
$resultado = $conexao->query($sql);
$registro = $resultado->fetch_array();

if ($registro) {
$_SESSION['funcionario'] = $registro[0];
}

$email = $_SESSION['email'];
$senha = $_SESSION['senha'];
$sql = " SELECT id, user FROM login " .
" WHERE user = '{$email}' AND senha = '{$senha}'";
$resultado = $conexao->query($sql);
$registro = $resultado->fetch_array();
if (!$registro) {
unset($_SESSION['email']);
unset($_SESSION['senha']);
echo "<div style='margin:0' class='alert alert-danger'>";
echo "<strong>Alerta!</strong> Email e/ou senha não encontrados!";
echo "</div>";
} else {
$_SESSION["login_id"] = $registro["id"];
$_SESSION["login_email"] = $registro["email"];
setcookie("logado", "on");
setcookie("login_id", $registro["id"]);
setcookie("login_email", $registro["email"]);
header('location:../inicial.php');
}
}
*/
?>