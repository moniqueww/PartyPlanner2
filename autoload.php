<?php
function autoload($classe)
{
    $classe = lcfirst($classe);
    $classe2 = lcfirst(substr($classe, 0,8));
    $classe3 = lcfirst(substr($classe, 8));
    $classe4 = lcfirst(substr($classe, 0,6));
    $classe5 = lcfirst(substr($classe, 6));
    $classe6 = lcfirst(substr($classe, 8,6));
    $classe7 = lcfirst(substr($classe, 14));
    if(file_exists( "../modelo/{$classe}.class.php" )) {
        include_once "../modelo/{$classe}.class.php";
    }elseif(file_exists( "../modelo/{$classe4}.{$classe5}.class.php" )) {
        include_once "../modelo/{$classe4}.{$classe5}.class.php";
    }elseif(file_exists( "../controle/{$classe2}.{$classe3}.class.php" )) {
        include_once "../controle/{$classe2}.{$classe3}.class.php";
    }elseif(file_exists( "../controle/{$classe2}.{$classe6}.{$classe7}.class.php" )) {
        include_once "../controle/{$classe2}.{$classe6}.{$classe7}.class.php";
    }elseif(file_exists( "../util/{$classe}.class.php" )) {
        include_once "../util/{$classe}.class.php";
    }elseif(file_exists( "../{$classe}.class.php" )) {
        include_once "../{$classe}.class.php";
    }else {
        echo $classe2.'.'.$classe6.'.'.$classe7;
        echo "O arquivo {$classe}.php da classe {$classe} não foi encontrado";
    }
    
}

spl_autoload_register("autoload");