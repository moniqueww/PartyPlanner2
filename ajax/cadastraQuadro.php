<?php
    include_once '../autoload.php';
    if($_POST){
        //Cria o Controle desta View (página)
        $quadroControle = new ControleQuadro();
        //Passa o POST desta View para o Controle
        $quadroControle->setVisao($_POST);
        //Verifica qual ação (inserir ou alterar) vai passar para o Controle listarUltimo
        $retorno = $quadroControle->controleAcao("inserir");
        if($retorno) {
            $quadroUnico = $quadroControle->controleAcao('listarUltimo', $_POST['idEvento']);
            $servicoControle = new ControleServico();
            $servicoUnico = $servicoControle->controleAcao("listarUnico", $_POST['idServico']);
            $arrayRetorno = ['idQuadro' => $quadroUnico->getId(),'idEvento' => $_POST['idEvento'], 'idServico' => $_POST['idServico'], 'nome' => $servicoUnico->getNome(), 'email' => $servicoUnico->getEmail(), 'telefone' => $servicoUnico->getTelefone()];
            echo json_encode($arrayRetorno);
        }
    }
?>