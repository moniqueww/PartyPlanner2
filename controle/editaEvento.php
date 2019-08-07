<?php
    include_once '../autoload.php';
    if(isset($_POST)){
        //Cria o Controle desta View (página)
        $eventoControle = new ControleEvento();

        //$_POST['idUsuario'] = 1;
        //Passa o POST desta View para o Controle
        $eventoControle->setVisao($_POST);
        //Verifica qual ação (inserir ou alterar) vai passar para o Controle
        $retorno = $eventoControle->controleAcao("alterar");
        if($retorno) {
            echo "Deu certo";
        }
    }
?>