<?php
    include_once '../autoload.php';
    if($_POST){
        $eventoRepresentanteControle = new ControleEventoRepresentante();
        $eventoRepresentanteControle->setVisao($_POST);
        $eventoRepresentanteUnico = $eventoRepresentanteControle->controleAcao('listarUnico', $_POST['id']);
        $retorno = $eventoRepresentanteControle->controleAcao("excluir");
        if($retorno) {
            $arrayRetorno = ['id' => $eventoRepresentanteUnico->getId(),'idEvento' => $eventoRepresentanteUnico->getIdEvento(), 'idUsuario' => $eventoRepresentanteUnico->getIdUsuario()];
            echo json_encode($arrayRetorno);
        }
    }
?>