    $(function() {
        idCategoria = "";
        idEvento = $('#idEvento').val();
        nome = "";
        nomeArtista = "";
        primeiroNome = $('#input-nome').val();
        primeiraDescricao = $('#input-descricao').attr('data-descricao');
        statusEvento = $('#statusEvento').val();
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
        $('#nomePesqArtista').on('input', function(){
            nomeArtista = $(this).val();
            listarArtistas();
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
        $('.btn-addListaArtista').on('click', function(){
            listarArtistas();
        });
        $('.categoria').each(function(){
            if($(this).find('.content.photo').length>0){
                $(this).show();
            }
        });
        $('.exc-evento-servico').on('click', function(){
            idEventoServico = $(this).attr('data-id');
            $.post( "../ajax/excluiEventoServico.php", {'id': idEventoServico}, function(data){
                data = $.parseJSON( data );
                $(".content.photo[data-id="+data.id+"]").fadeOut();
                $(".btn-addServico[data-id="+data.idServico+"]").removeClass('disabled');
            })
        });
        $('.exc-evento-artista').on('click', function(){
            idEventoServico = $(this).attr('data-id');
            $.post( "../ajax/excluiEventoServico.php", {'id': idEventoServico}, function(data){
                data = $.parseJSON( data );
                $(".content.photo[data-id="+data.id+"]").fadeOut();
                $(".artista.content.photo[data-id="+data.idServico+"]").removeClass('disabled');
            })
        });
        $('#publica-evento').on('click', function(){
            if (statusEvento == 0) {
                statusEvento = 1;
                editarEvento();
                $(this).attr('disabled', '');
            }
        });
        $('#showEdita').on('click', function(){
            $('#navegacaoEvento > div').removeClass('selected');
            $(this).addClass('selected');
            $('#edicaoEvento').show();
            $('#quadroEvento').hide();
        });
        $('#showQuadro').on('click', function(){
            $('#navegacaoEvento > div').removeClass('selected');
            $(this).addClass('selected');
            $('#edicaoEvento').hide();
            $('#quadroEvento').show();
        });
    });
    function listar() {
        $.post( "../ajax/buscaServico.php", {'nome': nome, 'evento': idEvento, 'idCategoria': idCategoria}, function(data){
            data = $.parseJSON( data );
            categoriaServico = '';
            $('#tabela_servicos tbody').html('');
            for(i = 0; i < data.length; i++){
                categoriaServico =  data[i].categoria;
                $('#tabela_servicos tbody').append(
                    /*<div class='card servicos'>
                      <img class='card-img-top servicos' src='img/brand/background4.png' alt='Card image cap'>
                      <div class='card-body'>
                        <h5 class='card-title'>".$servicoUnico->getNome()."</h5>
                        <h5 class='card-title' style='font-weight: 500; color: rgba(50, 50, 93, 0.65);'>".$servicoUnico->getEmail()."</h5>
                      </div>
                      <span class='exc-evento-servico' data-id='".$es->getId()."' aria-hidden='true'>×</span>
                    </div>*/
                    //$('')
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
                            $.post( "../ajax/cadastraEventoServico.php", {'idEvento': idEvento, 'idServico': idServico}, function(data){
                                data = $.parseJSON( data );
                                $('#cancelaListaServicos').click();
                                $('#categoria'+servicoElement.attr('data-categoria')).show();
                                $('#categoria'+servicoElement.attr('data-categoria')+" .categoria-eventos").append(
                                    $('<div>', {'data-id': data.idEventoServico, class: 'content photo'}).append(
                                        $('<div>', {class: 'card servicos'}).append(
                                            $('<img>', {class: 'card-img-top servicos', src: 'img/brand/background4.png'}),
                                            $('<div>', {class: 'card-body'}).append(
                                                $('<h5>', {class: 'card-title', html: data.nome}),
                                                $('<h5>', {class: 'card-title', html: data.email})
                                            ),
                                            $('<span>', {class: 'exc-evento-servico', 'data-id': data.idEventoServico, 'aria-hidden': 'true', html: '×'})
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

    function listarArtistas() {
        $.post( "../ajax/buscaServico.php", {'nome': nomeArtista, 'evento': idEvento, 'idCategoria': 5}, function(data){
            data = $.parseJSON( data );
            categoriaServico = '';
            $('#tabela_artistas').html('');
            for(i = 0; i < data.length; i++){
                categoriaServico =  data[i].categoria;
                $('#tabela_artistas').append(
                    $('<div>', {class: 'artista content photo '+data[i].disabled, 'data-id': data[i].id}).append(
                        $('<div>', {class: 'card servicos'}).append(
                            $('<img>', {style: 'height: calc(84vw / 13.96 / 1.2) !important', class: 'card-img-top servicos', src: 'img/brand/background4.png'}),
                            $('<div>', {class: 'card-body'}).append(
                                $('<h5>', {class: 'card-title', html: data[i].nome}),
                                $('<h5>', {style: 'font-weight: 500; color: rgba(50, 50, 93, 0.65);', class: 'card-title', html: data[i].email})
                            )
                        )
                    ).on('click', function(){
                        if(!$(this).hasClass('disabled')) {
                            $(this).addClass('disabled');
                            idServico = $(this).attr('data-id');
                            idEvento = $('#idEvento').val();
                            servicoElement = $(this);
                            $.post( "../ajax/cadastraEventoServico.php", {'idEvento': idEvento, 'idServico': idServico}, function(data){
                                data = $.parseJSON( data );
                                $('#cancelaListaArtistas').click();
                                $('#atracoes').append(
                                    $('<div>', {style: 'float: none;', 'data-id': data.idEventoServico, class: 'content photo'}).append(
                                        $('<div>', {class: 'card servicos'}).append(
                                            $('<img>', {style: 'background-color: #fff;', class: 'card-img-top servicos', src: 'img/brand/background4.png'}),
                                            $('<div>', {class: 'card-body'}).append(
                                                $('<h5>', {class: 'card-title', html: data.nome}),
                                                $('<h5>', {style: 'font-weight: 500; color: rgba(50, 50, 93, 0.65);', class: 'card-title', html: data.email})
                                            ),
                                            $('<span>', {class: 'exc-evento-artista', 'data-id': data.idEventoServico, 'aria-hidden': 'true', html: '×'})
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
        $.post( "../ajax/editaEvento.php", {'nome': nomeNovo, 'descricao': descricaoNova, 'id': idEvento, 'status': statusEvento}, function(data){
            primeiroNome = nomeNovo;
            primeiraDescricao = descricaoNova;
        })
    }