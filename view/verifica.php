<?php
session_start();
if (isset($_COOKIE["logado"])) {
    if ($_COOKIE["logado"] == 'on') {
        $_SESSION["email"] = $_COOKIE["email"];
    }
}else if (!isset($_SESSION["email"])) {
        header("Location: login.php");
        exit;
}
$usuario = $_SESSION['email'];
?>