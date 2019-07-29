<?php //include_once 'include/verifica.php';?>
<?php include_once 'include/banco.php';?>
<?php
    include_once '../autoload.php'; 
	if($_GET['evento']){ // Caso os dados sejam enviados via GET

        //Cria o Controle desta View (página)
        $eventoControle = new ControleEvento();
        //Passa o GET desta View para o Controle
        $eventoControle->setVisao($_GET);
    
        $eventoUnico = $eventoControle->controleAcao("listarUnico", $_GET["evento"]);  //value="<?= isset($categoriaAlteracao) ? $categoriaAlteracao->getId() : "";

    }
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
	
    primeiroNome = $('#input-nome').val();

    primeiraDescricao = $('#input-descricao').val();
    
    $(function() {
        $('#input-nome').on('blur', function(){
            nomeNovo = $(this).val();
            if (nomeNovo != primeiroNome) {
                descricaoNova = $('#input-descricao').val();
                idEvento = $('#idEvento').val();
                $.post( "../controle/editaEvento.php", {'nome': nomeNovo, 'descricao': descricaoNova, 'id': idEvento}, function(data){
                    alert('deu certo');
                    primeiroNome = nomeNovo;
                })
            }
        });
        $('#input-descricao').on('blur', function(){
            descricaoNova = $(this).val();
            if (descricaoNova != primeiraDescricao) {
                nomeNovo = $('#input-nome').val();
                idEvento = $('#idEvento').val();
                $.post( "../controle/editaEvento.php", {'nome': nomeNovo, 'descricao': descricaoNova, 'id': idEvento}, function(data){
                    alert('deu certo');
                    primeiraDescricao = descricaoNova;
                })
            }
        });
    });
	</script>

    <?php include_once('include/navbar.php'); ?>

    <div class="wrapper">

    	<?php include_once('include/sidebar.php'); ?>

    	<div id="page">
			<div class="filtros">Edição do evento</div>
                        <!-- Page Content -->
                        <div class="content co-10 normal-shadow">
                            <input type="hidden" id="idEvento" name="idEvento" value="<?= isset($eventoUnico) ? $eventoUnico->getId() : "";?>"/>
                            <div style="float: right;">
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
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-first-name">Descrição</label>
                                    <textarea class="form-control form-control-alternative" rows="3" placeholder="Write a large text here ..."></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="content-header" style="float: left;">
                                <div class="header-photo alternative-shadow">
                                    <img src="img/blog-neon-6.jpg">
                                </div>
                            </div>
                            <div class="col-lg-12" style="margin-top: 20px;">
                                <div class="form-group">
                                    <input type="text" style="width: auto !important;" id="input-nome" class="form-control form-control-alternative form-edita form-title" placeholder="First name" value="<?= isset($eventoUnico) ? $eventoUnico->getNome() : "";?>">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <textarea id="input-descricao" style="width: 300px !important;" class="form-control form-control-alternative form-edita" rows="3" placeholder="Festa teste para olhar o tamanho das coisas">
                                        <?php 
                                            if (isset($eventoUnico)) { 
                                                echo $eventoUnico->getDescricao();
                                            }
                                        ?>
                                    </textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-first-name"></label>
                                </div>
                            </div>
                        </div>
                        <div class="content co-10 coh-4 co-ult normal-shadow">
                            <!-- We'll fill this with dummy content -->
                        </div>
		</div>
    </div>
	
</body>
</html>