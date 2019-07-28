<?php
function autoload($classe)
{
    if(file_exists( "../modelo/{$classe}.class.php" )) {
        include_once "../modelo/{$classe}.class.php";
    }elseif(file_exists( "../modelo/{$classe}.class.php" )) {
        include_once "../modelo/{$classe}.class.php";
    }elseif(file_exists( "../controle/{$classe}.class.php" )) {
        include_once "../controle/{$classe}.class.php";
    }elseif(file_exists( "../util/{$classe}.class.php" )) {
        include_once "../util/{$classe}.class.php";
    }elseif(file_exists( "../{$classe}.class.php" )) {
        include_once "../{$classe}.class.php";
    }else {
        echo "O arquivo {$classe}.php da classe {$classe} não foi encontrado";
    }
    
}

spl_autoload_register("autoload");