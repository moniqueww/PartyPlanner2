<?php
    include_once '../autoload.php';
    if($_POST){
        $_POST['data'] = date("Y-m-d");
        $publicacaoControle = new ControlePublicacao();
        $publicacaoControle->setVisao($_POST);
        $retorno = $publicacaoControle->controleAcao("inserir");

        if($retorno) {
            $publicacaoUnico = $publicacaoControle->controleAcao('listarUltimo', $_POST['idEvento']);
            $eventoControle = new ControleEvento();
            $eventoUnico = $eventoControle->controleAcao('listarUnico', $_POST['idEvento']);
            $organizadorControle = new ControleOrganizador();
            $organizadorUnico = $organizadorControle->controleAcao('listarUnico', $eventoUnico->getIdUsuario());
            $arrayRetorno = ['id' => $publicacaoUnico->getId(),'idEvento' => $_POST['idEvento'], 'titulo' => $publicacaoUnico->getTitulo(), 'descricao' => $publicacaoUnico->getDescricao(), 'imagem' => $publicacaoUnico->getImagem(), 'data' => $publicacaoUnico->getData(), 'nome' => $organizadorUnico->getNome(), 'imagemOrg' => $organizadorUnico->getImagem()];
            echo json_encode($arrayRetorno);
        }
    }
?>