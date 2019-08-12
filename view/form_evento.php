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

        $eventoServicoControle = new ControleEventoServico();

        $eventosServicos = [];

        $eventosServicos = $eventoServicoControle->controleAcao("listarTodos", $_GET["evento"]);

        $servicos = $servicoControle->controleAcao("listarTodos");

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
        idCategoria = "";
        idEvento = $('#idEvento').val();
        nome = "";
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
        $('#categoriaPesq').on('change', function(){
            if($(this).val() == 'todos'){
                idCategoria = "";    
            } else {
                idCategoria = $(this).val();
            }
            listar();
        });
        $('#nomePesq').on('input', function(){
            nome = $(this).val();
            listar();
        });
        $('.btn-addListaServico').on('click', function(){
            if($(this).attr('data-categoria') != 'todos'){
                idCategoria = $(this).attr('data-categoria');
                $('#categoriaPesq').val(idCategoria);
            } else {
                idCategoria = "";
                $('#categoriaPesq').val('todos');
            }
            listar();
        });
        $('.categoria').each(function(){
            if($(this).find('.listaEventoServico').length>0){
                console.log($(this).find('.listaEventoServico'));
                $(this).show();
            }
        });
    });
    function listar() {
        $.post( "../controle/buscaServico.php", {'nome': nome, 'evento': idEvento, 'idCategoria': idCategoria}, function(data){
            data = $.parseJSON( data );
            categoriaServico = '';
            $('#tabela_servicos tbody').html('');
            for(i = 0; i < data.length; i++){
                categoriaServico =  data[i].categoria;
                $('#tabela_servicos tbody').append(
                    $('<tr>', {'data-categoria': data[i].categoria, class: 'btn-addServico '+data[i].disabled, 'data-id': data[i].id}).append(
                        $('<td>').append(
                            $('<span>', {style: 'font-weight: bold;'}).append(
                                data[i].nome
                            ),
                            $('<br>'),
                            data[i].email
                        ),
                        $('<td>').append(
                            $('<div>', {class: 'rating'}).append(
                                $('<input>', {type: 'radio', id: data[i].id+'-10', name: data[i].id+'-rating', value: '10'}),
                                $('<label>', {title: 'Rocks', for: data[i].id+'-10', html: '5 stars'}),
                                $('<input>', {type: 'radio', class: 'star9', id: data[i].id+'-9', name: data[i].id+'-rating', value: '10'}),
                                $('<label>', {title: 'Rocks', for: data[i].id+'-9', html: '4 stars'}),
                                $('<input>', {type: 'radio', id: data[i].id+'-8', name: data[i].id+'-rating', value: '10'}),
                                $('<label>', {title: 'Rocks', for: data[i].id+'-8', html: '3 stars'}),
                                $('<input>', {type: 'radio', id: data[i].id+'-7', name: data[i].id+'-rating', value: '10'}),
                                $('<label>', {title: 'Rocks', for: data[i].id+'-7', html: '2 stars'}),
                                $('<input>', {type: 'radio', id: data[i].id+'-6', name: data[i].id+'-rating', value: '10'}),
                                $('<label>', {title: 'Rocks', for: data[i].id+'-6', html: '1 stars'})
                            )
                        )
                    ).on('click', function(){
                        if(!$(this).hasClass('disabled')) {
                            $(this).addClass('disabled');
                            idServico = $(this).attr('data-id');
                            idEvento = $('#idEvento').val();
                            servicoElement = $(this);
                            $.post( "../controle/cadastraEventoServico.php", {'idEvento': idEvento, 'idServico': idServico}, function(data){
                                data = $.parseJSON( data );
                                $('#cancelaListaServicos').click();
                                $('#categoria'+servicoElement.attr('data-categoria')).show();
                                $('#categoria'+servicoElement.attr('data-categoria')+" .categoria-eventos").append(
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
                        }
                    })
                );
                $('.star9').each(function(){
                    $(this).attr('checked', '');
                });
                $('.rating input').attr('disabled', '');
            }
        })
    }
    
    function editarEvento() {
        descricaoNova = $('#input-descricao').val();
        nomeNovo = $('#input-nome').val();
        $.post( "../controle/editaEvento.php", {'nome': nomeNovo, 'descricao': descricaoNova, 'id': idEvento}, function(data){
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
                        <div class="content co-10">
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
                                    <img src="img/brand/foto-festa.png">
                                </div>
                            </div>
                            <div style="margin-top: 20px;">
                                <div class="form-group">
                                    <input type="text" style="width: 300px !important;" id="input-nome" class="form-control form-control-alternative form-edita form-title" placeholder="First name" value="<?= isset($eventoUnico) ? $eventoUnico->getNome() : "";?>">
                                </div>
                            </div>
                            <div>
                                <div class="form-group">
                                    <textarea data-descricao="<?= isset($eventoUnico) ? $eventoUnico->getDescricao() : "";?>" id="input-descricao" style="resize: none; width: 300px !important;" class="form-control form-control-alternative form-edita" rows="3" placeholder="Adicione aqui a descrição do seu evento"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                                <div class="modal-dialog modal- modal-dialog-centered servicos" role="document">
                                <div class="modal-content">                  
                                        <div class="modal-header" style="padding: 1.5rem;">
                                            <select id="categoriaPesq" class="form-control form-control-alternative" style="width: 40%;">
                                                <option value="todos">Todos</option>
                                                <?php
                                                    if(!empty($categorias)) {
                                                        foreach($categorias as $ca) {
                                                            echo "<option value=".$ca->getId().">".$ca->getNome()."</option>";
                                                        }
                                                    }
                                                ?>
                                            </select>
                                            <input id="nomePesq" type="text" class="form-control form-control-alternative" style="height: calc(2.25rem + 2px); width: 50%; position: absolute; right: 64px;"/>
                                            <button id="cancelaListaServicos" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                        <table id="tabela_servicos" style="width: 100%;">
                                            <tbody>
                                            </tbody>
                                        </table>
                                        </div>
                                    </div>
                                </div>
                                </div>

                        <div class="content co-10 co-ult">
                            <button id="semCategoria" type='button' data-categoria='todos' class='btn-addListaServico' data-toggle='modal' data-target='#modal-form'>
                                + Adicionar serviço
                            </button>
                            <br clear="all"/>
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
                                                echo "<div class='content listaEventoServico'>".$servicoUnico->getNome()."<br/><div class='listaInfoEventoServico'>".$servicoUnico->getEmail()."</div><div class='listaInfoEventoServico'>".$servicoUnico->getTelefone()."</div></div>";
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
        <div id="action-bar">
                
            </div>
    </div>
	
</body>
</html>