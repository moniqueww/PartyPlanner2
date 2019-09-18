<?php
if($_SESSION['id'] != $_GET['organizador']){
    header("Location: lista_servico.php");
}
?>