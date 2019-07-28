<?php
    include_once '../autoload.php';
    if($_POST){
        //Cria o Controle desta View (página)
        $eventoControle = new ControleEvento();

        $_POST['idUsuario'] = 1;
        //Passa o POST desta View para o Controle
        $eventoControle->setVisao($_POST);
        //Verifica qual ação (inserir ou alterar) vai passar para o Controle
        $retorno = $eventoControle->controleAcao("inserir");
        if($retorno) {
            $arrayRetorno = ['id' => 1, 'nome' => $_POST['nome']];
            echo json_encode($arrayRetorno);
        }
    }
?>