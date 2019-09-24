<?php include_once 'include/verifica.php';?>
<?php
    include_once '../autoload.php'; 
    if($_GET['servico']){ // Caso os dados sejam enviados via GET
        $eventoPublicadoControle = new ControleEventoPublicado();
        $eventoPublicadoControle->setVisao($_GET);

	    $eventos = array();
	    $eventos = $eventoPublicadoControle->controleAcao("listarRelacionado", $_GET["servico"]);


        $servicoControle = new ControleServico();
        //Passa o GET desta View para o Controle
        $servicoControle->setVisao($_GET);
      
        $servicoUnico = $servicoControle->controleAcao("listarUnico", $_GET["servico"]);  //value="<?= isset($categoriaAlteracao) ? $categoriaAlteracao->getId() : "";
      
        if (isset($_SESSION['id'])) {
            if($_SESSION['id'] != $_GET['servico']){
                $convidado = true;
            }
        } else {
            $convidado = true;
        }
    }
?>
<!DOCTYPE html>
<html>
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
<?php
$tituloHead = 'Edita servico';
include_once('include/head.php');
?>
<body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<!-- jQuery -->
    <script src="js/jquery.js" crossorigin="anonymous"></script>
	<!-- Meu js -->
	<script src="js/main.js"></script>
    <!-- AjaxForm -->
    <script src="http://malsup.github.com/jquery.form.js"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <script src="js/pesquisa.js"></script>

    <script src="js/perfil.servico.js"></script>

        <div class="wrapper">

        <?php
        $paginaHome = '';
        $paginaLista = '';
        include_once('include/sidebar.php');
        ?>

        <div id="page" class="no-padding">

            <div id="background">

            <?php include_once('include/navbar.php'); ?>

            <div style="padding-right: 15vw; padding-left: calc(15vw - 30px);">

            <!--  Imagem  -->

            <?php if (isset($convidado)) {?>
                <div id="visualizar_imagem_convidado">
                    <img style="background-color: #f7f8fc; width: 250px; height: 250px;" id="image_convidado" src="img/imagens_servico/<?= $servicoUnico->getImagem() ?>"/>
                </div>
            <?php } ?>

            <?php if (!isset($convidado)) { ?>
                <div id="visualizar_imagem">
                    <img style="background-color: #f7f8fc; width: 250px; height: 250px;" id="image" src="img/imagens_servico/<?= $servicoUnico->getImagem() ?>"/>
                </div>       
                <form id="form-image" enctype="multipart/form-data" action="upload-image-servico.php" method="POST">
                    <input type="text" id="input-image-antiga" name="imagemantiga" value="<?= $servicoUnico->getImagem(); ?>"><input>
                    <input id="input-image" name="imagem" type="file">
                </form>
            <?php } ?>

            <!--   ///////////////////////   -->

            <div class="filtros">
                <div class="filtros-tipo">SERVIÇO</div>
                <input type="hidden" id="idServico" name="idServico" value="<?= isset($servicoUnico) ? $servicoUnico->getId() : "";?>"/>
                <input type="hidden" id="idUsuario" name="idUsuario" value="<?= isset($_SESSION['id']) ? $_SESSION['id'] : "";?>"/>
                <input type="hidden" id="convidado" name="convidado" value="<?= isset($convidado) ? 1 : 0;?>"/>
                <div class="filtros-nome">
                    <?php if (!isset($convidado)) {?>
                    <input type="text" id="input-nome" class="form-control form-control-alternative form-edita form-title" placeholder="First name" value="<?= isset($servicoUnico) ? $servicoUnico->getNome() : "";?>">
                    <?php } else {
                        if (isset($servicoUnico)) {
                            echo $servicoUnico->getNome();
                        } else {
                            echo "";
                        }
                    } ?>
                    <form method="POST" action="processa.php" enctype="multipart/form-data">
			<div class="estrelas">
				<input type="radio" id="vazio" name="estrela" value="" checked>
				
				<label for="estrela_um"><i class="fa"></i></label>
				<input type="radio" id="estrela_um" class="estrela" value="1">
				
				<label for="estrela_dois"><i class="fa"></i></label>
				<input type="radio" id="estrela_dois" class="estrela" value="2">
				
				<label for="estrela_tres"><i class="fa"></i></label>
				<input type="radio" id="estrela_tres" class="estrela" value="3">
				
				<label for="estrela_quatro"><i class="fa"></i></label>
				<input type="radio" id="estrela_quatro" class="estrela" value="4">
				
				<label for="estrela_cinco"><i class="fa"></i></label>
				<input type="radio" id="estrela_cinco" class="estrela" value="5">
				
			</div>
        </form>
                <button id="favoritarServico" type="button" class="btn btn-primary btn-add" >
                    <span class="circle btn-inner--icon"><i class="far fa-heart"></i></span>
                </button>  
                </div>
                   
            </div>
            
            <br clear="all">
            </div>
            
        </div>
        <div id="navegacaoEvento">
                <div id="showEdita" class="selected"><?= isset($convidado) ? "Sobre" : "Sobre";?></div>
                <div id="showPublicacao">Eventos Públicos</div>
            </div>


            <div id="edicaoEvento">
                <div class="content big-content">
                <div class="filtros-by">
                    <?php if (!isset($convidado)) {?>
                        EMAIL:
                        <span style="color: rgba(255, 255, 255, 0.7);">EMAIL</span>
                        <input type="text" id="input-email" class="form-control form-control-alternative form-edita form-title" placeholder="First name" value="<?= isset($servicoUnico) ? $servicoUnico->getEmail() : "";?>">
                    <?php } else { ?>
                        <span style="color: rgba(255, 255, 255, 0.7);">EMAIL</span>
                        <span> <?= isset($servicoUnico) ? $servicoUnico->getEmail() : '';?></span>
                    <?php } ?>
                </div>   
                <div class="filtros-by">
                    <?php if (!isset($convidado)) {?>
                        CPNJ:
                        <span style="color: rgba(255, 255, 255, 0.7);">CNPJ</span>
                        <input type="text" id="input-cnpj" class="form-control form-control-alternative form-edita form-title" placeholder="First name" value="<?= isset($servicoUnico) ? $servicoUnico->getCnpj() : "";?>">
                    <?php } else { ?>
                        <span style="color: rgba(255, 255, 255, 0.7);">CNPJ</span>
                        <span> <?= isset($servicoUnico) ? $servicoUnico->getCnpj() : '';?></span>
                    <?php } ?>
                </div>   
                <div class="filtros-by">
                    <?php if (!isset($convidado)) {?>
                        TELEFONE:
                        <span style="color: rgba(255, 255, 255, 0.7);">TELEFONE</span>
                        <input type="text" id="input-telefone" class="form-control form-control-alternative form-edita form-title" placeholder="First name" value="<?= isset($servicoUnico) ? $servicoUnico->getTelefone() : "";?>">
                    <?php } else { ?>
                        <span style="color: rgba(255, 255, 255, 0.7);">TELEFONE</span>
                        <span> <?= isset($servicoUnico) ? $servicoUnico->getTelefone() : '';?></span>
                    <?php } ?>
                </div>
                </div>
            </div>


            <div id="publicacao" style='display: none;'>
                <div class="content big-content">
                    <div class='filtros'>Eventos</div>
                    <?php 
                        if(!empty($eventos)){
                            foreach($eventos as $ev){
                                echo "<div class='content photo'>
                                <div class='card' data-id=".$ev->getId().">
                                    <img class='card-img-top' src='img/imagens_evento/".$ev->getImagem()."' alt='Card image cap'>
                                    <div class='card-body'>
                                        <h5 class='card-title' style='font-weight: 500; color: rgba(50, 50, 93, 0.65);'>".$organizadorUnico->getNome()."</h5>
                                </div>
                                </div>
                            </div>";
                            };
                        }else{
                            echo "teste foda";
                        }
                    ?>
                </div>
            </div>
        </div>
        <div id="action-bar">
                
            </div>
    </div>
        <?php include_once('include/loader.php'); ?>
    <script>
        $('#favoritarServico').on('click', function(){
            idUsuario = 30;
            idServico = $('#idServico').val();
            $.post( "../ajax/favoritaServico.php", {'idServico': idServico, 'idUsuario': idUsuario}, function(data){
                console.log(data);
            }); 
        });
    </script>
</body>
</html>