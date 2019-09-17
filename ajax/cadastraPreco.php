<?php
    include_once '../autoload.php';
    if($_POST){

        $eventoPrecoControle = new ControleEventoPreco();
        $eventoPrecoControle->setVisao($_POST);
        $retorno = $eventoPrecoControle->controleAcao("inserir");

        if($retorno) {
            $eventoPrecoUnico = $eventoPrecoControle->controleAcao('listarUltimo', $_POST['idEvento']);
            $arrayRetorno = ['id' => $eventoPrecoUnico->getId(),'idEvento' => $_POST['idEvento'], 'valor' => $eventoPrecoUnico->getValor(), 'nome' => $eventoPrecoUnico->getNome(), 'descricao' => $eventoPrecoUnico->getDescricao()];
            echo json_encode($arrayRetorno);
        }
    }
?>