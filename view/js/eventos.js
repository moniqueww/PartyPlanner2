$(function() {
    var idUsuario = $('#idUsuario').val();
    if ($('#eventos .content').length) {
        $('#not-found').hide();
        $('#page > .filtros, #page > .filtros-right').show();
    } else {
        $('#not-found').show();
        $('#page > .filtros, #page > .filtros-right').hide();
    }
    $('#cadastrarEvento').on('click', function(){
        $('#cadastrarEvento').attr('disabled', '');
        var nome = $('#nome').val();
        if (nome != "") {
            $('#loader').fadeIn('fast');
            $.post( "../ajax/cadastraEvento.php", {'nome': nome, 'idUsuario': idUsuario}, function(data){
                data = $.parseJSON( data );
                $('#cadastrarEvento').removeAttr('disabled', '');
                $('#cancelarCadastro').click();
                $('#not-found').hide();
                $('#page > .filtros, #page > .filtros-right').show();
                $('#eventos').prepend(
                    $('<div>', {class: 'content photo'}).append(
                        $('<div>', {class: 'card', 'data-id': data.id}).on('mouseover', function(){
                            if ($(this).children('.novoEvento') != null) {
                                $(this).children('.novoEvento').fadeOut();
                            }
                        }).append(
                            $('<img>', {class: 'card-img-top', src: "img/imagens_evento/"+data.imagem}).on('click', function(){
                                var eventoId = $(this).parents('.card').attr('data-id');
                                window.location.assign('form_evento.php?evento='+eventoId);
                            }),
                            $('<div>', {class: 'card-body'}).append(
                                $('<h5>', {class: 'card-title'}).append(
                                    data.nome,
                                    $('<i>', {class: 'fas fa-eye-slash'})
                                ),
                                $('<h5>', {class: 'card-title second-title', html: data.nomeUsuario})
                            ),
                            $('<div>', {class: 'novoEvento', html: 'NOVO'}),
                            $('<div>', {class: 'excluirEvento', 'data-toggle': 'modal', 'data-target': '#modal-notification'}).append(
                                $('<i>', {class: 'fas fa-times'})
                            ).on('click', function(){
                                var eventoId = $(this).parents('.card').attr('data-id');
                                $('#confirmarExclusao').attr('data-id', eventoId);
                            })
                        ).mouseover(function() {
                            $(this).children('.excluirEvento').show();
                        }).mouseout(function(){
                            $(this).children('.excluirEvento').hide();
                        })
                    ).hide().fadeIn("slow")
                );
                $('#loader').fadeOut('fast');
            });
        } else {
            $('#cadastrarEvento').removeAttr('disabled');
        }
    });
    $('#cancelarCadastro').on('click', function(){
        $('#nome').val('');
    });

    $('.content .card > img').on('click', function(){
        var eventoId = $(this).parents('.card').attr('data-id');
        window.location.assign('form_evento.php?evento='+eventoId);
    });
    $('.excluirEvento').on('click', function(){
        var eventoId = $(this).parents('.card').attr('data-id');
        $('#confirmarExclusao').attr('data-id', eventoId);
    });
    $('#confirmarExclusao').on('click', function(){
        $('#loader').fadeIn('fast');
        var eventoId = $(this).attr('data-id');
        $.post( "../ajax/excluiEvento.php", {'id': eventoId}, function(data){
            data = $.parseJSON( data );
            $(".card[data-id="+data.id+"]").parents('.photo').fadeOut().remove();
            if (!$('#eventos .content').length) {
                console.log('n tem nd');
                $('#not-found').show();
                $('#page > .filtros, #page > .filtros-right').hide();
            }
            $("#cancelarExclusao").click();
            $('#loader').fadeOut('fast');
        });
    });
});
/*function listar(){
    console.log(idUsuario);
    $.post( "../ajax/buscaEvento.php", {'idUsuario': idUsuario}, function(data){
        data = $.parseJSON( data );
        console.log(data);
        $('#eventos').show();
        $('#eventos').htm('');
        for (var i = data.length - 1; i >= 0; i--) {
            $('#eventos').append(
                $('<div>', {class: 'content photo'}).append(
                    $('<div>', {class: 'card', 'data-id': data[i].id}).on('mouseover', function(){
                        if ($(this).children('.novoEvento') != null) {
                            $(this).children('.novoEvento').fadeOut();
                        }
                    }).append(
                        $('<img>', {class: 'card-img-top', src: "img/imagens_evento/no-image.png"}).on('click', function(){
                            var eventoId = $(this).parents('.card').attr('data-id');
                            window.location.assign('form_evento.php?evento='+eventoId);
                        }),
                        $('<div>', {class: 'card-body'}).append(
                            $('<h5>', {class: 'card-title', html: data[i].nome}),
                            $('<h5>', {class: 'card-title second-title', html: data[i].organizador})
                        ),
                        $('<div>', {class: 'novoEvento', html: 'NOVO'}),
                        $('<div>', {class: 'excluirEvento', 'data-toggle': 'modal', 'data-target': '#modal-notification'}).append(
                            $('<i>', {class: 'fas fa-times'})
                        ).on('click', function(){
                            var eventoId = $(this).parents('.card').attr('data-id');
                            $('#confirmarExclusao').attr('data-id', eventoId);
                        })
                    ).mouseover(function() {
                        $(this).children('.excluirEvento').show();
                    }).mouseout(function(){
                        $(this).children('.excluirEvento').hide();
                    })
                ).hide().fadeIn("slow")
            );
        }
    })
}*/