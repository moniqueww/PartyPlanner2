<?php include_once 'include/verificaServico.php';?>
<?php include_once 'include/verificaServicoUnico.php';?>
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
$tituloHead = 'Edita servico';
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
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    
    <script type="text/javascript">
    $(function() {
        idServico = $('#idServico').val();
        nome = "";
        primeiroNome = $('#input-nome').val();
        primeiroEmail = $('#input-email').val();
        primeiroTelefone = $('#input-telefone').val();
        primeiraDescricao = $('#input-descricao').attr('data-descricao');
        $('#input-descricao').html(primeiraDescricao);
        $('#input-nome').on('blur', function(){
            nomeNovo = $('#input-nome').val();
            if (nomeNovo != primeiroNome) {
                editarEvento();
            }
        });
        $('#input-descricao').on('blur', function(){
            descricaoNova = $('#input-descricao').val();
            if (descricaoNova != primeiraDescricao) {
                editarEvento();
            }
        });
        $('#input-email').on('blur', function(){
            emailNovo = $('#input-email').val();
            if (emailNovo != primeiroEmail) {
                editarEvento();
            }
        });
        $('#input-telefone').on('blur', function(){
            telefoneNovo = $('#input-telefone').val();
            if (telefoneNovo != primeiroTelefone) {
                editarEvento();
            }
        });
    });

    function editarEvento() {
        descricaoNova = $('#input-descricao').val();
        nomeNovo = $('#input-nome').val();
        emailNovo = $('#input-email').val();
        telefoneNovo = $('#input-telefone').val();
        $.post( "../ajax/editaServico.php", {'nome': nomeNovo, 'email': emailNovo, 'telefone': telefoneNovo, 'cnpj': descricaoNova, 'id': idServico}, function(data){
            alert('Servico modificado');
            primeiroNome = nomeNovo;
            primeiraDescricao = descricaoNova;
            primeiroTelefone = telefoneNovo;
            primeiroEmail = emailNovo;
        })
    }
    </script>

    <div class="wrapper">

    	<?php include_once('include/sidebarServico.php'); ?>

    	<div id="page">

            <?php include_once('include/navbar.php'); ?>

			<div class="filtros">Edição do evento</div>
                        <!-- Page Content -->
                        <div class="content co-10">
                            <input type="hidden" id="idServico" name="idServico" value="<?= isset($servicoUnico) ? $servicoUnico->getId() : "";?>"/>
                            <div style="float: right; display: none">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                        </div>
                                        <input class="form-control-alternative datepicker" placeholder="Select date" type="text" value="06/20/2019">
                                    </div>
                                </div>
                                </div>
                                
                            </div>
                      
                            <div class="content-header" style="float: left;">
                                <div class="header-photo alternative-shadow">
                                    <img src="img/brand/blog-neon-6.jpg">
                                </div>
                            </div>
                            <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <input type="text" style="width: 300px !important;" id="input-nome" class="form-control form-control-alternative form-edita form-title" placeholder="First name" value="<?= isset($servicoUnico) ? $servicoUnico->getNome() : "";?>">
                                </div>
                                <div class="font-weight-bold" style="padding-left:10px;">CNPJ:</div>
                                <textarea data-descricao="<?= isset($servicoUnico) ? $servicoUnico->getCnpj() : "";?>" id="input-descricao" style="resize: none; width: 300px !important;" class="form-control form-control-alternative form-edita" placeholder="Adicione aqui a descrição do seu evento"></textarea>
                            </div>
                            <div class="col-6">
                                <p class="font-weight-bold" style="padding-left:10px;">Contatos:</p>
                                <input type='number' style="width: 300px !important;" id="input-telefone" class="form-control form-control-alternative form-edita" value="<?= isset($servicoUnico) ? $servicoUnico->getTelefone() : "";?>">
                                <input type='text' style="width: 300px !important;" id="input-email" class="form-control form-control-alternative form-edita" value="<?= isset($servicoUnico) ? $servicoUnico->getEmail() : "";?>">
                            </div>
                        </div>
                        
		</div>
    </div>
	
</body>
</html>