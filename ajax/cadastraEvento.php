<?php
    if($_POST){
        //Cria o Controle desta View (página)
        $eventoControle = new ControleEvento();

        //Passa o POST desta View para o Controle
        $eventoControle->setVisao($_POST);
        //Verifica qual ação (inserir ou alterar) vai passar para o Controle
        $retorno = $eventoControle->controleAcao("inserir");
        if($retorno) {
            echo json_encode(['id' => 1, 'nome' => $_POST['nome']]);
        }
    }
?>