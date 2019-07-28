<?php $conexao = new mysqli('localhost', 'root', '', 'partyplanner');
        if ($conexao->connect_error) {
            die("Erro na conexão: " . $conexao->connect_error);
        }
        ?>