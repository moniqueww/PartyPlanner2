<?php include_once 'include/verificaOrganizador.php';?>
<?php
	include_once '../autoload.php';
	$eventoControle = new ControleEventoPublicado();
	$eventosPublicados = array();
	if(isset($_GET['procure'])){
		$eventosPublicados = $eventoControle->controleAcao("listarTodos", $_GET['procure']);
	}else{
		$eventosPublicados = $eventoControle->controleAcao("listarTodos");
	}

	$servicoControle = new ControleServico();
	$servicos = $servicoControle->controleAcao('listarTodos');
	$usuarioControle = new ControleOrganizador();
?>
<!DOCTYPE html>
<html>
<?php
$tituloHead = 'Home';
include_once('include/head.php');
?>
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

    <script src="js/pesquisa.js"></script>

    <script type="text/javascript">
	$(function() {
		$('.content .card:not(.card-redondo)').on('click', function(){
			eventoId = $(this).attr('data-id');
			window.location.assign('form_evento.php?evento='+eventoId);
		});
		$('.content .card.card-redondo').on('click', function(){
			servicoId = $(this).attr('data-id');
			window.location.assign('perfil_servico.php?servico='+servicoId);
		});
	});
	</script>

    <?php //include_once('include/navbar.php'); ?>

    <div class="wrapper">

    	<?php
    	$paginaHome = "class='active'";
    	$paginaLista = '';
    	include_once('include/sidebar.php');
    	?>

    	<div id="page">

    		<?php include_once('include/navbar.php'); ?>

    		<div class="banner"></div>

    		<div id="navegacaoPage">
    		    <div class="selected">Feed</div>
    		    <div>Descubra</div>
    		    <br clear="all"/>
    		</div>

			<div class="filtros">Home</div>
			<!-- Page Content -->
			<div id="eventos">
			<div class="filtros-mini">Eventos populares</div>
			<div id="mais-populares" style="white-space: nowrap; margin-bottom: 50px;">
				<?php
					if(!empty($eventosPublicados)){
						foreach ($eventosPublicados as $ev) {
							$usuarioUnico = $usuarioControle->controleAcao('listarUnico', $ev->getIdUsuario());
							echo "<div class='content photo' style='float: none; margin-right: 2%;'>
					<div class='card' data-id=".$ev->getId().">
					<img class='card-img-top' src='img/imagens_evento/".$ev->getImagem()."' alt='Card image cap'>
					<div class='card-body'>
						<h5 class='card-title'>".$ev->getNome()."</h5>
						<h5 class='card-title' style='font-weight: 500; color: #999999;'>".$usuarioUnico->getNome()."</h5>
					</div>
					</div>
				</div>";
						}
					}
				?>
			</div>
			<div class="filtros-mini">Eventos recentes</div>
			<div id="mais-recentes" style="white-space: nowrap; margin-bottom: 50px;">
				<?php
					if(!empty($eventosPublicados)){
						foreach ($eventosPublicados as $ev) {
							$usuarioUnico = $usuarioControle->controleAcao('listarUnico', $ev->getIdUsuario());
							echo "<div class='content photo' style='float: none; margin-right: 2%;'>
					<div class='card' data-id=".$ev->getId().">
					<img class='card-img-top' src='img/imagens_evento/".$ev->getImagem()."' alt='Card image cap'>
					<div class='card-body'>
						<h5 class='card-title'>".$ev->getNome()."</h5>
						<h5 class='card-title' style='font-weight: 500; color: #999999;'>".$usuarioUnico->getNome()."</h5>
					</div>
					</div>
				</div>";
						}
					}
				?>
			</div>
			<div class="filtros-mini">Serviços populares</div>
			<div id="mais-recentes" style="white-space: nowrap; margin-bottom: 50px;">
				<?php
					if(!empty($servicos)){
						$sevc = 0;
						foreach ($servicos as $se) {
							if ($sevc < 6) {
							echo "<div class='content photo' style='float: none; margin-right: 2%;'>
					<div class='card card-redondo' data-id=".$se->getId().">
					<img style='height: calc((100vw - 480px) / 6.98) !important; width: 100%;' class='card-img-top' src='img/imagens_servico/".$se->getImagem()."' alt='Card image cap'>
					<div class='card-body'>
						<h5 class='card-title'>".$se->getNome()."</h5>
					</div>
					</div>
				</div>";
							}
							$sevc++;
						}
					}
				?>
			</div>
			</div>
			</div>
		<div id="action-bar">
		        
		</div>
    </div>
	
</body>
</html>