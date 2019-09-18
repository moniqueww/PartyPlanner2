    $(function() {
        idCategoria = "";
        idEvento = $('#idEvento').val();
        nome = "";
        nomeArtista = "";
        nomeEstabelecimento = "";
        
        primeiroNome = $('#input-nome').val();
        primeiraDescricao = $('#input-descricao').attr('data-descricao');
        statusEvento = $('#statusEvento').val();
        idEstabelecimento = $('#idEstabelecimento').val();

        ////////////////////////////////// imagem

        nomeImagem = $('#image').attr('src').split('/').pop();

        $('#input-image').on('change', function() {
            $('#form-image').ajaxForm({
                target:'#visualizar_imagem'
            }).submit();
        });

        $('#visualizar_imagem').on('click', function(){
            $('#input-image').trigger('click');
        });

        $('#visualizar_imagem').hover(function(){
            $('#visualizar_imagem').css({'cursor': 'pointer', 'filter': 'brightness(0.7)'});
        }, function(){
            $('#visualizar_imagem').css({'cursor': 'none', 'filter': 'brightness(1)'});
        });

        $('#input-image').on('change', function(){
            imagemNovo = $('#input-image').val().split('\\').pop();
            if (imagemNovo != nomeImagem) {
                nomeImagem = imagemNovo;
                editarEvento();
            }
        });
        ///////////////////////////////////

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
            listarQuadro();
        });
        $('#nomePesq').on('input', function(){
            nome = $(this).val();
            listarQuadro();
        });
        $('#nomePesqArtista').on('input', function(){
            nomeArtista = $(this).val();
            listarArtistas();
        });
        $('#nomePesqEstabelecimento').on('input', function(){
            nomeEstabelecimento = $(this).val();
            listarEstabelecimentos();
        });
        $('.btn-addListaQuadro').on('click', function(){
            if($(this).attr('data-categoria') != 'todos'){
                idCategoria = $(this).attr('data-categoria');
                $('#categoriaPesq').val(idCategoria);
            } else {
                idCategoria = "";
                $('#categoriaPesq').val('todos');
            }
            listarQuadro();
        });
        $('.btn-addListaArtista').on('click', function(){
            listarArtistas();
        });
        $('.btn-addListaEstabelecimento').on('click', function(){
            listarEstabelecimentos();
        });
        $('.categoria').each(function(){
            if($(this).find('.content.photo').length>0){
                $(this).show();
            }
        });
        $('.exc-evento-servico').on('click', function(){
            var idEventoServico = $(this).attr('data-id');
            $.post( "../ajax/excluiQuadro.php", {'id': idEventoServico}, function(data){
                data = $.parseJSON( data );
                $(".content.photo.quadro[data-id="+data.id+"]").remove();
                $(".btn-addServico[data-id="+data.idServico+"]").removeClass('disabled');
            })
        });
        $('.exc-evento-artista').on('click', function(){
            var idEventoServico = $(this).attr('data-id');
            $.post( "../ajax/excluiEventoArtista.php", {'id': idEventoServico}, function(data){
                data = $.parseJSON( data );
                $(".content.photo.atracao[data-id="+data.id+"]").remove();
                $(".artista.content.photo[data-id="+data.idServico+"]").removeClass('disabled');
            })
        });
        $('#publica-evento').on('click', function(){
            if (statusEvento == 0) {
                statusEvento = 1;
            } else {
                statusEvento = 0;
            }
            editarEvento();
            $(this).children('.btn-inner--icon').children().toggleClass('fa-eye-slash');
            $(this).children('.btn-inner--icon').children().toggleClass('fa-eye');
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
        $('#cadastrarPreco').on('click', function(){
            var valor = $('#precoValor').val();
            var nome = $('#precoNome').val();
            var descricao = $('#precoDescricao').val();
            if (valor != '' && nome != '') {
                $(this).attr('disabled', '');
                $.post( "../ajax/cadastraPreco.php", {'valor': valor, 'nome': nome, 'descricao': descricao, 'idEvento': idEvento}, function(data){
                    data = $.parseJSON( data );
                    $('#cancelarCadastroPreco').click();
                    $('#precoValor').val('');
                    $('#precoNome').val('');
                    $('#precoDescricao').val('');
                    $('#precos').append(
                        $('<div>', {class: 'content co-3 preco', 'data-id': data.id}).append(
                            $('<div>', {class: 'precoValor'}).append(
                                $('<span>', {html: 'R$'}),
                                data.valor
                            ),
                            $('<div>', {class: 'precoNome', html: data.nome}),
                            $('<div>', {class: 'precoDescricao', html: data.descricao})
                        )
                    );
                    $('#cadastrarPreco').removeAttr('disabled');
                })
            } else {
                $(this).removeAttr('disabled');
            }
        });
    });
    function listarQuadro() {
        $.post( "../ajax/buscaServico.php", {'nome': nome, 'evento': idEvento, 'idCategoria': idCategoria}, function(data){
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
                            $.post( "../ajax/cadastraQuadro.php", {'idEvento': idEvento, 'idServico': idServico}, function(data){
                                data = $.parseJSON( data );
                                $('#cancelaListaServicos').click();
                                $('#categoria'+servicoElement.attr('data-categoria')).show();
                                $('#categoria'+servicoElement.attr('data-categoria')+" .categoria-eventos").append(
                                    $('<div>', {'data-id': data.idQuadro, class: 'content photo quadro'}).append(
                                        $('<div>', {class: 'card card-redondo'}).append(
                                            $('<img>', {class: 'card-img-top', src: 'img/brand/no-image-service.png'}),
                                            $('<div>', {class: 'card-body'}).append(
                                                $('<h5>', {class: 'card-title', html: data.nome}),
                                                $('<h5>', {style: 'font-weight: 500; color: rgba(50, 50, 93, 0.65);', class: 'card-title', html: data.email})
                                            ),
                                            $('<span>', {class: 'exc-evento-servico', 'data-id': data.idQuadro, 'aria-hidden': 'true', html: '×'}).on('click', function(){
                                                idEventoServico = $(this).attr('data-id');
                                                $.post( "../ajax/excluiQuadro.php", {'id': idEventoServico}, function(data){
                                                    data = $.parseJSON( data );
                                                    console.log(data);
                                                    $(".content.photo.quadro[data-id="+data.id+"]").remove();
                                                    $(".btn-addServico[data-id="+data.idServico+"]").removeClass('disabled');
                                                })
                                            })
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
        $.post( "../ajax/buscaArtista.php", {'nome': nomeArtista, 'evento': idEvento}, function(data){
            data = $.parseJSON( data );
            categoriaServico = '';
            $('#tabela_artistas').html('');
            for(i = 0; i < data.length; i++){
                categoriaServico =  data[i].categoria;
                $('#tabela_artistas').append(
                    $('<div>', {class: 'artista content photo '+data[i].disabled, 'data-id': data[i].id}).append(
                        $('<div>', {class: 'card card-redondo'}).append(
                            $('<img>', {style: 'height: calc(84vw / 13.96 / 1.2) !important', class: 'card-img-top', src: 'img/brand/no-image-service.png'}),
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
                            $.post( "../ajax/cadastraEventoArtista.php", {'idEvento': idEvento, 'idServico': idServico}, function(data){
                                data = $.parseJSON( data );
                                $('#cancelaListaArtistas').click();
                                $('#atracoes').append(
                                    $('<div>', {style: 'float: none;', 'data-id': data.idEventoArtista, class: 'content atracao photo'}).append(
                                        $('<div>', {class: 'card card-redondo'}).append(
                                            $('<img>', {style: 'background-color: #fff;', class: 'card-img-top', src: 'img/brand/no-image-service.png'}),
                                            $('<div>', {class: 'card-body'}).append(
                                                $('<h5>', {class: 'card-title', html: data.nome}),
                                                $('<h5>', {style: 'font-weight: 500; color: rgba(50, 50, 93, 0.65);', class: 'card-title', html: data.email})
                                            ),
                                            $('<span>', {class: 'exc-evento-artista', 'data-id': data.idEventoArtista, 'aria-hidden': 'true', html: '×'}).on('click', function(){
                                                var idEventoServico = $(this).attr('data-id');
                                                $.post( "../ajax/excluiEventoArtista.php", {'id': idEventoServico}, function(data){
                                                    data = $.parseJSON( data );
                                                    $(".content.photo.atracao[data-id="+data.id+"]").remove();
                                                    $(".artista.content.photo[data-id="+data.idServico+"]").removeClass('disabled');
                                                })
                                            })
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

    function listarEstabelecimentos() {
        $.post( "../ajax/buscaEstabelecimento.php", {'nome': nomeEstabelecimento, 'evento': idEvento}, function(data){
            data = $.parseJSON( data );
            categoriaServico = '';
            $('#tabela_estabelecimento').html('');
            for(i = 0; i < data.length; i++){
                categoriaServico =  data[i].categoria;
                $('#tabela_estabelecimento').append(
                    $('<div>', {class: 'estabelecimento content photo '+data[i].disabled, 'data-id': data[i].id}).append(
                        $('<div>', {class: 'card'}).append(
                            $('<img>', {style: 'height: calc(84vw / 13.96) !important', class: 'card-img-top', src: 'img/brand/no-image-localization.png'}),
                            $('<div>', {class: 'card-body'}).append(
                                $('<h5>', {class: 'card-title', html: data[i].nome}),
                                $('<h5>', {style: 'font-weight: 500; color: rgba(50, 50, 93, 0.65);', class: 'card-title', html: data[i].email})
                            )
                        )
                    ).on('click', function(){
                        if(!$(this).hasClass('disabled')) {
                            $(this).addClass('disabled');
                            idEstabelecimento = $(this).attr('data-id');
                            editarEvento();
                            montaLocalizacao(idEstabelecimento);
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
        $.post( "../ajax/editaEvento.php", {'nome': nomeNovo, 'descricao': descricaoNova, 'id': idEvento, 'status': statusEvento, 'idEstabelecimento': idEstabelecimento, 'imagem': nomeImagem}, function(data){
            primeiroNome = nomeNovo;
            primeiraDescricao = descricaoNova;
        })
    }

    function montaLocalizacao(idEstabelecimento) {
        $.post( "../ajax/montaLocalizacao.php", {'idEstabelecimento': idEstabelecimento}, function(data){
            data = $.parseJSON( data );
            $('#estabelecimento').html('');
            $('#cancelaListaEstabelecimento').click();
            $('#estabelecimento').append(
                $('<div>', {class: 'localizacao-div'}).append(
                    $('<div>').append(
                        $('<img>', {src: 'img/brand/no-image-localization.png', style: 'height: 100%;'})
                    ),
                    $('<div>').append(
                        $('<div>', {class: 'filtros', style: 'color: #fff;', html: data.nome}),
                        $('<p>', {style: 'color: #fff;', html: data.email}),
                        $('<p>', {style: 'color: #fff;', html: data.telefone}),
                    )
                )
            );
        })
    }