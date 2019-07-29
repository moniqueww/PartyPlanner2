<?php //include_once 'include/verifica.php';?>
<?php include_once 'include/banco.php';?>
<?php
	include_once '../autoload.php';
	$eventoControle = new ControleEvento();
	$eventos = array();
	if(isset($_GET['procure'])){
		$eventos = $eventoControle->controleAcao("listarTodos", $_GET['procure'], '1');
	}else{
		$eventos = $eventoControle->controleAcao("listarTodos", '', '1');
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

    <script type="text/javascript">
	$(function() {
		$('#cadastrarEvento').on('click', function(){
			$('#cadastrarEvento').attr('disabled', '');
			var nome = $('#nome').val();
			$.post( "../controle/cadastraEvento.php", {'nome': nome}, function(data){
				console.log(data);
				data = $.parseJSON( data );
				$('#cadastrarEvento').removeAttr('disabled', '');
				$('#cancelarCadastro').click();
				$('#eventos').prepend(
					$('<div>', {class: 'content co-2 photo normal-shadow'}).append(
						$('<div>', {class: 'card', 'data-id': data.id}).on('mouseover', function(){
							if ($(this).children('.novoEvento') != null) {
								$(this).children('.novoEvento').fadeOut();
							}
						}).on('dblclick', function(){
							eventoId = $(this).attr('data-id');
							window.location.assign('form_evento.php?evento='+eventoId);
						}).append(
							$('<img>', {class: 'card-img-top', height: '200px', src: "img/background.png"}),
							$('<div>', {class: 'card-body'}).append(
								$('<h5>', {class: 'card-title', html: data.nome})
							),
							$('<div>', {class: 'novoEvento', html: 'NOVO'})
						)
					).hide().fadeIn("slow")
				);
			});
		});
		$('#cancelarCadastro').on('click', function(){
			$('#nome').val('');
		});

		$('.content .card').on('click', function(){
			eventoId = $(this).attr('data-id');
			window.location.assign('form_evento.php?evento='+eventoId);
		});
	});
	</script>

    <?php include_once('include/navbar.php'); ?>

    <div class="wrapper">

    	<?php include_once('include/sidebar.php'); ?>

    	<div id="page">
			<div class="filtros float-right simple-margin-right">
				 <button type="button" class="btn btn-primary btn-add" data-toggle="modal" data-target="#modal-form">
					<span class="circle btn-inner--icon"><i class="ni ni-fat-add"></i></span>
					<span class="btn-inner--text">Novo Evento</span>
				</button>
				<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
					<div class="modal-dialog modal- modal-dialog-centered" role="document">
						<div class="modal-content">                  
                            <div class="modal-header">
                                <h6 class="modal-title" id="modal-title-default">Cadastro de evento</h6>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <form>
								<div class="modal-body" style="padding: 0 1.5rem 1.5rem 1.5rem;">
									<div>
										<small>Nome</small>
									</div>
									<input class="form-control form-control-alternative" name="nome" id="nome" placeholder="Nome do evento" type="text">
								</div>
								<div class="modal-footer">
									<input id="cadastrarEvento" type="submit" class="btn btn-primary" value="Criar evento"/>
									<button id="cancelarCadastro" type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Cancelar</button> 
								</div>
							</form>
                        </div>
					</div>
				</div>
				<button type="button" class="btn btn-danger btn-add no-margin-right" data-toggle="modal" data-target="#modal-notification">
					<i class="far fa-trash-alt"></i>
				</button>
				<div class="modal fade" id="modal-notification" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
					<div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
						<div class="modal-content bg-gradient-danger">
							<div class="modal-header">
								<h6 class="modal-title" id="modal-title-notification">Your attention is required</h6>
								<button id="cancelarCadastroMini" type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">×</span>
								</button>
							</div>
							<div class="modal-body">
								<div class="py-3 text-center">
									<i class="ni ni-bell-55 ni-3x"></i>
									<h4 class="heading mt-4">You should read this!</h4>
									<p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-white">Ok, Got it</button>
								<button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">Close</button> 
							</div>        
						</div>
					</div>
				</div>
			</div>
			<div class="filtros">Seus eventos</div>
			<!-- Page Content -->
			<div id="eventos">
			<?php
				if(!empty($eventos)){
                    foreach (array_reverse($eventos) as $ev) {
                        echo "<div class='content co-2 photo normal-shadow'>
				<div class='card' data-id=".$ev->getId().">
				  <img class='card-img-top' height='200px' src='img/background.png' alt='Card image cap'>
				  <div class='card-body'>
				    <h5 class='card-title'>".$ev->getNome()."</h5>
				  </div>
				</div>
			</div>";
                    }
                }
            ?>
			<!--@foreach($eventos->reverse(); as $evento)
			<a href="/quadro/{{$evento->id}}">
			<div class="content co-2 photo normal-shadow">
				<div class="card" data-id="{{$evento->id}}">
				  <img class="card-img-top" height="200px" src="{{URL::asset('/img/background.png')}}" alt="Card image cap">
				  <div class="card-body">
				    <h5 class="card-title">{{$evento->nome}}</h5>
				  </div>
				</div>
			</div>
			</a>
      @endforeach-->
	  		</div>
		</div>
    </div>
	
</body>
</html>