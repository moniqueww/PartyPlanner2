<?php
    include_once '../autoload.php';
    if($_POST){
        //Cria o Controle desta View (página)
        $eventoArtistaControle = new ControleEventoArtista();
        //Passa o POST desta View para o Controle
        $eventoArtistaControle->setVisao($_POST);
        //Verifica qual ação (inserir ou alterar) vai passar para o Controle listarUltimo
        $retorno = $eventoArtistaControle->controleAcao("inserir");
        if($retorno) {
            $eventoArtistaUnico = $eventoArtistaControle->controleAcao('listarUltimo', $_POST['idEvento']);
            $servicoControle = new ControleServico();
            $servicoUnico = $servicoControle->controleAcao("listarUnico", $_POST['idServico']);
            $arrayRetorno = ['idEventoArtista' => $eventoArtistaUnico->getId(),'idEvento' => $_POST['idEvento'], 'idServico' => $_POST['idServico'], 'nome' => $servicoUnico->getNome(), 'email' => $servicoUnico->getEmail(), 'telefone' => $servicoUnico->getTelefone(), 'imagem' => $servicoUnico->getImagem()];
            echo json_encode($arrayRetorno);
        }
    }
?>