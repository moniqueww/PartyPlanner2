$(function() {
    idServico = $('#idServico').val();
    nome = "";
    primeiroNome = $('#input-nome').val();
    primeiroEmail = $('#input-email').val();
    primeiroTelefone = $('#input-telefone').val();
    primeiroCnpj = $('#input-cnpj').val();
    $('#input-nome').on('blur', function(){
        nomeNovo = $('#input-nome').val();
        if (nomeNovo != primeiroNome) {
            editarEvento();
        }
    });
    $('#input-cnpj').on('blur', function(){
        cnpjNovo = $('#input-cnpj').val();
        if (cnpjNovo != primeiroCnpj) {
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
});

function editarEvento() {
    nomeNovo = $('#input-nome').val();
    emailNovo = $('#input-email').val();
    telefoneNovo = $('#input-telefone').val();
    cnpjNovo = $('#input-cnpj').val();
    console.log(nomeNovo);
    console.log(emailNovo);
    console.log(telefoneNovo);
    console.log(cnpjNovo);
    $.post( "../ajax/editaServico.php", {'nome': nomeNovo, 'email': emailNovo, 'telefone': telefoneNovo, 'cnpj': cnpjNovo, 'id': idServico, 'imagem': nomeImagem}, function(data){
        primeiroNome = nomeNovo;
        primeiroCnpj = cnpjNovo;
        primeiroTelefone = telefoneNovo;
        primeiroEmail = emailNovo;
    });
}