<?php
    include_once '../autoload.php';
    if($_POST){
        //Cria o Controle desta View (página)
        $favoritaEventoControle = new ControleEventoFavorita();
        //Passa o POST desta View para o Controle
        $favoritaEventoControle->setVisao($_POST);
        //Verifica qual ação (inserir ou alterar) vai passar para o Controle listarUltimo
        $retorno = $favoritaEventoControle->controleAcao('inserir');
        if($retorno){
            echo "<script>alert('certo')<script>";
        }
    }
?>