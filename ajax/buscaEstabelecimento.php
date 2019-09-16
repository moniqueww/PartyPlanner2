<?php 

    include_once '../autoload.php';
    if(isset($_POST)){
        $servicoControle = new ControleServico();

        $servicos = [];
        $servicos = $servicoControle->controleAcao("listarTodos",$_POST['nome'],2);

        $eventoControle = new ControleEvento();
        $eventoUnico = $eventoControle->controleAcao("listarUnico", $_POST['evento']);;

        $resposta = [];

        foreach($servicos as $se) {
            $disabled = '';
            if($eventoUnico->getIdEstabelecimento() == $se->getId()){
                $disabled = 'disabled';
            }
            $resposta[] = ['id' => $se->getId(), 'nome' => $se->getNome(), 'email' => $se->getEmail(), 'telefone' => $se->getTelefone(), 'categoria' => $se->getIdCategoria(),'disabled' => $disabled];
        }

        echo json_encode($resposta);
    }

?>