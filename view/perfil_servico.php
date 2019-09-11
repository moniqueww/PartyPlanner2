<?php include_once 'include/verificaOrganizador.php';?>
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
<?php
$tituloHead = 'Perfil de serviço';
include_once('include/head.php');
?>
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
    

    <div class="wrapper">

    	<?php
		$paginaHome = '';
        $paginaLista = '';
		include_once('include/sidebar.php');
		?>

    	<div id="page">

            <?php include_once('include/navbar.php'); ?>

			<div class="filtros">Serviço</div>
                        <!-- Page Content -->
                        <div class="content co-10">
                            <input type="hidden" id="idServico" name="idServico" value="<?= isset($servicoUnico) ? $servicoUnico->getId() : "";?>"/>                     
                            <div class="content-header" style="float: left;">
                                <div class="header-photo alternative-shadow">
                                    <img src="img/brand/blog-neon-6.jpg">
                                </div>
                            </div>
                            <div class="row">
                            <div class="col-9">
                                <div style="margin-top: 20px;">    
                                    <p style="font-weight: bold; width: 300px !important; font-size: 20px;" ><?= isset($servicoUnico) ? $servicoUnico->getNome() : "";?></p>
                                </div>
                                <form method='POST' action='processa.php' enctype='multipart/form-data'>
							<div class='estrelas'>
								<input type='radio' id='vazio' name='estrela' value='' checked>
								<input type='hidden' name='id_servico' value="<?= isset($servicoUnico) ? $servicoUnico->getId() : "";?>">
								
								<label for='estrela_um'><i class='fa'></i></label>
								<input type='radio' id='estrela_um' name='estrela' value='1'>
								
								<label for='estrela_dois'><i class='fa'></i></label>
								<input type='radio' id='estrela_dois' name='estrela' value='2'>
								
								<label for='estrela_tres'><i class='fa'></i></label>
								<input type='radio' id='estrela_tres' name='estrela' value='3'>
								
								<label for='estrela_quatro'><i class='fa'></i></label>
								<input type='radio' id='estrela_quatro' name='estrela' value='4'>
								
								<label for='estrela_cinco'><i class='fa'></i></label>
								<input type='radio' id='estrela_cinco' name='estrela' value='5'><br><br>
								
								<input type='submit' value='Cadastrar'>
								
							</div>
						</form>
                            </div>
                            <div class="col-3 pt-3">
                                <p class="font-weight-bold">Informações do serviço:</p>
                                <p style="width: 300px !important;" >CNPJ: <?= isset($servicoUnico) ? $servicoUnico->getCnpj() : "";?></p>                                
                                <p class="font-weight-bold">Contatos:</p>
                                <p  style="width: 300px !important;" ><?= isset($servicoUnico) ? $servicoUnico->getTelefone() : "";?></p>
                                <p  style="width: 300px !important;" ><?= isset($servicoUnico) ? $servicoUnico->getEmail() : "";?></p>
                            </div>
                        </div>
                    </div>
                    <div class="content co-10">
                        div do portifolio
                    </div>
		</div>
    </div>
	
</body>
</html>