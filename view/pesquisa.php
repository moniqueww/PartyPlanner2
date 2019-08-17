<?php include_once 'include/verificaOrganizador.php';?>
<?php include_once 'include/banco.php';?>
<?php
	include_once '../autoload.php';
	$eventoControle = new ControleEventoPublicado();
	$eventos = array();
	if(isset($_GET['procure'])){
		$eventos = $eventoControle->controleAcao("listarTodos", $_GET['procure']);
	}else{
		$eventos = $eventoControle->controleAcao("listarTodos");
	}
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

    <script type="text/javascript">
	$(function() {

		$('.content .card').on('click', function(){
			eventoId = $(this).attr('data-id');
			window.location.assign('divulgacao_evento.php?evento='+eventoId);
		});

		$('#geralPesq').focus();

		$('#geralPesq').on('input', function(){
			if ($(this).val() != ''){
				$('.filtros').hide();
				$('#eventos').hide();
			} else {
				$('.filtros').show();
				$('#eventos').show();
			}
		});
	});
	</script>

    <?php //include_once('include/navbar.php'); ?>

    <div class="wrapper">

    	<?php
    	$paginaHome = '';
    	$paginaLista = '';
    	include_once('include/sidebar.php');
    	?>

    	<div id="page">

    		<?php include_once('include/navbar.php'); ?>

			<div class="filtros">Pesquisas Recentes</div>
			<!-- Page Content -->
			<div id="eventos">
			<?php
				if(!empty($eventos)){
                    foreach (array_reverse($eventos) as $ev) {
                    	$usuarioUnico = $usuarioControle->controleAcao('listarUnico', $ev->getIdUsuario());
                        echo "<div class='content photo'>
				<div class='card' data-id=".$ev->getId().">
				  <img class='card-img-top' src='img/brand/background4.png' alt='Card image cap'>
				  <div class='card-body'>
				    <h5 class='card-title'>".$ev->getNome()."</h5>
				    <h5 class='card-title' style='color: rgba(50, 50, 93, 0.65);'>".$usuarioUnico->getNome()."</h5>
				  </div>
				</div>
			</div><br clear='all'/>";
                    }
                }
            ?>
	  		</div>
		</div>
		<div id="action-bar">
		        
		</div>
    </div>
	
</body>
</html>