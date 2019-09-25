<?php 

    include_once '../autoload.php';
    if(isset($_POST)){
        $organizadorControle = new ControleOrganizador();

        $organizadores = [];
        $organizadores = $organizadorControle->controleAcao("listarTodos",$_POST['nome'],5);

        $eventoRepresentanteControle = new ControleEventoRepresentante();
        $eventoRepresentantes = [];
        $eventoRepresentantes = $eventoRepresentanteControle->controleAcao("listarTodos", $_POST['evento']);

        $resposta = [];

        foreach($organizadores as $or) {
            $disabled = '';
            foreach ($eventoRepresentantes as $er) {
                if($er->getIdUsuario() == $or->getId()){
                    $disabled = 'disabled';
                }
            }
            $resposta[] = ['id' => $or->getId(), 'nome' => $or->getNome(), 'email' => $or->getEmail(), 'disabled' => $disabled, 'imagem' => $or->getImagem()];
        }

        echo json_encode($resposta);
    }

?>