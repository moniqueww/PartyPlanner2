<?php
    include_once '../autoload.php';
    if($_POST){
        //Cria o Controle desta View (página)
        $estrelaControle = new ControleEstrela();
        //Passa o POST desta View para o Controle
        $estrelaControle->setVisao($_POST);
        //Verifica qual ação (inserir ou alterar) vai passar para o Controle listarUltimo
        $retorno = $estrelaControle->controleAcao("inserir");
        if($retorno) {
            echo json_encode($_POST);
        }
    }
?>