$(function() {
    $('#cadastrarEvento').on('click', function(){
        $('#cadastrarEvento').attr('disabled', '');
        var nome = $('#nome').val();
        if (nome != "") {
            var idUsuario = $('#idUsuario').val();
            $.post( "../ajax/cadastraEvento.php", {'nome': nome, 'idUsuario': idUsuario}, function(data){
                data = $.parseJSON( data );
                $('#cadastrarEvento').removeAttr('disabled', '');
                $('#cancelarCadastro').click();
                $('#eventos').prepend(
                    $('<div>', {class: 'content photo'}).append(
                        $('<div>', {class: 'card', 'data-id': data.id}).on('mouseover', function(){
                            if ($(this).children('.novoEvento') != null) {
                                $(this).children('.novoEvento').fadeOut();
                            }
                        }).on('click', function(){
                            eventoId = $(this).attr('data-id');
                            window.location.assign('form_evento.php?evento='+eventoId);
                        }).append(
                            $('<img>', {class: 'card-img-top', src: "img/brand/background4.png"}),
                            $('<div>', {class: 'card-body'}).append(
                                $('<h5>', {class: 'card-title', html: data.nome}),
                                $('<h5>', {style: 'font-weight: 500; color: rgba(50, 50, 93, 0.65)',class: 'card-title', html: data.nomeUsuario})
                            ),
                            $('<div>', {class: 'novoEvento', html: 'NOVO'})
                        )
                    ).hide().fadeIn("slow")
                );
            });
        } else {
            $('#cadastrarEvento').removeAttr('disabled');
        }
    });
    $('#cancelarCadastro').on('click', function(){
        $('#nome').val('');
    });

    $('.content .card').on('click', function(){
        eventoId = $(this).attr('data-id');
        window.location.assign('form_evento.php?evento='+eventoId);
    });
});