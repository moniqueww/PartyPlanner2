<?php include_once 'include/verificaOrganizador.php';?>
<?php include_once 'include/banco.php';?>
<?php
    include_once '../autoload.php'; 
	if($_GET['evento']){ // Caso os dados sejam enviados via GET

        $servicoControle = new ControleServico();

        $servicos = [];

        $servicos = $servicoControle->controleAcao("listarTodos");

        //Cria o Controle desta View (página)
        $eventoServicoControle = new ControleEventoServico();

        $eventosServicos = [];

        $eventosServicos = $eventoServicoControle->controleAcao("listarTodos", $_GET["evento"]);

        $eventoControle = new ControleEvento();
        //Passa o GET desta View para o Controle
        $eventoControle->setVisao($_GET);
    
        $eventoUnico = $eventoControle->controleAcao("listarUnico", $_GET["evento"]);  //value="<?= isset($categoriaAlteracao) ? $categoriaAlteracao->getId() : "";
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

    <script type="text/javascript">
    $(function() {
        primeiroNome = $('#input-nome').val();
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
        $('.btn-addServico').on('click', function(){
            $(this).attr('disabled', '');
            idServico = $(this).attr('data-id');
            idEvento = $('#idEvento').val();
            $.post( "../controle/cadastraEventoServico.php", {'idEvento': idEvento, 'idServico': idServico}, function(data){
                data = $.parseJSON( data );
                $('#cancelaListaServicos').click();
                $('#addServicos').append(
                    $('<div>', {class: 'content listaEventoServico'}).append(
                        data.nome,
                        $('<br/>'),
                        $('<div>', {class: 'listaInfoEventoServico'}).append(
                            data.email
                        ),
                        $('<div>', {class: 'listaInfoEventoServico'}).append(
                            data.telefone
                        )
                    )
                );
            })
        });
    });

    function editarEvento() {
        descricaoNova = $('#input-descricao').val();
        nomeNovo = $('#input-nome').val();
        idEvento = $('#idEvento').val();
        $.post( "../controle/editaEvento.php", {'nome': nomeNovo, 'descricao': descricaoNova, 'id': idEvento}, function(data){
            alert('Evento modificado');
            primeiroNome = nomeNovo;
            primeiraDescricao = descricaoNova;
        })
    }
	</script>

    <?php include_once('include/navbar.php'); ?>

    <div class="wrapper">

    	<?php include_once('include/sidebar.php'); ?>

    	<div id="page">
			<div class="filtros">Edição do evento</div>
                        <!-- Page Content -->
                        <div class="content co-10 normal-shadow">
                            <input type="hidden" id="idEvento" name="idEvento" value="<?= isset($eventoUnico) ? $eventoUnico->getId() : "";?>"/>
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
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-first-name">Descrição</label>
                                    <input type="text" style="width: auto !important;" id="input-first-name" class="form-control form-control-alternative form-edita form-title" placeholder="First name">
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
                                    <input type="text" style="width: 300px !important;" id="input-nome" class="form-control form-control-alternative form-edita form-title" placeholder="First name" value="<?= isset($eventoUnico) ? $eventoUnico->getNome() : "";?>">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <textarea data-descricao="<?= isset($eventoUnico) ? $eventoUnico->getDescricao() : "";?>" id="input-descricao" style="resize: none; width: 300px !important;" class="form-control form-control-alternative form-edita" rows="3" placeholder="Adicione aqui a descrição do seu evento"></textarea>
                                </div>
                            </div>
                        </div>
                        <div id="addServicos" class="content co-10 co-ult normal-shadow">
                            <div class="filtros">Categoria</div>
                            <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                            <div class="modal-dialog modal- modal-dialog-centered servicos" role="document">
                            <div class="modal-content">                  
                                    <div class="modal-header">
                                        <h6 class="modal-title" id="modal-title-default">Adicionar serviço ao evento</h6>
                                        <button id="cancelaListaServicos" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                    <?php if(!empty($servicos)){
                                        foreach ($servicos as $se) {
                                            $servicoDisabled = "";
                                            if(!empty($eventosServicos)){
                                                foreach ($eventosServicos as $es) {
                                                    if ($se->getId() == $es->getIdServico()){
                                                        $servicoDisabled = 'disabled';
                                                    }
                                                }
                                            }
                                            echo "<button ".$servicoDisabled." class='btn btn-addServico' data-id='".$se->getId()."'><table style='width: 100%;'><tr><td>".$se->getNome()."</td><td>".$se->getEmail()."</td></tr></table></button>";
                                        }
                                    }?>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <?php
                                if(!empty($eventosServicos)){
                                    foreach ($eventosServicos as $es) {
                                        $servicoUnico = $servicoControle->controleAcao("listarUnico", $es->getIdServico());
                                        echo "<div class='content listaEventoServico'>".$servicoUnico->getNome()."<br/><div class='listaInfoEventoServico'>".$servicoUnico->getEmail()."</div><div class='listaInfoEventoServico'>".$servicoUnico->getTelefone()."</div></div>";
                                    }
                                }
                            ?>
                            <button type="button" class="btn-addListaServico" data-toggle="modal" data-target="#modal-form">
                                <span style="font-size: 2rem;" class="circle btn-inner--icon"><i class="ni ni-fat-add"></i></span>
                            </button>
                            <br clear="all"/>
                            <div class="filtros">Outra categoria</div>
                            <button type="button" class="btn-addListaServico" data-toggle="modal" data-target="#modal-form">
                                <span style="font-size: 2rem;" class="circle btn-inner--icon"><i class="ni ni-fat-add"></i></span>
                            </button>
                        </div>
		</div>
    </div>
	
</body>
</html>