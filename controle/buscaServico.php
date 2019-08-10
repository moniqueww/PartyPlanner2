<?php 

    include_once '../autoload.php';
    if(isset($_POST)){
        $servicoControle = new ControleServico();

        $servicos = [];

        $servicos = $servicoControle->controleAcao("listarTodos",$_POST['nome']);

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
            $resposta[] = ['id' => $se->getId(), 'nome' => $se->getNome(), 'email' => $se->getEmail(), 'telefone' => $se->getTelefone(), 'disabled' => $disabled];
        }

        echo json_encode($resposta);
    }

?>