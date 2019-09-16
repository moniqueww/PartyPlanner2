<?php
    include_once '../autoload.php';
    if($_POST){

        $servicoControle = new ControleServico();
        $servicoUnico = $servicoControle->controleAcao("listarUnico", $_POST['idEstabelecimento']);

        if($servicoUnico) {
            $arrayRetorno = ['id' => $servicoUnico->getId(), 'nome' => $servicoUnico->getNome(), 'email' => $servicoUnico->getEmail(), 'telefone' => $servicoUnico->getTelefone()];
            echo json_encode($arrayRetorno);
        }
    }
?>