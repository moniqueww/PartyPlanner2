<?php
if($_SESSION['id'] != $_GET['servico']){
    header("Location: lista_servico.php");
}
?>