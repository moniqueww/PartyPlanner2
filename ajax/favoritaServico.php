<?php
    include_once '../autoload.php';
    if($_POST){
        //Cria o Controle desta View (página)
        $favoritaServicoControle = new ControleServicoFavorita();
        //Passa o POST desta View para o Controle
        $favoritaServicoControle->setVisao($_POST);
        //Verifica qual ação (inserir ou alterar) vai passar para o Controle listarUltimo
        $retorno = $favoritaServicoControle->controleAcao('inserir');
        if($retorno){
            echo "<script>alert('certo')<script>";
        }
    }
?>