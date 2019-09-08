<?php 

    include_once '../autoload.php';
    if(isset($_POST)){
        $eventoControle = new ControleEvento();
        $eventos = [];
        $eventos = $eventoControle->controleAcao("listarTodos", '', $_POST['idUsuario']);

        $resposta = [];

        foreach($eventos as $ev) {
            $organizadorControle = new ControleOrganizador();
            $organizadorControle = $organizadorControle->controleAcao('listarUnico', $ev->getIdUsuario());
            $resposta[] = ['id' => $ev->getId(), 'nome' => $ev->getNome(), 'status' => $ev->getStatus(), 'idUsuario' => $ev->getIdUsuario(), 'organizador' => $organizadorControle->getNome()];
        }

        echo json_encode($resposta);
    }

?>