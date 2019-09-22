    $(function() {
        idOrganizador = $('#idOrganizador').val();
        nome = "";
        primeiroNome = $('#input-nome').val();
        primeiroEmail = $('#input-email').val();
        $('#input-nome').on('blur', function(){
            nomeNovo = $('#input-nome').val();
            if (nomeNovo != primeiroNome) {
                editarEvento();
            }
        });
        $('#input-email').on('blur', function(){
            emailNovo = $('#input-email').val();
            if (emailNovo != primeiroEmail) {
                editarEvento();
            }
        });
        $('#showEdita').on('click', function(){
            $('#navegacaoEvento > div').removeClass('selected');
            $(this).addClass('selected');
            $('#edicaoEvento').show();
            $('#publicacao').hide();
        });
        $('#showPublicacao').on('click', function(){
            $('#navegacaoEvento > div').removeClass('selected');
            $(this).addClass('selected');
            $('#edicaoEvento').hide();
            $('#publicacao').show();
        });

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
    });

    function editarEvento() {
        nomeNovo = $('#input-nome').val();
        emailNovo = $('#input-email').val();
        console.log(nomeNovo);
        console.log(idOrganizador);
        $.post( "../ajax/editaOrganizador.php", {'nome': nomeNovo, 'email': emailNovo, 'id': idOrganizador, 'imagem': nomeImagem}, function(data){
            primeiroNome = nomeNovo;
            primeiroEmail = emailNovo;
        })
    };