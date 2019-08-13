<?php include_once 'include/verificaServico.php';?>
<?php include_once 'include/banco.php';?>
<?php
	include_once '../autoload.php';
	$servicoControle = new ControleServico();
	$servicos = array();
	if(isset($_GET['procure'])){
		$servicos = $servicoControle->controleAcao("listarTodos", $_GET['procure']);
	}else{
		$servicos = $servicoControle->controleAcao("listarTodos");
	}
	/*$sql = "select * from categoria";
	$categorias = $conexao->query($sql);
	$total = mysqli_num_rows($categorias);
	$registros = 10;
	$numPaginas = ceil($total/$registros);
	$pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;
	$inicio = ($registros*$pagina)-$registros;
	$sql = "select * from categoria limit $inicio,$registros";
	$categorias = $conexao->query($sql);
	$total = mysqli_num_rows($categorias);*/
?>
<!DOCTYPE html>
<html>
<head>
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

	<style>
	.estrelas input[type=radio]{
	display: none;
}.estrelas label i.fa:before{
	content: '\f005';
	color: #FC0;
}.estrelas  input[type=radio]:checked  ~ label i.fa:before{
	color: #CCC;
}
	</style>
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

    <?php include_once('include/navbar.php'); ?>

    <div class="wrapper">

    	<?php include_once('include/sidebar.php'); ?>

    	<div id="page">      
<h1 class="text-center mb-3">Listagem de Serviços</h1>
    <!-- <form  action="{{ route('search') }}" method="GET" class="form-horizontal"> 
        <div class="form-group row mb-4"> 
            <div class="col-10">
            <input type="text" name="query" id="query" value="{{ request()->input('query') }}" class="search-box" placeholder="Procura por serviço" >
            </div> 
            <button type="submit" class="btn btn-dark"><i class="fa fa-search"></i> Pesquisar</button>
        </div>
    </form> -->
    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
				<th scope="col">Nome</th>
				<th scope="col">E-mail</th>
                <th scope="col">Cnpj</th>
				<th scope="col">Avaliar</th>
            </tr>
        </thead>
		<?php
		if(!empty($servicos)){
			foreach ($servicos as $serv) {
				echo "
					<tbody>
						<tr>
						
							<th scope='row'><a href='perfil_servico.php?servico=".$serv->getId()."'>".$serv->getId()."</a></th>
							<td><a style='' href='perfil_servico.php?servico=".$serv->getId()."'>".$serv->getNome()."</a></td>  
							<td><a href='perfil_servico.php?servico=".$serv->getId()."'>".$serv->getEmail()."</a></td>  
							<td><a href='perfil_servico.php?servico=".$serv->getId()."'>".$serv->getCnpj()."</a></td> 
							<td><form method='POST' action='processa.php' enctype='multipart/form-data'>
							<div class='estrelas'>
								<input type='radio' id='vazio' name='estrela' value='' checked>
								
								<label for='estrela_um'><i class='fa'></i></label>
								<input type='radio' id='estrela_um' name='estrela' value='1'>
								
								<label for='estrela_dois'><i class='fa'></i></label>
								<input type='radio' id='estrela_dois' name='estrela' value='2'>
								
								<label for='estrela_tres'><i class='fa'></i></label>
								<input type='radio' id='estrela_tres' name='estrela' value='3'>
								
								<label for='estrela_quatro'><i class='fa'></i></label>
								<input type='radio' id='estrela_quatro' name='estrela' value='4'>
								
								<label for='estrela_cinco'><i class='fa'></i></label>
								<input type='radio' id='estrela_cinco' name='estrela' value='5'><br><br>
								
								<input type='submit' value='Cadastrar'>
								
							</div>
						</form> </td> 
						</tr>	
					</tbody>
				";
			}
		}
		?>
        <script type="text/javascript">
	
	$(function() {
        $('#selectAddEvento').on('change', function(){
            pagEvento = $(this).val();
            window.location.assign(pagEvento);
        });
    });
        </script>
