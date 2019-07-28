<?php
if (isset($_POST['validar']) == 1){
    // session_start inicia a sessão
	include_once '../autoload.php';

    // resgata variáveis do formulário
	$usuarioControle = new ControleUsuario();
	$usuarios = array();
    $usuarios = $usuarioControle->controleAcao("listarTodos");
	
	$login = isset($_POST['usuario']) ? $_POST['usuario'] : '';
    $senha = isset($_POST['senha']) ? $_POST['senha'] : '';
	$custo = '08';
	$salt = 'Cf1f11ePArKlBJomM0F6aJ';
	$hash = crypt($senha, '$2a$' . $custo . '$' . $salt . '$');
	$senha = $hash;
	if(!empty($usuarios)){
        foreach ($usuarios as $al) {
            if($al->getLogin()==$login && $al->getSenha()==$senha){
				unset($_SESSION['usuario']);
				$_SESSION['usuario'] = $login;
				$_SESSION['usuario_id'] = $al->getId();				
				echo '<script>window.location.href = "home.php";</script>';
			}else if($al->getLogin()==$login && $al->getSenha()!=$senha){
				echo '<script>$("#helpsenha").html("Sua senha está incorreta!"); $("#usuario").val("'.$login.'");</script>';
			}else if($al->getLogin()!=$login && $al->getSenha()==$senha){
				echo '<script>$("#helpusuario").html("Por favor, digite um usuário válido!"); $("#helpsenha").html("Por favor, digite uma senha válida!");</script>';
			}else if($al->getLogin()!=$login && $al->getSenha()!=$senha){
				echo '<script>$("#helpusuario").html("Por favor, digite um usuário válido!"); $("#helpsenha").html("Por favor, digite uma senha válida!");</script>';
			}
        }
    }else{
		echo '<script>$("#helpusuario").html("Por favor, digite um usuário válido!"); $("#helpsenha").html("Por favor, digite uma senha válida!");</script>';
	}
}
?>