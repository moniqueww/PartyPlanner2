<?php include_once 'include/verificaServico.php';?>
<?php
    include_once '../autoload.php'; 
    if($_GET['servico']){ // Caso os dados sejam enviados via GET
        $servicoControle = new ControleServico();
        //Passa o GET desta View para o Controle
        $servicoControle->setVisao($_GET);
      
        $servicoUnico = $servicoControle->controleAcao("listarUnico", $_GET["servico"]);  //value="<?= isset($categoriaAlteracao) ? $categoriaAlteracao->getId() : "";
      
        if($_SESSION['id'] != $_GET['servico']){
          $convidado = true;;
        } 
    }
?>
<!DOCTYPE html>
<html>
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
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script src="js/perfil.servico.js"></script>

        <div class="wrapper">

        <?php
        include_once('include/sidebarServico.php');
        ?>

        <div id="page" class="no-padding">

            <div id="background">

            <?php include_once('include/navbar.php'); ?>

            <div style="padding-right: 15vw; padding-left: calc(15vw - 30px);">

            <!--  Imagem  -->

            <?php if (isset($convidado)) {?>
                <div id="visualizar_imagem_convidado">
                    <img style="width: 250px; height: 250px;" id="image_convidado" src="img/imagens_servico/<?= $servicoUnico->getImagem() ?>"/>
                </div>
            <?php } ?>

            <?php if (!isset($convidado)) { ?>
                <div id="visualizar_imagem">
                    <img style="width: 250px; height: 250px;" id="image" src="img/imagens_servico/<?= $servicoUnico->getImagem() ?>"/>
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
                </div>
                <div class="filtros-by">
                    <?php if (!isset($convidado)) {?>
                        <span style="color: rgba(255, 255, 255, 0.7);">EMAIL</span>
                        <input type="text" id="input-email" class="form-control form-control-alternative form-edita form-title" placeholder="First name" value="<?= isset($servicoUnico) ? $servicoUnico->getEmail() : "";?>">
                    <?php } else { ?>
                        <span style="color: rgba(255, 255, 255, 0.7);">EMAIL</span>
                        <span> <?= isset($servicoUnico) ? $servicoUnico->getEmail() : '';?></span>
                    <?php } ?>
                </div>   
                <div class="filtros-by">
                    <?php if (!isset($convidado)) {?>
                        <span style="color: rgba(255, 255, 255, 0.7);">CNPJ</span>
                        <input type="text" id="input-cnpj" class="form-control form-control-alternative form-edita form-title" placeholder="First name" value="<?= isset($servicoUnico) ? $servicoUnico->getCnpj() : "";?>">
                    <?php } else { ?>
                        <span style="color: rgba(255, 255, 255, 0.7);">CNPJ</span>
                        <span> <?= isset($servicoUnico) ? $servicoUnico->getCnpj() : '';?></span>
                    <?php } ?>
                </div>   
                <div class="filtros-by">
                    <?php if (!isset($convidado)) {?>
                        <span style="color: rgba(255, 255, 255, 0.7);">TELEFONE</span>
                        <input type="text" id="input-telefone" class="form-control form-control-alternative form-edita form-title" placeholder="First name" value="<?= isset($servicoUnico) ? $servicoUnico->getTelefone() : "";?>">
                    <?php } else { ?>
                        <span style="color: rgba(255, 255, 255, 0.7);">TELEFONE</span>
                        <span> <?= isset($servicoUnico) ? $servicoUnico->getTelefone() : '';?></span>
                    <?php } ?>
                </div>   
            </div>
            
            <br clear="all">
            </div>
            
        </div>
        TESTETESTESTSETSETSETSETST
        </div>  
	
</body>
</html>