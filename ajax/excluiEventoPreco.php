<?php
    include_once '../autoload.php';
    if($_POST){
        $eventoPrecoControle = new ControleEventoPreco();
        $eventoPrecoControle->setVisao($_POST);
        $eventoPrecoUnico = $eventoPrecoControle->controleAcao('listarUnico', $_POST['id']);
        $retorno = $eventoPrecoControle->controleAcao("excluir");
        if($retorno) {
            $arrayRetorno = ['id' => $eventoPrecoUnico->getId()];
            echo json_encode($arrayRetorno);
        }
    }
?>