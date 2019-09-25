<?php
    include_once '../autoload.php';
    if($_POST){
        //Cria o Controle desta View (página)
        $eventoRepresentanteControle = new ControleEventoRepresentante();
        //Passa o POST desta View para o Controle
        $eventoRepresentanteControle->setVisao($_POST);
        //Verifica qual ação (inserir ou alterar) vai passar para o Controle listarUltimo
        $retorno = $eventoRepresentanteControle->controleAcao("inserir");
        if($retorno) {
            $eventoRepresentanteUnico = $eventoRepresentanteControle->controleAcao('listarUltimo', $_POST['idEvento']);
            $organizadorControle = new ControleOrganizador();
            $organizadorUnico = $organizadorControle->controleAcao("listarUnico", $_POST['idUsuario']);
            $arrayRetorno = ['idEventoRepresentante' => $eventoRepresentanteUnico->getId(),'idEvento' => $_POST['idEvento'], 'idUsuario' => $_POST['idUsuario'], 'nome' => $organizadorUnico->getNome(), 'email' => $organizadorUnico->getEmail(), 'imagem' => $organizadorUnico->getImagem()];
            echo json_encode($arrayRetorno);
        }
    }
?>