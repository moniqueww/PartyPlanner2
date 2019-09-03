<?php
    include_once '../autoload.php';
    if(isset($_POST)){
        //Cria o Controle desta View (página)
        $eventoControle = new ControleEvento();
        //Passa o POST desta View para o Controle
        $eventoControle->setVisao($_POST);
        //Verifica qual ação (inserir ou alterar) vai passar para o Controle
        $retorno = $eventoControle->controleAcao("inserir");
        if($retorno) {
            $eventoControle = new ControleEvento();
            $eventoUnico = $eventoControle->controleAcao('listarUltimo', $_POST['idUsuario']);
            $usuarioControle = new ControleOrganizador();
            $usuarioUnico = $usuarioControle->controleAcao('listarUnico', $_POST['idUsuario']);
            $arrayRetorno = ['id' => $eventoUnico->getId(), 'nome' => $eventoUnico->getNome(), 'nomeUsuario' => $usuarioUnico->getNome()];
            echo json_encode($arrayRetorno);
        }
    }
?>