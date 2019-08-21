<?php 

    include_once '../autoload.php';
    if(isset($_POST)){
        $servicoControle = new ControleServico();

        $servicos = [];

        $servicos = $servicoControle->controleAcao("listarTodos", $_POST['nome']);

        $eventoControle = new ControleEventoPublicado();

        $eventos = [];

        $eventos = $eventoControle->controleAcao("listarTodos", $_POST['nome']);

        $resposta = [
            'servicos' => [],
            'eventos' => []
        ];

        foreach($servicos as $se) {
            $resposta['servicos'][] = ['id' => $se->getId(), 'nome' => $se->getNome(), 'email' => $se->getEmail(), 'telefone' => $se->getTelefone(), 'categoria' => $se->getIdCategoria()];
        }

        foreach($eventos as $ev) {
            $resposta['eventos'][] = ['id' => $ev->getId(), 'nome' => $ev->getNome(), 'descricao' => $ev->getDescricao()];
        }

        echo json_encode($resposta);
    }

?>