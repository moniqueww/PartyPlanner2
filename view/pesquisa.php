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
$tituloHead = 'Pesquisa';
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
				$('#filtro-recente').hide();
				$('#recentes').hide();
				$('#procura').show();
				nomePesquisa = $(this).val();
				$.post( "../ajax/buscaTudo.php", {'nome': $(this).val()}, function(data){
					data = $.parseJSON( data );
					$('#eventos .conteudo').html('');
					if (data.eventos.length || data.servicos.length || data.organizadores.length) {
					$('#filtro-procura').show();
					$('#not-found').hide();
					if (data.eventos.length){
						$('#eventos').show();
						for (var i = 0; i < data.eventos.length; i++) {
							if (i > 3) {
								break;
							}
							$('#eventos .conteudo').append(
								$('<div>', {'data-id': data.eventos[i].id, id: 'eventos_'+data.eventos[i].id, class: 'content co-5 mini-card no-padding'}).append(
									$('<img>', {src: 'img/brand/background4.png'}),
									$('<div>').append(
										$('<div>', {html: data.eventos[i].nome}),
										$('<div>', {html: data.eventos[i].nome})
									)
								).on('click', function(){
									eventoId = $(this).attr('data-id');
									window.location.assign('form_evento.php?evento='+eventoId);
								})
							);
						}
					} else {
						$('#eventos').hide();
					}
					$('#servicos .conteudo').html('');
					if (data.servicos.length){
						$('#servicos').show();
						for (var h = 0; h < data.servicos.length; h++) {
							if (h > 3) {
								break;
							}
							$('#servicos .conteudo').append(
								$('<div>', {'data-id': data.servicos[h].id, id: 'servico_'+data.servicos[h].id, class: 'content co-5 mini-card no-padding'}).append(
									$('<img>', {class: 'circle', src: 'img/brand/background4.png'}),
									$('<div>').append(
										$('<div>', {html: data.servicos[h].nome}),
										$('<div>', {html: data.servicos[h].nome})
									)
								).on('click', function(){
									servicoId = $(this).attr('data-id');
									window.location.assign('perfil_servico.php?servico='+servicoId);
								})
							);
						}
					} else {
						$('#servicos').hide();
					}
					$('#organizadores .conteudo').html('');
					if (data.organizadores.length){
						$('#organizadores').show();
						for (var h = 0; h < data.organizadores.length; h++) {
							if (h > 3) {
								break;
							}
							$('#organizadores .conteudo').append(
								$('<div>', {'data-id': data.organizadores[h].id, id: 'servico_'+data.organizadores[h].id, class: 'content co-5 mini-card no-padding'}).append(
									$('<img>', {class: 'circle', src: 'img/brand/background4.png'}),
									$('<div>').append(
										$('<div>', {html: data.organizadores[h].nome}),
										$('<div>', {html: data.organizadores[h].nome})
									)
								)
							);
						}
					} else {
						$('#organizadores').hide();
					}
					} else {
						$('#filtro-procura').hide();
						$('#eventos').hide();
						$('#servicos').hide();
						$('#organizadores').hide();
						$('#not-found').show();
						$('#not-found .filtros').html('Nenhum resultado encontrado para "'+nomePesquisa+'"');
					}
				})
			} else {
				$('#filtro-recente').show();
				$('#recentes').show();
				$('#procura').hide();
			}
		});
		if ($('#geralPesq').val() != '') {
			$('#geralPesq').trigger('input');
		}
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

			<div id="filtro-recente" class="filtros">Pesquisas Recentes</div>
			<!-- Page Content -->
			<div id="recentes">
			<?php
				if(!empty($eventos)){
                    foreach (array_reverse($eventos) as $ev) {
                    	$usuarioUnico = $usuarioControle->controleAcao('listarUnico', $ev->getIdUsuario());
                        echo "<div class='content co-10 mini-card no-padding'>
				  <img src='img/brand/background4.png'/>
				  <div>
				    <div>".$ev->getNome()."</div>
				    <div style='color: rgba(50, 50, 93, 0.65);'>".$usuarioUnico->getNome()."</div>
				  </div>
			</div><br clear='all'/>";
                    }
                }
            ?>
	  		</div>
	  		<div id="procura" style="display: none;">
	  			<div id="filtro-procura" class="filtros">Resultados</div>
	  			<div style="width: 45%; float: left; display: inline-block; margin-right: 4%;" id="eventos">
	  				<div class="filtros-mini">Eventos</div>
	  				<div class="conteudo"></div>
	  			</div>
	  			<div style="width: 45%; float: left; display: inline-block; margin-right: 4%;" id="servicos">
	  				<div class="filtros-mini">Serviços</div>
	  				<div class="conteudo"></div>
	  			</div>
	  			<div style="width: 45%; float: left; display: inline-block; margin-right: 4%;" id="organizadores">
	  				<div class="filtros-mini">Organizadores</div>
	  				<div class="conteudo"></div>
	  			</div>
	  			<div id="not-found" style="display: none; text-align: center; margin-top: 20vh;">
	  				<img style="width: 20%;" src="img/svg/not-found.svg"/>
	  				<div class="filtros" style="font-size: 2rem; margin: 0;"></div>
	  				<p style="width: 30%; margin: auto;">Verifique se ocorreu algum erro de digitação ou tente usar outras palavras-chave</p>
	  			</div>
	  		</div>
		</div>
		<div id="action-bar">
		        
		</div>
    </div>
	
</body>
</html>