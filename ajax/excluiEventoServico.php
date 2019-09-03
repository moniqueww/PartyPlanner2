<?php
    include_once '../autoload.php';
    if($_POST){
        $eventoServicoControle = new ControleEventoServico();
        $eventoServicoControle->setVisao($_POST);
        $eventoServicoUnico = $eventoServicoControle->controleAcao('listarUnico', $_POST['id']);
        $retorno = $eventoServicoControle->controleAcao("excluir");
        if($retorno) {
            $arrayRetorno = ['id' => $eventoServicoUnico->getId(),'idEvento' => $eventoServicoUnico->getIdEvento(), 'idServico' => $eventoServicoUnico->getIdServico()];
            echo json_encode($arrayRetorno);
        }
    }
?>