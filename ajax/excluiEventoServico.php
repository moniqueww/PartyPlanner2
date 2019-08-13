<?php
    include_once '../autoload.php';
    if($_POST){
        //Cria o Controle desta View (página)
        $eventoServicoControle = new ControleEventoServico();
        //Verifica qual ação (inserir ou alterar) vai passar para o Controle listarPorNome
        $eventoServicoControle->setVisao($_POST);
        $eventoServicoUnico = $eventoServicoControle->controleAcao('listarUnico', $_POST['id']);
        $retorno = $eventoServicoControle->controleAcao("excluir");
        if($retorno) {
            $arrayRetorno = ['id' => $eventoServicoUnico->getId(),'idEvento' => $eventoServicoUnico->getIdEvento(), 'idServico' => $eventoServicoUnico->getIdServico()];
            echo json_encode($arrayRetorno);
        }
    }
?>