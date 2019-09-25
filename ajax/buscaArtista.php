<?php 

    include_once '../autoload.php';
    if(isset($_POST)){
        $servicoControle = new ControleServico();

        $servicos = [];
        $servicos = $servicoControle->controleAcao("listarTodos",$_POST['nome'],5);

        $eventoArtistaControle = new ControleEventoArtista();
        $eventoArtistas = [];
        $eventoArtistas = $eventoArtistaControle->controleAcao("listarTodos", $_POST['evento']);

        $resposta = [];

        foreach($servicos as $se) {
            $disabled = '';
            foreach ($eventoArtistas as $ea) {
                if($ea->getIdServico() == $se->getId()){
                    $disabled = 'disabled';
                }
            }
            $resposta[] = ['id' => $se->getId(), 'nome' => $se->getNome(), 'email' => $se->getEmail(), 'telefone' => $se->getTelefone(), 'categoria' => $se->getIdCategoria(),'disabled' => $disabled, 'imagem' => $se->getImagem()];
        }

        echo json_encode($resposta);
    }

?>