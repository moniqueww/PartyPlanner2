<?php
include_once 'include/verifica.php';
//Include das classes via autoload
include_once '../autoload.php';
//Caso tenha sido feito um POST da página
if($_POST){
    //Cria o Controle desta View (página)
    $servicoControle = new ControleServico();

    //Passa o POST desta View para o Controle
    $servicoControle->setVisao($_POST);
    //Verifica qual ação (inserir ou alterar) vai passar para o Controle
    if(empty($_POST["id"])){
        $retorno = $servicoControle->controleAcao("inserir");
        if($retorno) {$msg="Cadastro efetuado com sucesso!";}
        else{$erro="Houve um erro no seu cadastro!";}
    }else{
        $retorno = $servicoControle->controleAcao("alterar", $_POST["id"]);
        if($retorno) {$msg="Cadastro efetuado com sucesso!";}
        else{$erro="Houve um erro no seu cadastro!";}
    }
   
}elseif($_GET){ // Caso os dados sejam enviados via GET
   
    //Cria o Controle desta View (página)
    $servicoControle = new ControleServico();
    //Passa o GET desta View para o Controle
    $servicoControle->setVisao($_GET);
            
    //Verifico qual operação será realizada
    if(isset($_GET["op"])){
        
        //Verifico a existência dos campos obrigatórios
        if (isset($_GET["id"])) {
            
            //Verifica qual ação (excluir ou listar para alteração) vai passar para o Controle
            if($_GET["op"] == "exc"){
                // excluir o cliente do banco de dados
                $retorno=$servicoControle->controleAcao("excluir");
                if($retorno) {$msg="Servico excluído com sucesso!";}
                else{$erro="Houve um erro na exclusão do aluno!";}
            }elseif ($_GET["op"] == "alt") {
                // O $clienteAlteracao será utilizado no formulário para preencher os dados do cliente 
                // que foram pesquisados no banco de dados
                $organizadorAlteracao = $organizadorControle->controleAcao("listarUnico",$_GET["id"]);
            }
        }    

    }
}

	// include_once '../autoload.php';
	// $categoriaControle = new ControleCategoria();
	// $categoria = array();
	// if(isset($_GET['procure'])){
	// 	$categoria = $categoriaControle->controleAcao("listarTodos", $_GET['procure']);
	// }else{
	// 	$categoria = $categoriaControle->controleAcao("listarTodos");
	// }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Cadastrar serviço</title>
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="js/main.js"></script>
	<style>
		.red{
			margin-left: 5px;
			color: #ff868c;
			position: absolute;
			margin-top: 5px;
			font-family: 'Montserrat';
		}
	</style>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Comfortaa" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css">
	
	<!-- Favicon -->
	<link href="img/brand/favicon.png" rel="icon" type="image/png">
	<!-- Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
	<!-- Icons -->
	<link href="vendor/nucleo/css/nucleo.css" rel="stylesheet">
	<link href="vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
	<!-- Argon CSS -->
	<link type="text/css" href="css/argon.css?v=1.0.0" rel="stylesheet">
</head>
<body>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<!-- jQuery -->
    <script src="js/jquery.js" crossorigin="anonymous"></script>
	<!-- Meu js -->
	<script src="js/main.js"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

</head>
<body>
<?php include_once('include/navbar.php'); ?>

	<?php
		$pagina = basename( __FILE__ );
    ?>
	<div id="page">
					<form action="form_servico.php" method="post">
						<div class="modal-body" style="padding: 0 1.5rem 1.5rem 1.5rem;">
									<div>
										<small>Nome</small>
									</div>
									<input class="form-control form-control-alternative" name="nome" id="nome" placeholder="Nome" type="text">
								</div>
								<div class="modal-body" style="padding: 0 1.5rem 1.5rem 1.5rem;">
									<div>
										<small>Email</small>
									</div>
									<input class="form-control form-control-alternative" name="email" id="email" placeholder="Email" type="email">
								</div>
								<div class="modal-body" style="padding: 0 1.5rem 1.5rem 1.5rem;">
									<div>
										<small>Senha</small>
									</div>
									<input class="form-control form-control-alternative" name="senha" id="senha" placeholder="Senha" type="password">
								</div>
								<div class="modal-body" style="padding: 0 1.5rem 1.5rem 1.5rem;">
									<div>
										<small>CNPJ</small>
									</div>
									<input class="form-control form-control-alternative" name="cnpj" id="cnpj" placeholder="CNPJ" type="number">
								</div>
								<div class="modal-body" style="padding: 0 1.5rem 1.5rem 1.5rem;">
									<div>
										<small>Telefone</small>
									</div>
									<input class="form-control form-control-alternative" name="telefone" id="telefone" placeholder="Telefone" type="number	">
								</div>
								<div class="modal-body" style="padding: 0 1.5rem 1.5rem 1.5rem;">
									<div>
										<small>Categoria</small>
									</div>
									<select>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
								</div>
						<br clear="all"/>
						<button id="button" type="submit" class="button" name="cadastrar">Cadastrar</button>
						<br clear="all"/>
					</form>
			</section>
		</div>
	</div>
        
</body>
</html>