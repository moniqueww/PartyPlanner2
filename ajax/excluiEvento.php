<?php
    include_once '../autoload.php';
    if($_POST){
        $eventoControle = new ControleEvento();
        $eventoControle->setVisao($_POST);
        $eventoUnico = $eventoControle->controleAcao('listarUnico', $_POST['id']);
        $retorno = $eventoControle->controleAcao("excluir");

        $eventoServicoControle = new ControleEventoServico();
        $eventoServicos = $eventoServicoControle->controleAcao('listarTodos', $_POST['id']);
        foreach ($eventoServicos as $es) {
            $_POST['id'] = $es->getId();
            $eventoServicoControle->setVisao($_POST);
            $retorno2 = $eventoServicoControle->controleAcao("excluir");
        }

        if($retorno) {
            $arrayRetorno = ['id' => $eventoUnico->getId()];
            echo json_encode($arrayRetorno);
        }
    }
?>