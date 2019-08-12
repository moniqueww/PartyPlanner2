<?php
    include_once '../autoload.php';
    if(isset($_POST)){
        //Cria o Controle desta View (página)
        $servicoControle = new ControleServico();

        //$_POST['idUsuario'] = 1;
        //Passa o POST desta View para o Controle
        $servicoControle->setVisao($_POST);
        //Verifica qual ação (inserir ou alterar) vai passar para o Controle
        $retorno = $servicoControle->controleAcao("alterar");
        if($retorno) {
            echo "Deu certo";
        }
    }
?>