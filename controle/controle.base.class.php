<?php


abstract class ControleBase {

        
    public function controleAcao($acao,$param=null, $param2=null) {
        switch ($acao) {
            case "inserir":
                return $this->inserir();
                break;
            case "alterar":
                return $this->alterar($param);
                break;
            case "excluir":
                return $this->excluir($param,$param2);
                break;            
             case "listarTodos":
                return $this->listarTodos($param, $param2);
                break; 
            case "listarUnico":  
                return $this->listarUnico($param);
                break; 
            case "listarUltimo":
                return $this->listarUltimo($param);
                break;
            default:
                return "Ação indefinida";
        }
    }

    abstract protected function inserir();

    abstract protected function alterar($param);

    abstract protected function excluir($param, $param2);

    abstract protected function listarTodos($param=null, $param2);
    
    abstract protected function listarUnico($param);

    abstract protected function listarUltimo($param);
}

?>