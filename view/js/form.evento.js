    $(function() {
        idCategoria = "";
        idEvento = $('#idEvento').val();
        nome = "";
        nomeArtista = "";
        nomeEstabelecimento = "";
        nomeRepresentante = "";
        idUsuario = $('#idUsuario').val();
        
        primeiroNome = $('#input-nome').val();
        primeiraDescricao = $('#input-descricao').attr('data-descricao');
        statusEvento = $('#statusEvento').val();
        idEstabelecimento = $('#idEstabelecimento').val();

        ////////////////////////////////// imagem

        if ($('#convidado').val() == 0) {
            nomeImagem = $('#image').attr('src').split('/').pop();
        }

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
        $('#nomePesqRepresentante').on('input', function(){
            nomeRepresentante = $(this).val();
            listarRepresentantes();
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
        $('.btn-addListaRepresentante').on('click', function(){
            listarRepresentantes();
        });
        $('.categoria').each(function(){
            if($(this).find('.content.photo').length>0){
                $(this).show();
            }
        });
        $('.exc-evento-servico').on('click', function(){
            $('#loader').fadeIn('fast');
            var idEventoServico = $(this).attr('data-id');
            $.post( "../ajax/excluiQuadro.php", {'id': idEventoServico}, function(data){
                data = $.parseJSON( data );
                $(".content.photo.quadro[data-id="+data.id+"]").remove();
                $(".btn-addServico[data-id="+data.idServico+"]").removeClass('disabled');
                $('#loader').fadeOut('fast');
            })
        });
        $('.exc-evento-artista').on('click', function(){
            $('#loader').fadeIn('fast');
            var idEventoServico = $(this).attr('data-id');
            $.post( "../ajax/excluiEventoArtista.php", {'id': idEventoServico}, function(data){
                data = $.parseJSON( data );
                $(".content.photo.atracao[data-id="+data.id+"]").remove();
                $(".artista.content.photo[data-id="+data.idServico+"]").removeClass('disabled');
                $('#loader').fadeOut('fast');
            })
        });
        $('.exc-evento-preco').on('click', function(){
            $('#loader').fadeIn('fast');
            var idEventoPreco = $(this).attr('data-id');
            $.post( "../ajax/excluiEventoPreco.php", {'id': idEventoPreco}, function(data){
                data = $.parseJSON( data );
                $(".content.preco[data-id="+data.id+"]").remove();
                $('#loader').fadeOut('fast');
            })
        })
        $('.exc-evento-representante').on('click', function(){
            $('#loader').fadeIn('fast');
            var idEventoRepresentante = $(this).attr('data-id');
            $.post( "../ajax/excluiEventoRepresentante.php", {'id': idEventoRepresentante}, function(data){
                data = $.parseJSON( data );
                $(".content.photo.representante[data-id="+data.id+"]").remove();
                $(".organizador.content.photo[data-id="+data.idUsuario+"]").removeClass('disabled');
                $('#loader').fadeOut('fast');
            })
        });
        $('.exc-evento-estabelecimento').on('click', function(){
            idEstabelecimento = 0;
            var idEstabelecimentoExcluido = $(this).attr('data-id');
            editarEvento();
            $('#estabelecimento').html('');
            $('.content.photo.estabelecimento[data-id='+idEstabelecimentoExcluido+']').removeClass('disabled');
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
            $('#publicacao').hide();
            $('#quadroEvento').hide();
        });
        $('#showQuadro').on('click', function(){
            $('#navegacaoEvento > div').removeClass('selected');
            $(this).addClass('selected');
            $('#edicaoEvento').hide();
            $('#publicacao').hide();
            $('#quadroEvento').show();
        });
        $('#showPublicacao').on('click', function(){
            $('#navegacaoEvento > div').removeClass('selected');
            $(this).addClass('selected');
            $('#edicaoEvento').hide();
            $('#publicacao').show();
            $('#quadroEvento').hide();
        });
        $('#favoritarEvento').on('click', function(){
            $('#loader').fadeIn('fast');
            $.post( "../ajax/favoritaEvento.php", {'idEvento': idEvento, 'idUsuario': idUsuario}, function(data){
                $('#favoritarEvento').attr('disabled', 'disabled');
                $('#favoritarEvento i').addClass('fas');
                $('#favoritarEvento i').removeClass('far');
                $('#loader').fadeOut('fast');
            });
        });
        $('#cadastrarPreco').on('click', function(){
            var valor = $('#precoValor').val();
            var nome = $('#precoNome').val();
            var descricao = $('#precoDescricao').val();
            if (valor != '' && nome != '') {
                $('#loader').fadeIn('fast');
                $(this).attr('disabled', '');
                $.post( "../ajax/cadastraPreco.php", {'valor': valor, 'nome': nome, 'descricao': descricao, 'idEvento': idEvento}, function(data){
                    data = $.parseJSON( data );
                    $('#cancelarCadastroPreco').click();
                    $('#precoValor').val('');
                    $('#precoNome').val('');
                    $('#precoDescricao').val('');
                    $('#precos').append(
                        $('<div>', {class: 'content co-3 preco', 'data-id': data.id}).append(
                            $('<div>', {class: 'card-preco'}).append(
                                $('<div>', {class: 'precoValor'}).append(
                                    $('<span>', {html: 'R$'}),
                                    data.valor
                                ),
                                $('<div>', {class: 'precoNome', html: data.nome}),
                                $('<div>', {class: 'precoDescricao', html: data.descricao}),
                                $('<span>', {class: 'exc exc-evento-preco', 'data-id': data.id, 'aria-hidden': 'true', html: '×'}).on('click', function(){
                                    $('#loader').fadeIn('fast');
                                    var idEventoPreco = $(this).attr('data-id');
                                    $.post( "../ajax/excluiEventoPreco.php", {'id': idEventoPreco}, function(data){
                                        data = $.parseJSON( data );
                                        $(".content.preco[data-id="+data.id+"]").remove();
                                        $('#loader').fadeOut('fast');
                                    })
                                })
                            )
                        )
                    );
                    $('#cadastrarPreco').removeAttr('disabled');
                    $('#loader').fadeOut('fast');
                })
            } else {
                $(this).removeAttr('disabled');
            }
        });
        $('#cadastrarPublicacao').on('click', function(){
            var titulo = $('#publicacaoTitulo').val();
            var descricao = $('#publicacaoDescricao').val();
            if (titulo != '' && descricao != '') {
                $('#loader').fadeIn('fast');
                $(this).attr('disabled', '');
                $.post( "../ajax/cadastraPublicacao.php", {'titulo': titulo, 'descricao': descricao, 'idEvento': idEvento}, function(data){
                    data = $.parseJSON( data );
                    $('#cancelarCadastroPublicacao').click();
                    $('#publicacoes').prepend(
                        $('<div>', {class: 'publicacao-evento', 'data-id': data.id}).append(
                            $('<div>', {class: 'publicacao-usuario'}).append(
                                $('<img>', {src: 'img/imagens_organizador/'+data.imagemOrg}),
                                $('<span>', {html: data.nome})
                            ),
                            $('<div>', {class: 'publicacao-titulo', html: data.titulo}),
                            $('<div>', {class: 'publicacao-descricao', html: data.descricao})
                        )
                    );
                    $('#cadastrarPublicacao').removeAttr('disabled');
                    $('#loader').fadeOut('fast');
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
                            $('<img>', {style: 'height: 70px; width: 70px; border-radius: 50%;', src: 'img/imagens_servico/'+data[i].imagem})
                        ),
                        $('<td>').append(
                            $('<span>', {style: 'font-weight: bold;'}).append(
                                data[i].nome
                            ),
                            $('<br>'),
                            data[i].email
                        )
                    ).on('click', function(){
                        if(!$(this).hasClass('disabled')) {
                            $('#loader').fadeIn('fast');
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
                                            $('<a>', {src: '#'}).append(
                                                $('<img>', {class: 'card-img-top', src: 'img/imagens_servico/'+data.imagem}).on('click', function(){
                                                    window.location.assign('perfil_servico.php?servico='+data.idServico);
                                                })
                                            ),
                                            $('<div>', {class: 'card-body'}).append(
                                                $('<h5>', {class: 'card-title', html: data.nome}),
                                                $('<h5>', {class: 'card-title second-title', html: data.email})
                                            ),
                                            $('<span>', {class: 'exc exc-evento-servico', 'data-id': data.idQuadro, 'aria-hidden': 'true', html: '×'}).on('click', function(){
                                                $('#loader').fadeIn('fast');
                                                idEventoServico = $(this).attr('data-id');
                                                $.post( "../ajax/excluiQuadro.php", {'id': idEventoServico}, function(data){
                                                    data = $.parseJSON( data );
                                                    $(".content.photo.quadro[data-id="+data.id+"]").remove();
                                                    $(".btn-addServico[data-id="+data.idServico+"]").removeClass('disabled');
                                                    $('#loader').fadeOut('fast');
                                                })
                                            })
                                        )
                                    )
                                );
                                $('#loader').fadeOut('fast');
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
                            $('<img>', {style: 'height: calc(84vw / 13.96 / 1.2) !important', class: 'card-img-top', src: 'img/imagens_servico/'+data[i].imagem}),
                            $('<div>', {class: 'card-body'}).append(
                                $('<h5>', {class: 'card-title', html: data[i].nome}),
                                $('<h5>', {class: 'card-title second-title', html: data[i].email})
                            )
                        )
                    ).on('click', function(){
                        if(!$(this).hasClass('disabled')) {
                            $('#loader').fadeIn('fast');
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
                                            $('<a>', {src: '#'}).append(
                                                $('<img>', {style: 'background-color: #fff;', class: 'card-img-top', src: 'img/imagens_servico/'+data.imagem}).on('click', function(){
                                                    window.location.assign('perfil_servico.php?servico='+data.idServico);
                                                })
                                            ),
                                            $('<div>', {class: 'card-body'}).append(
                                                $('<h5>', {class: 'card-title', html: data.nome}),
                                                $('<h5>', {class: 'card-title second-title', html: data.email})
                                            ),
                                            $('<span>', {class: 'exc exc-evento-artista', 'data-id': data.idEventoArtista, 'aria-hidden': 'true', html: '×'}).on('click', function(){
                                                $('#loader').fadeIn('fast');
                                                var idEventoServico = $(this).attr('data-id');
                                                $.post( "../ajax/excluiEventoArtista.php", {'id': idEventoServico}, function(data){
                                                    data = $.parseJSON( data );
                                                    $(".content.photo.atracao[data-id="+data.id+"]").remove();
                                                    $(".artista.content.photo[data-id="+data.idServico+"]").removeClass('disabled');
                                                    $('#loader').fadeOut('fast');
                                                })
                                            })
                                        )
                                    )
                                );
                                $('#loader').fadeOut('fast');
                            })
                        }
                    })
                );
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
                            $('<img>', {style: 'height: calc(84vw / 13.96) !important', class: 'card-img-top', src: 'img/imagens_servico/'+data[i].imagem}),
                            $('<div>', {class: 'card-body'}).append(
                                $('<h5>', {class: 'card-title', html: data[i].nome}),
                                $('<h5>', {class: 'card-title second-title', html: data[i].email})
                            )
                        )
                    ).on('click', function(){
                        if(!$(this).hasClass('disabled')) {
                            $('#loader').fadeIn('fast');
                            $(this).addClass('disabled');
                            idEstabelecimento = $(this).attr('data-id');
                            editarEvento();
                            montaLocalizacao(idEstabelecimento);
                        }
                    })
                );
            }
        })
    }

    function listarRepresentantes() {
        $.post( "../ajax/buscaRepresentante.php", {'nome': nomeRepresentante, 'evento': idEvento}, function(data){
            data = $.parseJSON( data );
            console.log(data);
            $('#tabela_representante').html('');
            for(i = 0; i < data.length; i++){
                $('#tabela_representante').append(
                    $('<div>', {class: 'organizador content photo '+data[i].disabled, 'data-id': data[i].id}).append(
                        $('<div>', {class: 'card card-redondo'}).append(
                            $('<img>', {style: 'height: calc(84vw / 13.96 / 1.2) !important', class: 'card-img-top', src: 'img/imagens_organizador/'+data[i].imagem}),
                            $('<div>', {class: 'card-body'}).append(
                                $('<h5>', {class: 'card-title', html: data[i].nome}),
                                $('<h5>', {class: 'card-title second-title', html: data[i].email})
                            )
                        )
                    ).on('click', function(){
                        if(!$(this).hasClass('disabled')) {
                            $('#loader').fadeIn('fast');
                            $(this).addClass('disabled');
                            idOrganizador = $(this).attr('data-id');
                            idEvento = $('#idEvento').val();
                            $.post( "../ajax/cadastraEventoRepresentante.php", {'idEvento': idEvento, 'idUsuario': idOrganizador}, function(data){
                                data = $.parseJSON( data );
                                $('#cancelaListaRepresentantes').click();
                                $('#representantes').append(
                                    $('<div>', {style: 'float: none; width: 23%;', 'data-id': data.idEventoRepresentante, class: 'content representante photo'}).append(
                                        $('<div>', {class: 'card card-redondo'}).append(
                                            $('<a>', {src: '#'}).append(
                                                $('<img>', {style: 'background-color: #fff;', class: 'card-img-top', src: 'img/imagens_organizador/'+data.imagem}).on('click', function(){
                                                    window.location.assign('perfil_organizador.php?organizador='+data.idUsuario);
                                                })
                                            ),
                                            $('<div>', {class: 'card-body'}).append(
                                                $('<h5>', {class: 'card-title', html: data.nome}),
                                                $('<h5>', {class: 'card-title second-title', html: data.email})
                                            ),
                                            $('<span>', {class: 'exc exc-evento-representante', 'data-id': data.idEventoRepresentante, 'aria-hidden': 'true', html: '×'}).on('click', function(){
                                                $('#loader').fadeIn('fast');
                                                var idEventoRepresentante = $(this).attr('data-id');
                                                $.post( "../ajax/excluiEventoRepresentante.php", {'id': idEventoRepresentante}, function(data){
                                                    data = $.parseJSON( data );
                                                    $(".content.photo.representante[data-id="+data.id+"]").remove();
                                                    $(".organizador.content.photo[data-id="+data.idUsuario+"]").removeClass('disabled');
                                                    $('#loader').fadeOut('fast');
                                                })
                                            })
                                        )
                                    )
                                );
                                $('#loader').fadeOut('fast');
                            })
                        }
                    })
                );
            }
        })
    }
    
    function editarEvento() {
        $('#loader').fadeIn('fast');
        descricaoNova = $('#input-descricao').val();
        nomeNovo = $('#input-nome').val();
        $.post( "../ajax/editaEvento.php", {'nome': nomeNovo, 'descricao': descricaoNova, 'id': idEvento, 'status': statusEvento, 'idEstabelecimento': idEstabelecimento, 'imagem': nomeImagem}, function(data){
            primeiroNome = nomeNovo;
            primeiraDescricao = descricaoNova;
            $('#loader').fadeOut('fast');
        })
    }

    function montaLocalizacao(id) {
        $.post( "../ajax/montaLocalizacao.php", {'idEstabelecimento': id}, function(data){
            data = $.parseJSON( data );
            $('#estabelecimento').html('');
            $('#cancelaListaEstabelecimento').click();
            $('#estabelecimento').append(
                $('<div>', {class: 'localizacao-div'}).append(
                    $('<div>').append(
                        $('<img>', {src: 'img/imagens_servico/'+data.imagem, style: 'height: 100%;'}).on('click', function(){
                            window.location.assign('perfil_servico.php?servico='+data.id);
                        }),
                    ),
                    $('<div>').append(
                        $('<div>', {class: 'filtros', style: 'color: #fff;', html: data.nome}),
                        $('<p>', {style: 'color: #fff;', html: data.email}),
                        $('<p>', {style: 'color: #fff;', html: data.telefone}),
                    ),
                    $('<span>', {class: 'exc exc-evento-estabelecimento', 'data-id': data.id, 'aria-hidden': 'true', html: '×'}).on('click', function(){
                        $('#loader').fadeIn('fast');
                        idEstabelecimento = 0;
                        var idEstabelecimentoExcluido = $(this).attr('data-id');
                        editarEvento();
                        $('#estabelecimento').html('');
                        $('.content.photo.estabelecimento[data-id='+idEstabelecimentoExcluido+']').removeClass('disabled');
                        $('#loader').fadeOut('fast');
                    })
                )
            );
            $('#loader').fadeOut('fast');
        })
    }