<?php
    include_once '../autoload.php';
    if($_POST){
        $eventoArtistaControle = new ControleEventoArtista();
        $eventoArtistaControle->setVisao($_POST);
        $eventoArtistaUnico = $eventoArtistaControle->controleAcao('listarUnico', $_POST['id']);
        $retorno = $eventoArtistaControle->controleAcao("excluir");
        if($retorno) {
            $arrayRetorno = ['id' => $eventoArtistaUnico->getId(),'idEvento' => $eventoArtistaUnico->getIdEvento(), 'idServico' => $eventoArtistaUnico->getIdServico()];
            echo json_encode($arrayRetorno);
        }
    }
?>