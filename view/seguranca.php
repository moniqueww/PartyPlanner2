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
				$_SESSION['usuario'] = $email;
				$_SESSION['usuario_id'] = $us->getId();				
				echo '<script>window.location.href = "home.php";</script>';
				
			}else if($us->getEmail()==$email && $us->getSenha()!=$senha){
				echo '<script>$("#span_senha").html("Sua senha está incorreta!"); $("#email").val("'.$email.'");</script>';
			}else if($us->getEmail()!=$email && $us->getSenha()==$senha){
				echo '<script>$("#span_email").html("Por favor, digite um email válido!"); $("#span_senha").html("Por favor, digite uma senha válida!");</script>';
			}else if($us->getEmail()!=$email && $us->getSenha()!=$senha){
				echo '<script>$("#span_email").html("Por favor, digite um email válido!"); $("#span_senha").html("Por favor, digite uma senha válida!");</script>';
			}
        }
    }else{
		echo '<script>$("#span_email").html("Por favor, digite um email válido!"); $("#span_senha").html("Por favor, digite uma senha válida!");</script>';
	}
}
?>