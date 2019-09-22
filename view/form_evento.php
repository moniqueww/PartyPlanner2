<?php include_once 'include/verifica.php';?>
<?php
    /*$id = isset($eventoUnico) ? $eventoUnico->getId() : "";
    $sql = "SELECT visitar FROM eventos WHERE id='$id'";
    $visualizacao = $conexao->query($sql);
    $visualizacoes = $visualizacao++;
    $sql = "INSERT INTO eventos (visitas) VALUES ('$visualizacoes');";
    $query = $conexao->query($sql);*/
?>
<?php
    include_once '../autoload.php'; 
    if($_GET['evento']){ // Caso os dados sejam enviados via GET
        
        $categoriaControle = new ControleCategoria();
        $categorias = [];
        $categorias = $categoriaControle->controleAcao('listarTodos');

        $servicoControle = new ControleServico();
        $servicos = [];
        $servicos = $servicoControle->controleAcao("listarTodos");

        $quadroControle = new ControleQuadro();
        $quadros = [];
        $quadros = $quadroControle->controleAcao("listarTodos", $_GET["evento"]);

        $eventoArtistaControle = new ControleEventoArtista();
        $eventoArtistas = [];
        $eventoArtistas = $eventoArtistaControle->controleAcao("listarTodos", $_GET["evento"]);

        $eventoRepresentanteControle = new ControleEventoRepresentante();
        $eventoRepresentantes = [];
        $eventoRepresentantes = $eventoRepresentanteControle->controleAcao("listarTodos", $_GET["evento"]);

        $eventoControle = new ControleEvento();
        $eventoControle->setVisao($_GET);
        $eventoUnico = $eventoControle->controleAcao("listarUnico", $_GET["evento"]);

        $eventoPrecoControle = new ControleEventoPreco();
        $eventoPrecos = [];
        $eventoPrecos = $eventoPrecoControle->controleAcao("listarTodos", $_GET["evento"]);

        $publicacaoControle = new ControlePublicacao();
        $publicacoes = [];
        $publicacoes = $publicacaoControle->controleAcao("listarTodos", $_GET["evento"]);

        $organizadorControle = new ControleOrganizador();
        $organizadorUnico = $organizadorControle->controleAcao('listarUnico', $eventoUnico->getIdUsuario());
        
        if (!isset($convidado)) {
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
    <!-- AjaxForm -->
    <script src="http://malsup.github.com/jquery.form.js"></script>
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
        $paginaEvento = $eventoUnico->getId();
        include_once('include/sidebar.php');
        ?>

    	<div id="page" class="no-padding">

            <div id="background">

            <?php include_once('include/navbar.php'); ?>

            <div style="padding-right: 15vw; padding-left: calc(15vw - 30px);">

            <!--  Imagem  -->

            <?php if (isset($convidado)) {?>
                <div id="visualizar_imagem_convidado">
                    <img style="width: 250px; height: 250px;" id="image_convidado" src="img/imagens_evento/<?= $eventoUnico->getImagem() ?>"/>
                </div>
            <?php } ?>

            <?php if (!isset($convidado)) { ?>
                <div id="visualizar_imagem">
                    <img style="width: 250px; height: 250px;" id="image" src="img/imagens_evento/<?= $eventoUnico->getImagem() ?>"/>
                </div>       
                <form id="form-image" enctype="multipart/form-data" action="upload-image-evento.php" method="POST">
                    <input type="text" id="input-image-antiga" name="imagemantiga" value="<?= $eventoUnico->getImagem(); ?>"><input>
                    <input id="input-image" name="imagem" type="file">
                </form>
            <?php } ?>

            <!--   ///////////////////////   -->

			<div class="filtros">
                <div class="filtros-tipo">EVENTO</div>
                <div class="filtros-nome">
                    <?php if (!isset($convidado)) {?>
                    <input type="text" id="input-nome" class="form-control form-control-alternative form-edita form-title" placeholder="First name" value="<?= isset($eventoUnico) ? $eventoUnico->getNome() : "";?>">
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
                <button id="publica-evento" type="button" class="btn btn-primary btn-add">
                    <span class="circle btn-inner--icon"><i class="<?= ($eventoUnico->getStatus() == 1) ? 'fas fa-eye' : 'fas fa-eye-slash' ?>"></i></span>
                </button>
            </div>
            <?php } ?>
            <br clear="all">
            </div>
            </div>

            <?php include_once('include/procuraEstabelecimento.php'); ?>
            <?php include_once('include/procuraServico.php'); ?>
            <?php include_once('include/procuraArtista.php'); ?>
            <?php include_once('include/procuraRepresentante.php'); ?>
            <?php include_once('include/cadastraPreco.php'); ?>
            <?php include_once('include/cadastraPublicacao.php'); ?>
                        <!-- Page Content -->
                        <input type="hidden" id="idEvento" name="idEvento" value="<?= isset($eventoUnico) ? $eventoUnico->getId() : "";?>"/>
                        <input type="hidden" id="statusEvento" name="statusEvento" value="<?= isset($eventoUnico) ? $eventoUnico->getStatus() : "";?>"/>
                        <input type="hidden" id="idEstabelecimento" name="idEstabelecimento" value="<?= isset($eventoUnico) ? $eventoUnico->getIdEstabelecimento() : "";?>"/>
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
                                    <textarea data-descricao="<?= isset($eventoUnico) ? $eventoUnico->getDescricao() : "";?>" id="input-descricao" style="resize: none; height: 250px; text-indent: 5%; text-align: justify;" class="form-control form-control-alternative form-edita" rows="3" placeholder="Adicione a descrição do seu evento"></textarea>
                                <?php } else {?>
                                    <div style="border: none; height: 200px; text-indent: 5%; text-align: justify;" class="form-control form-edita"><?= isset($eventoUnico) ? $eventoUnico->getDescricao() : "";?></div>
                                <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="content big-content">
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
                                    if(!empty($eventoArtistas)){
                                        foreach ($eventoArtistas as $ea) {
                                            $servicoUnico = $servicoControle->controleAcao("listarUnico", $ea->getIdServico());
                                            if($servicoUnico->getIdCategoria() == 5){
                                            echo "<div style='float: none;' class='content atracao photo' data-id=".$ea->getId().">
                                                            <div class='card card-redondo'>
                                                              <img style='background-color: #fff;' class='card-img-top' src='img/brand/no-image-service.png' alt='Card image cap'>
                                                              <div class='card-body'>
                                                                <h5 class='card-title'>".$servicoUnico->getNome()."</h5>
                                                                <h5 class='card-title' style='font-weight: 500; color: rgba(50, 50, 93, 0.65);'>".$servicoUnico->getEmail()."</h5>
                                                              </div>";
                                            if (!isset($convidado)) {
                                                echo "<span class='exc exc-evento-artista' data-id='".$ea->getId()."' aria-hidden='true'>×</span>";
                                            }
                                            echo "</div></div>";
                                            }
                                        }
                                    }
                                ?>
                            </div>
                        </div>
                        <div id="localizacao" class="content big-content">
                            <div class="filtros filtros-evento">Localização</div>
                            <?php if (!isset($convidado)) {?>
                            <div class="filtros-right" style="text-align: center;">
                            <button type='button' class='btn-addListaEstabelecimento btn btn-primary' data-toggle='modal' data-target='#modal-estabelecimento'>
                                <span class='btn-inner--icon'><i class='ni ni-fat-add'></i></span>
                            </button>
                            </div>
                            <?php } ?>
                            <div id="estabelecimento">
                            <?php if ($eventoUnico->getIdEstabelecimento() != 0) {
                                $localizacaoUnica = $servicoControle->controleAcao('listarUnico', $eventoUnico->getIdEstabelecimento()); ?>
                            <div class="localizacao-div">
                                <div>
                                    <img src="img/brand/no-image-localization.png" style="height: 100%;">
                                </div>
                                <div>
                                    <div class="filtros" style="color: #fff;"><?= isset($localizacaoUnica) ? $localizacaoUnica->getNome() : "";?></div>
                                    <p style="color: #fff;"><?= isset($localizacaoUnica) ? $localizacaoUnica->getEmail() : "";?></p>
                                    <p style="color: #fff;"><?= isset($localizacaoUnica) ? $localizacaoUnica->getTelefone() : "";?></p>
                                    <?php if (!isset($convidado)) {
                                        echo "<span class='exc exc-evento-estabelecimento' data-id='".$localizacaoUnica->getId()."' aria-hidden='true'>×</span>";
                                    }?>
                                </div>
                            </div>
                            <?php } ?>
                            </div>
                        </div>
                        <div class="content big-content">
                            <div class='filtros filtros-evento'>Preços</div>
                            <div>
								<?php if (!isset($convidado)) {?>
                                <div class="filtros-right" style="text-align: center;">
                                <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#modal-preco'>
                                    <span class='btn-inner--icon'><i class='ni ni-fat-add'></i></span>
                                </button>
                                </div>
								<?php } ?>
                                <div id="precos">
                                    <?php
                                        if(!empty($eventoPrecos)){
                                            foreach ($eventoPrecos as $ep) {
                                                echo "<div class='content co-3 preco' data-id=".$ep->getId().">
                                                        <div class='card-preco'>
                                                                    <div class='precoValor'><span>R$</span>".$ep->getValor()."</div>
                                                                    <div class='precoNome'>".$ep->getNome()."</div>
                                                                    <div class='precoDescricao'>".$ep->getDescricao()."</div>";
                                                if (!isset($convidado)) {
                                                    echo "<span class='exc exc-evento-preco' data-id='".$ep->getId()."' aria-hidden='true'>×</span>";
                                                }
                                                echo "</div></div>";
                                            }
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="content big-content">
                            <div class='filtros filtros-evento'>Representantes</div>
							<?php if (!isset($convidado)) {?>
							<div class="filtros-right" style="text-align: center;">
                                <button type='button' class='btn-addListaRepresentante btn btn-primary' data-toggle='modal' data-target='#modal-representante'>
                                    <span class='btn-inner--icon'><i class='ni ni-fat-add'></i></span>
                                </button>
                            </div>
							<?php } ?>
                            <div style="text-align: center;" id="representantes">
                                <?php
									if (isset($organizadorUnico)) {
										echo "<div style='margin-right: 0; float: none; width: 23%;' class='content photo' data-id=".$organizadorUnico->getId().">
                                                            <div class='card card-redondo'>
                                                              <img class='card-img-top' src='img/brand/no-image-service.png' alt='Card image cap'>
                                                              <div class='card-body'>
                                                                <h5 class='card-title'>".$organizadorUnico->getNome()."</h5>
                                                                <h5 class='card-title' style='font-weight: 500; color: rgba(50, 50, 93, 0.65);'>".$organizadorUnico->getEmail()."</h5>
                                                              </div>
															</div>
														</div>";
                                    }
                                    if(!empty($eventoRepresentantes)){
                                        foreach ($eventoRepresentantes as $er) {
                                            $representanteUnico = $organizadorControle->controleAcao("listarUnico", $er->getIdUsuario());
                                            echo "<div style='float: none; width: 23%;' class='content representante photo' data-id=".$er->getId().">
                                                            <div class='card card-redondo'>
                                                              <img class='card-img-top' src='img/brand/no-image-service.png' alt='Card image cap'>
                                                              <div class='card-body'>
                                                                <h5 class='card-title'>".$representanteUnico->getNome()."</h5>
                                                                <h5 class='card-title' style='font-weight: 500; color: rgba(50, 50, 93, 0.65);'>".$representanteUnico->getEmail()."</h5>
                                                              </div>";
                                            if (!isset($convidado)) {
                                                echo "<span class='exc exc-evento-representante' data-id='".$er->getId()."' aria-hidden='true'>×</span>";
                                            }
                                            echo "</div></div>";
                                        }
                                    }
								?>
                            </div>
                        </div>
                        <div class="content big-content">
                            <div class='filtros filtros-evento'>Contate-nos</div>
                            <div>
                                
                            </div>
                        </div>
                    </div>

                    <!--//////////////////////////////////////-->

                    <div id="publicacao" style='display: none;'>
                        <div class="content big-content">
                            <div class='filtros'>Publicações</div>
                            <?php if (!isset($convidado)) {?>
                            <div class="filtros-right">
                            <button type='button' class='btn-addPublicacao btn btn-primary' data-toggle='modal' data-target='#modal-publicacao'>
                                <span class='btn-inner--icon'><i class='ni ni-fat-add'></i></span>
                            </button>
                            </div>
                            <?php } ?>
                            <div id="publicacoes">
                                <!--<div class="publicacao-evento">
                                    <div class="publicacao-usuario">
                                        <img src="img/fotosPerfil/noimage5.png">
                                        <span><?php //echo $organizadorUnico->getNome(); ?></span>
                                    </div>
                                    <div class="publicacao-titulo">Título</div>
                                    <div class="publicacao-foto"><img src="img/brand/background-blur.jpg"/></div>
                                    <div class="publicacao-descricao">Descrição</div>
                                </div>-->
                                <?php
                                    if(!empty($publicacoes)){
                                        foreach (array_reverse($publicacoes) as $pu) {
                                            echo "<div class='publicacao-evento' data-id='".$pu->getId()."'>
                                                    <div class='publicacao-usuario'>
                                                        <img src='img/fotosPerfil/noimage5.png'>
                                                        <span>".$organizadorUnico->getNome()."</span>
                                                    </div>
                                                    <div class='publicacao-titulo'>".$pu->getTitulo()."</div>";
                                            if ($pu->getImagem() != "") {
                                                echo "<div class='publicacao-foto'><img src='img/brand/background-blur.jpg'/></div>";
                                            }
                                                    echo "<div class='publicacao-descricao'>".$pu->getDescricao()."</div>
                                                </div>";
                                        }
                                    }
                                ?>
                            </div>
                        </div>
                    </div>

                    <!--//////////////////////////////////////-->

                    <div id="quadroEvento" style='display: none;'>
                        <div class="content big-content">
                            <div>
                            <button id="semCategoria" type='button' data-categoria='todos' class='btn-addListaQuadro' data-toggle='modal' data-target='#modal-form'>
                                <span class="circle btn-inner--icon"><i class="ni ni-fat-add"></i></span> Adicionar serviço
                            </button>
                            <?php
                                if(!empty($categorias)) {
                                    foreach($categorias as $ca) {
                                        echo "<div style='display: none;' class='categoria' id='categoria".$ca->getId()."'>";
                                        echo "<div class='filtros categorias'>".$ca->getNome()."</div>";
                                        echo "<div class='filtros-right'>
                                                <button type='button' data-categoria='".$ca->getId()."' class='btn-addListaQuadro btn btn-primary' data-toggle='modal' data-target='#modal-form'>
                                                    <span class='btn-inner--icon'><i class='ni ni-fat-add'></i></span>
                                                </button>
                                                </div>";
                                        echo "<div class='categoria-eventos'>";
                                        if(!empty($quadros)){
                                            foreach ($quadros as $qu) {
                                                $servicoUnico = $servicoControle->controleAcao("listarUnico", $qu->getIdServico());
                                                if($ca->getId() == $servicoUnico->getIdCategoria()){
                                                echo "<div class='content photo quadro' data-id=".$qu->getId().">
                                                                <div class='card card-redondo'>
                                                                  <img class='card-img-top' src='img/brand/no-image-service.png' alt='Card image cap'>
                                                                  <div class='card-body'>
                                                                    <h5 class='card-title'>".$servicoUnico->getNome()."</h5>
                                                                    <h5 class='card-title' style='font-weight: 500; color: rgba(50, 50, 93, 0.65);'>".$servicoUnico->getEmail()."</h5>
                                                                  </div>
                                                                  <span class='exc exc-evento-servico' data-id='".$qu->getId()."' aria-hidden='true'>×</span>
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
        </div>
        <div id="action-bar">
                
            </div>
    </div>
    <?php include_once('include/loader.php'); ?>
	
</body>
</html>