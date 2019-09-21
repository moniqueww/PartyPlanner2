<?php
    include_once '../autoload.php';
    if($_POST){
        $_POST['data'] = date("Y-m-d");
        $publicacaoControle = new ControlePublicacao();
        $publicacaoControle->setVisao($_POST);
        $retorno = $publicacaoControle->controleAcao("inserir");

        if($retorno) {
            $publicacaoUnico = $publicacaoControle->controleAcao('listarUltimo', $_POST['idEvento']);
            $arrayRetorno = ['id' => $publicacaoUnico->getId(),'idEvento' => $_POST['idEvento'], 'titulo' => $publicacaoUnico->getTitulo(), 'descricao' => $publicacaoUnico->getDescricao(), 'imagem' => $publicacaoUnico->getImagem(), 'data' => $publicacaoUnico->getData()];
            echo json_encode($arrayRetorno);
        }
    }
?>