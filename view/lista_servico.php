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

    <div class="wrapper">

    	<?php include_once('include/sidebarServico.php'); ?>

    	<div id="page">      

    		<?php include_once('include/navbar.php'); ?>
    		
		<div class="filtros">Serviços</div>
    <!-- <form  action="{{ route('search') }}" method="GET" class="form-horizontal"> 
        <div class="form-group row mb-4"> 
            <div class="col-10">
            <input type="text" name="query" id="query" value="{{ request()->input('query') }}" class="search-box" placeholder="Procura por serviço" >
            </div> 
            <button type="submit" class="btn btn-dark"><i class="fa fa-search"></i> Pesquisar</button>
        </div>
    </form> -->
	<?php
		if(!empty($servicos)){
			foreach ($servicos as $serv) {
				echo "<a style='cursor: default;' href='perfil_servico.php?servico=".$serv->getId()."'><div class='content co-15 photo'>
				<div class='card' data-id=".$serv->getId().">
				  <img class='card-img-top' src='img/brand/background.png' alt='Card image cap'>
				  <div class='card-body'>
				    <h5 class='card-title'>".$serv->getNome()."</h5>
				  </div>
				</div>
			</div></a>
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
