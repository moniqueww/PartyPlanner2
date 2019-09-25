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

        $quadroControle = new ControleQuadro();

        $quadros = [];

        $quadros = $quadroControle->controleAcao("listarTodos", $_POST['evento']);

        $resposta = [];

        foreach($servicos as $se) {
            $disabled = '';
            foreach ($quadros as $qu) {
                if($qu->getIdServico() == $se->getId()){
                    $disabled = 'disabled';
                }
            }
            $resposta[] = ['id' => $se->getId(), 'nome' => $se->getNome(), 'email' => $se->getEmail(), 'telefone' => $se->getTelefone(), 'categoria' => $se->getIdCategoria(),'disabled' => $disabled, 'imagem' => $se->getImagem()];
        }

        echo json_encode($resposta);
    }

?>