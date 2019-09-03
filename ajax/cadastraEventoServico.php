<?php
    include_once '../autoload.php';
    if($_POST){
        //Cria o Controle desta View (página)
        $eventoServicoControle = new ControleEventoServico();
        //Passa o POST desta View para o Controle
        $eventoServicoControle->setVisao($_POST);
        //Verifica qual ação (inserir ou alterar) vai passar para o Controle listarUltimo
        $retorno = $eventoServicoControle->controleAcao("inserir");
        if($retorno) {
            $eventoServicoUnico = $eventoServicoControle->controleAcao('listarUltimo', $_POST['idEvento']);
            $servicoControle = new ControleServico();
            $servicoUnico = $servicoControle->controleAcao("listarUnico", $_POST['idServico']);
            $arrayRetorno = ['idEventoServico' => $eventoServicoUnico->getId(),'idEvento' => $_POST['idEvento'], 'idServico' => $_POST['idServico'], 'nome' => $servicoUnico->getNome(), 'email' => $servicoUnico->getEmail(), 'telefone' => $servicoUnico->getTelefone()];
            echo json_encode($arrayRetorno);
        }
    }
?>