<?php //include_once 'include/verificaOrganizador.php';?>
<?php include_once 'include/banco.php';?>
<?php
    include_once '../autoload.php'; 
	if($_GET['servico']){ // Caso os dados sejam enviados via GET

        $servicoControle = new ControleServico();
        //Passa o GET desta View para o Controle
        $servicoControle->setVisao($_GET);
    
        $servicoUnico = $servicoControle->controleAcao("listarUnico", $_GET["servico"]);  //value="<?= isset($categoriaAlteracao) ? $categoriaAlteracao->getId() : "";
    }
?>
<!DOCTYPE html>
<html>
<?php include_once('include/head.php'); ?>
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
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    

    <?php include_once('include/navbar.php'); ?>

    <div class="wrapper">

    	<?php include_once('include/sidebar.php'); ?>

    	<div id="page">
			<div class="filtros">Edição do evento</div>
                        <!-- Page Content -->
                        <div class="content co-10">
                            <input type="hidden" id="idServico" name="idServico" value="<?= isset($servicoUnico) ? $servicoUnico->getId() : "";?>"/>                     
                            <div class="content-header" style="float: left;">
                                <div class="header-photo alternative-shadow">
                                    <img src="img/brand/blog-neon-6.jpg">
                                </div>
                            </div>
                            <div class="col-lg-12" style="margin-top: 20px;">
                                <div class="form-group">
                                    <p style="width: 300px !important;" ><?= isset($servicoUnico) ? $servicoUnico->getNome() : "";?></p>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <p  style="resize: none; width: 300px !important;" ><?= isset($servicoUnico) ? $servicoUnico->getCnpj() : "";?></p>
                                </div>
                            </div>
                            <div class="row">
                            <div class="rating">
                                <input type="radio" id="star5" name="rating" value="5" /><label for="star5" title="Meh">5 stars</label>
                                <input type="radio" id="star4" name="rating" value="4" /><label for="star4" title="Kinda bad">4 stars</label>
                                <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="Kinda bad">3 stars</label>
                                <input type="radio" id="star2" name="rating" value="2" /><label for="star2" title="Sucks big tim">2 stars</label>
                                <input type="radio" id="star1" name="rating" value="1" /><label for="star1" title="Sucks big time">1 star</label>
                            </div>
	                    </div>
                        </div>
		</div>
    </div>
	
</body>
</html>