<?php 

    include_once '../autoload.php';
    if(isset($_POST)){
        $servicoControle = new ControleServico();

        $servicos = [];

        if(empty($_POST['idCategoria'])) {
            $servicos = $servicoControle->controleAcao("listarTodos",$_POST['nome']);
        } else {
            $servicos = $servicoControle->controleAcao("listarTodos",$_POST['nome'],$_POST['idCategoria']);
        }

        $eventoServicoControle = new ControleEventoServico();

        $eventosServicos = [];

        $eventosServicos = $eventoServicoControle->controleAcao("listarTodos", $_POST['evento']);

        $resposta = [];

        foreach($servicos as $se) {
            $disabled = '';
            foreach ($eventosServicos as $es) {
                if($es->getIdServico() == $se->getId()){
                    $disabled = 'disabled';
                }
            }
            $resposta[] = ['id' => $se->getId(), 'nome' => $se->getNome(), 'email' => $se->getEmail(), 'telefone' => $se->getTelefone(), 'categoria' => $se->getIdCategoria(),'disabled' => $disabled];
        }

        echo json_encode($resposta);
    }

?>