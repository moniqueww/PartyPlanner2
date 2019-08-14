<?php
session_start();
include_once 'include/banco.php';
include_once '../autoload.php';
include_once 'include/verifica.php';


if(!empty($_POST['estrela'])){
	$estrela = $_POST['estrela'];
	$id = $_POST['id_servico'];
	//Salvar no banco de dados
	$result_avaliacos = "INSERT INTO estrelas (id_servico, qnt_estrelas) VALUES ('$id','$estrela')";
	$resultado_avaliacos = mysqli_query($conexao, $result_avaliacos);
	
	if(mysqli_insert_id($conexao)){
		$_SESSION['msg'] = "Avaliação cadastrada com sucesso";
		header("Location: lista_servico.php");
	}else{
		$_SESSION['msg'] = "Erro ao cadastrar a avaliação";
		header("Location: login.php");
	}
	
}else{
	$_SESSION['msg'] = "Necessário selecionar pelo menos 1 estrela";
	header("Location: login.php");
}