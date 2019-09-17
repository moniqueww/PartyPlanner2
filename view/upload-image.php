<?php
    include_once 'include/banco.php';
    include_once '../autoload.php';
    include_once 'include/verifica.php';
    $pasta_imagens = "img/imagens_evento/";
    $formatos = array('.jpg', '.jpeg', '.png');
    if (isset($_POST)) {
        $nome_imagem = $_FILES['imagem']['name'];
        $tamanho_imagem = $_FILES['imagem']['size'];
        $ext_imagem = strtolower(strrchr($nome_imagem,"."));

        if (in_array($ext_imagem,$formatos)) {
            $tamanho = round($tamanho_imagem / 1024);
            if ($tamanho < 1024) {
                $nome = $nome_imagem;
                $tmp = $_FILES['imagem']['tmp_name'];
                if (move_uploaded_file($tmp, $pasta_imagens.$nome)) {
                    $salv_imagem = "INSERT INTO eventos (imagem) VALUES ($nome)";
                    $salvar_imagem = mysqli_query($conexao, $salv_imagem);
                    echo "<img style='width: 250px; height: 250px;' src='img/imagens_evento/". $nome ."' id='image'>";
                } else {
                    echo "Falha ao enviar a imagem.";
                }
            } else {
                echo "A imagem deve ser de no máximo 1MB.";
            }
        } else {
            echo "Somente os seguites formatos são permitidos: jpg, jpeg e png.";
        }
    } else {
        echo "Selecione uma imagem";
        exit;
    }
?>