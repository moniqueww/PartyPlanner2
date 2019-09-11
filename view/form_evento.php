<?php include_once 'include/verificaOrganizador.php';?>
<?php include_once 'include/banco.php';?>
<?php
    include_once '../autoload.php'; 
    if($_GET['evento']){ // Caso os dados sejam enviados via GET
        
        $categoriaControle = new ControleCategoria();
        $categorias = [];
        $categorias = $categoriaControle->controleAcao('listarTodos');

        $servicoControle = new ControleServico();
        $servicos = [];
        $servicos = $servicoControle->controleAcao("listarTodos");

        $eventoServicoControle = new ControleEventoServico();
        $eventosServicos = [];
        $eventosServicos = $eventoServicoControle->controleAcao("listarTodos", $_GET["evento"]);

        $eventoControle = new ControleEvento();
        $eventoControle->setVisao($_GET);
        $eventoUnico = $eventoControle->controleAcao("listarUnico", $_GET["evento"]);  //value="<?= isset($categoriaAlteracao) ? $categoriaAlteracao->getId() : "";

        $organizadorControle = new ControleOrganizador();
        $organizadorUnico = $organizadorControle->controleAcao('listarUnico', $eventoUnico->getIdUsuario());
        
        if (!$eventoUnico->getStatus()) {
            if (!($_SESSION['id'] == $eventoUnico->getIdUsuario())) {
                header("Location: login.php");
                exit;
            }
        } else {
            if (!($_SESSION['id'] == $eventoUnico->getIdUsuario())) {
                $convidado = true;
            }
        }
    }
?>
<!DOCTYPE html>
<html>
<?php
$tituloHead = $eventoUnico->getNome();
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

    <script src="js/form.evento.js"></script>

    <div class="wrapper">

    	<?php
        $paginaHome = '';
        $paginaLista = '';
        include_once('include/sidebar.php');
        ?>

    	<div id="page" class="no-padding">

            <div id="background">

            <?php include_once('include/navbar.php'); ?>

            <div style="padding-right: 15vw;
    padding-left: calc(15vw - 30px);">

            <img src="img/brand/background4.png"/>

			<div class="filtros">
                <div class="filtros-tipo">EVENTO</div>
                <div class="filtros-nome">
                    <?php if (!isset($convidado)) {?>
                    <input type="text" id="input-nome" class="form-control form-control-alternative form-transparente form-edita form-title" placeholder="First name" value="<?= isset($eventoUnico) ? $eventoUnico->getNome() : "";?>">
                    <?php } else {
                         if (isset($eventoUnico)) {
                            echo $eventoUnico->getNome();
                        } else {
                            echo "";
                        }
                    } ?>
                </div>
                <div class="filtros-by">
                    <span style="color: rgba(255, 255, 255, 0.7);">Por</span>
                    <span> <?= isset($organizadorUnico) ? $organizadorUnico->getNome() : '';?></span>
                </div>   
            </div>
            <?php if (!isset($convidado)) {?>
            <div class="filtros-right simple-margin-right">
                <button <?= ($eventoUnico->getStatus() == 1) ? 'disabled' : '' ?> id="publica-evento" type="button" class="btn btn-primary btn-add">
                    <span class="circle btn-inner--icon"><i class="fas fa-copy"></i></span>
                    <span class="btn-inner--text">Publicar</span>
                </button>
            </div>
            <?php } ?>
            <br clear="all">
            </div>
            </div>

            <?php include_once('include/procuraServico.php'); ?>
            <?php include_once('include/procuraArtista.php'); ?>
                        <!-- Page Content -->
                        <input type="hidden" id="idEvento" name="idEvento" value="<?= isset($eventoUnico) ? $eventoUnico->getId() : "";?>"/>
                        <input type="hidden" id="statusEvento" name="statusEvento" value="<?= isset($eventoUnico) ? $eventoUnico->getStatus() : "";?>"/>
                        <div id="navegacaoEvento">
                            <div id="showEdita" class="selected"><?= isset($convidado) ? "Sobre o evento" : "Edição do evento";?></div>
                            <div id="showPublicacao">Publicações</div>
                            <?php if (!isset($convidado)) {?>
                            <div id="showQuadro">Quadro de organização</div>
                            <?php } ?>
                        </div>
                        <div id="edicaoEvento">
                        <div class="content big-content">
                            <div class='filtros filtros-evento'>Sobre o evento</div>
                            <div>
                                <div class="form-group">
                                <?php if (!isset($convidado)) {?>
                                    <textarea data-descricao="<?= isset($eventoUnico) ? $eventoUnico->getDescricao() : "";?>" id="input-descricao" style="resize: none; height: 200px; text-indent: 10%;" class="form-control form-control-alternative form-edita form-transparente" rows="3" placeholder="Adicione aqui a descrição do seu evento"></textarea>
                                <?php } else {?>
                                    <div style="border: none; height: 200px;" class="form-control form-edita"><?= isset($eventoUnico) ? $eventoUnico->getDescricao() : "";?></div>
                                <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div style="background-color: #f7f8fc; border-right: solid 1px #eaedfa; border-top: solid 1px #eaedfa; border-bottom: solid 1px #eaedfa;" class="content big-content">
                            <div class='filtros filtros-evento'>Atrações</div>
                            <?php if (!isset($convidado)) {?>
                            <div class="filtros-right" style="text-align: center;">
                            <button type='button' class='btn-addListaArtista btn btn-primary' data-toggle='modal' data-target='#modal-artista'>
                                <span class='btn-inner--icon'><i class='ni ni-fat-add'></i></span>
                            </button>
                            </div>
                            <?php } ?>
                            <div id="atracoes" style="text-align: center;">
                                <?php
                                    if(!empty($eventosServicos)){
                                        foreach ($eventosServicos as $es) {
                                            $servicoUnico = $servicoControle->controleAcao("listarUnico", $es->getIdServico());
                                            if($servicoUnico->getIdCategoria() == 5){
                                            echo "<div style='float: none;' class='content photo' data-id=".$es->getId().">
                                                            <div class='card servicos'>
                                                              <img style='background-color: #fff;' class='card-img-top servicos' src='img/brand/background4.png' alt='Card image cap'>
                                                              <div class='card-body'>
                                                                <h5 class='card-title'>".$servicoUnico->getNome()."</h5>
                                                                <h5 class='card-title' style='font-weight: 500; color: rgba(50, 50, 93, 0.65);'>".$servicoUnico->getEmail()."</h5>
                                                              </div>";
                                            if (!isset($convidado)) {
                                                echo "<span class='exc-evento-artista' data-id='".$es->getId()."' aria-hidden='true'>×</span>";
                                            }
                                            echo "</div></div>";
                                            //echo "<div data-id='".$es->getId()."' class='content listaEventoServico'>".$servicoUnico->getNome()."<span class='exc-evento-servico' data-id='".$es->getId()."' aria-hidden='true'>×</span><br/><div class='listaInfoEventoServico'>".$servicoUnico->getEmail()."</div><div class='listaInfoEventoServico'>".$servicoUnico->getTelefone()."</div></div>";
                                            }
                                        }
                                    }
                                ?>
                            </div>
                        </div>
                        <div id="localizacao" class="content big-content">
                            <div class="filtros filtros-evento">Localização</div>
                            <div class="localizacao-div">
                                <div>
                                    <img src="https://www.zyrgon.com/wp-content/uploads/2019/06/googlemaps-Zyrgon.jpg" style="height: 100%;">
                                </div>
                                <div>
                                    <div class="filtros" style="color: #fff;">Zyrgon Portugal</div>
                                    <p style="color: #fff;">awkjdhawjkhdkjawjdhkjawhdkjawhdjkawhdkjawhdkjhawkdkawd</p>
                                </div>
                            </div>
                        </div>
                        <div class="content big-content">
                            <div class='filtros filtros-evento'>Preços</div>
                            <div>
								<?php if (!isset($convidado)) {?>
                                <div class="filtros-right" style="text-align: center;">
                                <button type='button' class='btn-addListaArtista btn btn-primary' data-toggle='modal' data-target=''>
                                    <span class='btn-inner--icon'><i class='ni ni-fat-add'></i></span>
                                </button>
                                </div>
								<?php } ?>
                                <div id="precos"></div>
                            </div>
                        </div>
                        <div class="content big-content">
                            <div class='filtros filtros-evento'>Representantes</div>
							<?php if (!isset($convidado)) {?>
							<div class="filtros-right" style="text-align: center;">
                                <button type='button' class='btn-addListaArtista btn btn-primary' data-toggle='modal' data-target=''>
                                    <span class='btn-inner--icon'><i class='ni ni-fat-add'></i></span>
                                </button>
                            </div>
							<?php } ?>
                            <div style="text-align: center;">
                                <?php
									if (isset($organizadorUnico)) {
										echo "<div style='margin-right: 0; float: none; width: 25%;' class='content photo' data-id=".$organizadorUnico->getId().">
                                                            <div class='card servicos'>
                                                              <img style='background-color: #fff;' class='card-img-top servicos' src='img/brand/background4.png' alt='Card image cap'>
                                                              <div class='card-body'>
                                                                <h5 class='card-title'>".$organizadorUnico->getNome()."</h5>
                                                                <h5 class='card-title' style='font-weight: 500; color: rgba(50, 50, 93, 0.65);'>".$organizadorUnico->getEmail()."</h5>
                                                              </div>
															</div>
														</div>";
									}
								?>
                            </div>
                        </div>
                        <div style="background-color: #f7f8fc; border-right: solid 1px #eaedfa; border-top: solid 1px #eaedfa; border-bottom: solid 1px #eaedfa;" class="content big-content">
                            <div class='filtros filtros-evento'>Contate-nos</div>
                            <div>
                                
                            </div>
                        </div>
                    </div>
                    <div id="quadroEvento" style='display: none;'>

                        <div class="content co-10 co-ult">
                            <button id="semCategoria" type='button' data-categoria='todos' class='btn-addListaServico' data-toggle='modal' data-target='#modal-form'>
                                <span class="circle btn-inner--icon"><i class="ni ni-fat-add"></i></span> Adicionar serviço
                            </button>
                            <?php
                                if(!empty($categorias)) {
                                    foreach($categorias as $ca) {
                                        echo "<div style='display: none;' class='categoria' id='categoria".$ca->getId()."'>";
                                        echo "<div class='filtros categorias'>".$ca->getNome()."</div>";
                                        echo "<button type='button' data-categoria='".$ca->getId()."' class='btn-addListaServico' data-toggle='modal' data-target='#modal-form'>
                                            <span style='font-size: 2rem;' class='circle btn-inner--icon'><i class='ni ni-fat-add'></i></span>
                                        </button>";
                                        echo "<div class='categoria-eventos'>";
                                        if(!empty($eventosServicos)){
                                            foreach ($eventosServicos as $es) {
                                                $servicoUnico = $servicoControle->controleAcao("listarUnico", $es->getIdServico());
                                                if($ca->getId() == $servicoUnico->getIdCategoria()){
                                                echo "<div class='content photo' data-id=".$es->getId().">
                                                                <div class='card servicos'>
                                                                  <img class='card-img-top servicos' src='img/brand/background4.png' alt='Card image cap'>
                                                                  <div class='card-body'>
                                                                    <h5 class='card-title'>".$servicoUnico->getNome()."</h5>
                                                                    <h5 class='card-title' style='font-weight: 500; color: rgba(50, 50, 93, 0.65);'>".$servicoUnico->getEmail()."</h5>
                                                                  </div>
                                                                  <span class='exc-evento-servico' data-id='".$es->getId()."' aria-hidden='true'>×</span>
                                                                </div>
                                                            </div>";
                                                //echo "<div data-id='".$es->getId()."' class='content listaEventoServico'>".$servicoUnico->getNome()."<span class='exc-evento-servico' data-id='".$es->getId()."' aria-hidden='true'>×</span><br/><div class='listaInfoEventoServico'>".$servicoUnico->getEmail()."</div><div class='listaInfoEventoServico'>".$servicoUnico->getTelefone()."</div></div>";
                                                }
                                            }
                                        }
                                        echo "</div>";
                                        echo "<br clear='all'/>";
                                        echo "</div>";
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