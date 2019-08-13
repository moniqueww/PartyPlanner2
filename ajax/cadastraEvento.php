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
            $eventoUnico = $eventoControle->controleAcao('listarPorNome', $_POST['nome']);
            $arrayRetorno = ['id' => $eventoUnico->getId(), 'nome' => $eventoUnico->getNome()];
            echo json_encode($arrayRetorno);
        }
    }
?>