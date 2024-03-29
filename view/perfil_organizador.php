<?php include_once 'include/verificaOrganizador.php';?>
<?php
    include_once '../autoload.php'; 
	if($_GET['organizador']){ // Caso os dados sejam enviados via GET

        $eventoPublicadoControle = new ControleEventoPublicado();
        $eventoPublicadoControle->setVisao($_GET);

	    $eventos = array();
	    $eventos = $eventoPublicadoControle->controleAcao("listarRelacionado", $_GET["organizador"]);

        $organizadorControle = new ControleOrganizador();
        //Passa o GET desta View para o Controle
        $organizadorControle->setVisao($_GET);
    
        $organizadorUnico = $organizadorControle->controleAcao("listarUnico", $_GET["organizador"]);  //value="<?= isset($categoriaAlteracao) ? $categoriaAlteracao->getId() : "";
    
        if($_SESSION['id'] != $_GET['organizador']){
            $convidado = true;;
        } 
    }
?>
<!DOCTYPE html>
<html>
<?php
$tituloHead = 'Edita Organizador';
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

    <script src="js/perfil.organizador.js"></script>

    <div class="wrapper">

        <?php
        $paginaHome = '';
        $paginaLista = '';
        if (!isset($convidado)) {
            $paginaPerfil = "class='active'";
        }
        include_once('include/sidebar.php');
        ?>

        <div id="page" class="no-padding">

            <div id="background">

            <?php include_once('include/navbar.php'); ?>

            <div style="padding-right: 15vw; padding-left: calc(15vw - 30px);">

            <!--  Imagem  -->
            <?php if (isset($convidado)) {?>
                <div id="visualizar_imagem_convidado">
                    <img class="circle" style="background-color: #f7f8fc; width: 250px; height: 250px;" id="image_convidado" src="img/imagens_organizador/<?= $organizadorUnico->getImagem() ?>"/>
                </div>
            <?php } ?>

            <?php if (!isset($convidado)) { ?>
                <div id="visualizar_imagem">
                    <img class="circle" style="background-color: #f7f8fc; width: 250px; height: 250px;" id="image" src="img/imagens_organizador/<?= $organizadorUnico->getImagem() ?>"/>
                </div>       
                <form id="form-image" enctype="multipart/form-data" action="upload-image-organizador.php" method="POST">
                    <input type="text" id="input-image-antiga" name="imagemantiga" value="<?= $organizadorUnico->getImagem(); ?>"><input>
                    <input id="input-image" name="imagem" type="file">
                </form>
            <?php } ?>            
            <!--  -----------  -->

            <div class="filtros">
                <div class="filtros-tipo">ORGANIZADOR</div>
                <input type="hidden" id="idOrganizador" name="idOrganizador" value="<?= isset($organizadorUnico) ? $organizadorUnico->getId() : "";?>"/>
                <input type="hidden" id="convidado" name="convidado" value="<?= isset($convidado) ? 1 : 0;?>"/>
                <div class="filtros-nome">
                    <?php if (!isset($convidado)) {?>
                    <input type="text" id="input-nome" class="form-control form-control-alternative form-edita form-title" placeholder="First name" value="<?= isset($organizadorUnico) ? $organizadorUnico->getNome() : "";?>">
                    <?php } else {
                        if (isset($organizadorUnico)) {
                            echo $organizadorUnico->getNome();
                        } else {
                            echo "";
                        }
                    } ?>
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
                <div class="content big-content" style="background-color: #2d2c2c; border: none;">
                <div class="filtros">Email</div>
                    <?php if (!isset($convidado)) {?>
                        <input type="text" id="input-email" class="form-control form-control-alternative form-edita form-title" placeholder="First name" value="<?= isset($organizadorUnico) ? $organizadorUnico->getEmail() : "";?>">
                    <?php } else { ?>
                        <span> <?= isset($organizadorUnico) ? $organizadorUnico->getEmail() : '';?></span>
                    <?php } ?>
                </div>
            </div>


            <div id="publicacao" style='display: none;'>
                <div class="content big-content">
                    <div class='filtros'>Eventos</div>
                    <?php 
                        if(!empty($eventos)){
                            foreach($eventos as $ev){
                                echo "<div class='content photo' style='width: 23%;'>
                                <div class='card' data-id=".$ev->getId().">
                                    <a href='form_evento.php?evento=".$ev->getId()."'>
                                        <img class='card-img-top' src='img/imagens_evento/".$ev->getImagem()."' alt='Card image cap'>
                                    </a>
                                    <div class='card-body'>
                                        <h5 class='card-title'>".$ev->getNome()."</h5>
                                </div>
                                </div>
                            </div>";
                            };
                        }else{
                            echo "O organizador não possui nenhum evento público.";
                        }
                    ?>
                </div>
            </div>
    </div>
</div>
</body>
</html>