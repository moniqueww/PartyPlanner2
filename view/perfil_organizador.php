<?php include_once 'include/verificaOrganizador.php';?>
<?php include_once 'include/banco.php';?>
<?php
    include_once '../autoload.php'; 
	if($_GET['organizador']){ // Caso os dados sejam enviados via GET

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
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    
    <script type="text/javascript">
    $(function() {
        idOrganizador = $('#idOrganizador').val();
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
        $.post( "../ajax/editaServico.php", {'nome': nomeNovo, 'email': emailNovo, 'telefone': telefoneNovo, 'cnpj': descricaoNova, 'id': idOrganizador}, function(data){
            alert('Servico modificado');
            primeiroNome = nomeNovo;
            primeiraDescricao = descricaoNova;
            primeiroTelefone = telefoneNovo;
            primeiroEmail = emailNovo;
        })
    }
    </script>

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
            <?php if (isset($convidado)) { ?>
                    <div id="visualizar_imagem_convidado">
                        <img style="width: 250px; height: 250px;" id="image_convidado" src="img/brand/no-image-event.png"/>
                    </div>
            <?php } ?>

            <?php if (!isset($convidado)) { ?>
                    <div id="visualizar_imagem">
                        <img style="width: 250px; height: 250px;" id="image" src="img/brand/no-image-event.png"/>
                    </div>
                    <form id="form-image" enctype="multipart/form-data" action="upload-image.php" method="POST">
                        <input id="input-image" name="imagem" type="file">
                    </form>
            <?php } ?>            
            <!--  -----------  -->

            <div class="filtros">
                <div class="filtros-tipo">EVENTO</div>
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
                <div class="filtros-by">
                    <span style="color: rgba(255, 255, 255, 0.7);">Por</span>
                    <span> <?= isset($organizadorUnico) ? $organizadorUnico->getNome() : '';?></span>
                </div>   
            </div>
            
            <br clear="all">
            </div>
            </div>

    </div>   
	
</body>
</html>