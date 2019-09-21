<?php
session_start();
if (isset($_COOKIE["logado"])) {
    if ($_COOKIE["logado"] == 'on') {
        $_SESSION["email"] = $_COOKIE["email"];
        $usuario = $_SESSION['email'];
    }
}else if (!isset($_SESSION["email"])) {
        $convidado = true;
}else {
	$usuario = $_SESSION['email'];
}
?>