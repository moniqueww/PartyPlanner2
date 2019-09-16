<?php
    include_once '../autoload.php';
    if($_POST){
        $quadroControle = new ControleQuadro();
        $quadroControle->setVisao($_POST);
        $quadroUnico = $quadroControle->controleAcao('listarUnico', $_POST['id']);
        $retorno = $quadroControle->controleAcao("excluir");
        if($retorno) {
            $arrayRetorno = ['id' => $quadroUnico->getId(),'idEvento' => $quadroUnico->getIdEvento(), 'idServico' => $quadroUnico->getIdServico()];
            echo json_encode($arrayRetorno);
        }
    }
?>