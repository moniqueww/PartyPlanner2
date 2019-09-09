<?php include_once 'include/verificaOrganizador.php';?>
<?php include_once 'include/banco.php';?>
<?php
	include_once '../autoload.php';
	$eventoControle = new ControleEvento();
	$eventos = array();
	if(isset($_GET['procure'])){
		$eventos = $eventoControle->controleAcao("listarTodos", $_GET['procure'], $_SESSION['id']);
	}else{
		$eventos = $eventoControle->controleAcao("listarTodos", '', $_SESSION['id']);
	}
	$usuarioControle = new ControleOrganizador();
?>
<!DOCTYPE html>
<html>
<?php
$tituloHead = 'Seus eventos';
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

    <script src="js/eventos.js"></script>

    <?php //include_once('include/navbar.php'); ?>

    <div class="wrapper">

    	<?php 
    	$paginaHome = '';
    	$paginaLista = "class='active'";
    	include_once('include/sidebar.php');
    	?>

    	<div id="page">

    		<?php include_once('include/navbar.php'); ?>

    		<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
					<div class="modal-dialog modal- modal-dialog-centered" role="document">
						<div class="modal-content">                  
                            <div class="modal-header">
                                <h6 class="modal-title" id="modal-title-default">Cadastro</h6>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
								<div class="modal-body" style="padding: 60px 1.5rem 1.5rem 1.5rem;">
									<div>
										<h4 class="heading mt-4">Nome do evento</h4>
									</div>
									<input class="form-control form-control-alternative" name="nome" id="nome" placeholder="Escreva aqui..." type="text">
								</div>
								<div class="modal-footer">
									<input id="cadastrarEvento" type="submit" class="btn btn-primary" value="Criar evento"/>
									<button id="cancelarCadastro" type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Cancelar</button> 
								</div>
                        </div>
					</div>
				</div>

				<div class="modal fade" id="modal-notification" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
					<div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h6 class="modal-title" id="modal-title-notification">Atenção</h6>
								<button id="cancelarCadastroMini" type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">×</span>
								</button>
							</div>
							<div class="modal-body" style="padding: 60px 1.5rem 1.5rem 1.5rem;">
								<div class="py-3 text-center">
									<i class="ni ni-bell-55 ni-3x"></i>
									<h4 class="heading mt-4">Tem certeza que deseja excluir o evento?</h4>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" id="confirmarExclusao" class="btn btn-danger">Confirmar</button>
								<button type="button" id="cancelarExclusao" class="btn btn-link text-danger ml-auto" data-dismiss="modal">Cancelar</button> 
							</div>        
						</div>
					</div>
				</div>

			<input type="hidden" name="idUsuario" id="idUsuario" value="<?php echo $_SESSION['id']; ?>"/>
			<div class="filtros no-margin">Seus Eventos</div>
			<div class="filtros-right simple-margin-right">
				 <button type="button" class="btn btn-primary btn-add" data-toggle="modal" data-target="#modal-form">
					<span class="btn-inner--text">Novo Evento</span>
				</button>
				<!--<button type="button" class="btn btn-outro btn-add no-margin-right" data-toggle="modal" data-target="#modal-notification">
					<i class="fas fa-ellipsis-h"></i>
				</button>-->
			</div>
			<!-- Page Content -->
			<div id="eventos">
			<?php
				if(!empty($eventos)){
					foreach (array_reverse($eventos) as $ev) {
						$publicado = '';
						if ($ev->getStatus() == 1) {
							$publicado = "<div class='publicadoEvento'>PUBLICADO</div>";
						}
						$usuarioUnico = $usuarioControle->controleAcao('listarUnico', $ev->getIdUsuario());
						echo "<div class='content photo'>
				<div class='card' data-id=".$ev->getId().">
					<img class='card-img-top' src='img/brand/background4.png' alt='Card image cap'>
					<div class='card-body'>
						<h5 class='card-title'>".$ev->getNome()."</h5>
						<h5 class='card-title' style='font-weight: 500; color: rgba(50, 50, 93, 0.65);'>".$usuarioUnico->getNome()."</h5>
				</div>
				".$publicado."
				<div class='excluirEvento' data-toggle='modal' data-target='#modal-notification'><i class='fas fa-times'></i></div>
				</div>
			</div>";
					}
				}
			?>
	  		</div>
	  		<div id="not-found" style="display: none; text-align: center; margin-top: 20vh;">
	  			<img style="width: 20%;" src="img/svg/create-event3.svg">
				  <div class="filtros" style="font-size: 2rem; margin: 0;">Você não possui eventos criados</div>
				  <p style="margin-bottom: 35px;">Crie e organize um evento agora mesmo clicando no botão abaixo!</p>
	  			  <button type="button" class="btn btn-primary btn-add" data-toggle="modal" data-target="#modal-form">
	  				<span class="btn-inner--text">Novo Evento</span>
	  			</button>
	  		</div>
		</div>
		<div id="action-bar">
		        
		</div>
    </div>
	
</body>
</html>