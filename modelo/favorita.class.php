<?php


class Favorita implements IBaseModelo{
    private $id;
    private $idServico;
    private $idUsuario;
    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getidServico() {
        return $this->idServico;
    }

    public function setidServico($idServico) {
        $this->idServico = $idServico;
    }

    public function getIdUsuario() {
        return $this->idUsuario;
    }

    public function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    public function __construct() {
        //Cria conex�o com o banco
        $this->conn = Database::conectar();
    }

    public function __destruct(){
        //Fecha a conex�o
        Database::desconectar();
    }

    public function inserir(){
        try{
            //Comando SQL para inserir um aluno
            $query="INSERT INTO favorita_servico (idServico, idUsuario) VALUES (:idServico, :idUsuario) ";

            $this->stmt= $this->conn->prepare($query);

            $this->stmt->bindValue(':idServico', $this->idServico, PDO::PARAM_INT);
            $this->stmt->bindValue(':idUsuario', $this->idUsuario, PDO::PARAM_INT);

            if($this->stmt->execute()){
               return true;
            }        
        } catch(PDOException $e) {
            echo "<div class='alert alert-danger'>".$e->getMessage()."</div>";      
            return false;
        }
    }
    
    public function alterar($param){
        try{
            
            //Comando SQL para inserir um aluno
            $query="UPDATE favorita_servico SET idServico = :idServico, idUsuario = :idUsuario WHERE id=:id ";
            $this->stmt= $this->conn->prepare($query);

            $this->stmt->bindValue(':idServico', $this->idServico, PDO::PARAM_INT);
            $this->stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
            $this->stmt->bindValue(':idUsuario', $this->idUsuario, PDO::PARAM_INT);


            if($this->stmt->execute()){
                return true;
            }        
        } catch(PDOException $e) {
            echo "<div class='alert alert-danger'>".$e->getMessage()."</div>";      
            return false;
        }
    }
    
    public function excluir($param,$param2){
        try{
            //Comando SQL para inserir um aluno
            $query="DELETE FROM favorita_servico WHERE id=:id ";
            $this->stmt= $this->conn->prepare($query);
            $this->stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
            if($this->stmt->execute()){
               return true;
            }        
        } catch(PDOException $e) {
            echo "<div class='alert alert-danger'>".$e->getMessage()."</div>";      
            return false;
        }
    }
    
    public function listarTodos($servico, $idUsuario){
        
        try{
            $alunos = array();
            
            //Comando SQL para inserir um aluno
            if(!is_null($servico)){
                //Pesquisa pelo nome
                $query="SELECT id,idServico,idUsuario FROM favorita_servico WHERE idServico = :servico";
            }else{
                // Pesquisa todos
                $query="SELECT id,idServico,idUsuario FROM favorita_servico";
            }
            $this->stmt= $this->conn->prepare($query);
            if(!is_null($servico))$this->stmt->bindValue(':servico', $servico, PDO::PARAM_INT);

            if($this->stmt->execute()){
                // Associa cada registro a uma classe aluno
                // Depois, coloca os resultados em um array
                $servicos = $this->stmt->fetchAll(PDO::FETCH_CLASS,"Favorita");  
                
            }
            
            return $servicos;            
        } catch(PDOException $e) {
            echo "<div class='alert alert-danger'>".$e->getMessage()."</div>";   
            return null;
        }
        
    }
    
    public function listarUnico($id){
        
        try{
            $query="SELECT id,idServico,idUsuario FROM favorita_servico WHERE id=:id";
            $this->stmt= $this->conn->prepare($query);
            $this->stmt->bindValue(':id', $id, PDO::PARAM_INT);
            
            if($this->stmt->execute()){
                // Associa o registro a uma classe aluno
                $servico = $this->stmt->fetchAll(PDO::FETCH_CLASS,"Favorita");  
                
            }
            
            return $servico[0];            
        } catch(PDOException $e) {
            echo "<div class='alert alert-danger'>".$e->getMessage()."</div>";   
            return null;
        }
        
    }

    public function listarUltimo($idServico){
        try{
            $query="SELECT id,idServico,idUsuario FROM favorita_servico WHERE id = (SELECT MAX(ID) FROM favorita_servico WHERE idServico = :idServico)";
            $this->stmt= $this->conn->prepare($query);
            $this->stmt->bindValue(':idServico', $idServico, PDO::PARAM_INT);
            
            if($this->stmt->execute()){
                // Associa o registro a uma classe aluno
                $servico = $this->stmt->fetchAll(PDO::FETCH_CLASS,"Favorita");  
                
            }
            
            return $servico[0];            
        } catch(PDOException $e) {
            echo "<div class='alert alert-danger'>".$e->getMessage()."</div>";   
            return null;
        }    
    }
}