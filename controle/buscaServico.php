<?php 

    include_once '../autoload.php';
    if(isset($_POST)){
        $servicoControle = new ControleServico();

        $servicos = [];

        $servicos = $servicoControle->controleAcao("listarTodos",$_POST['nome']);

        $resposta = [];

        foreach($servicos as $se) {
            $resposta[] = ['id' => $se->getId(), 'nome' => $se->getNome(), 'email' => $se->getEmail(), 'telefone' => $se->getTelefone()];
        }

        echo json_encode($resposta);
    }

?>