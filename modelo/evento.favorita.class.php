<?php


class EventoFavorita implements IBaseModelo{
    private $id;
    private $idEvento;
    private $idUsuario;
    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getIdEvento() {
        return $this->idEvento;
    }

    public function setIdEvento($idEvento) {
        $this->idEvento = $idEvento;
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
            $query="INSERT INTO favorita_evento (idEvento, idUsuario) VALUES (:idEvento, :idUsuario) ";

            $this->stmt= $this->conn->prepare($query);

            $this->stmt->bindValue(':idEvento', $this->idEvento, PDO::PARAM_INT);
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
            $query="UPDATE favorita_evento SET idEvento = :idEvento, idUsuario = :idUsuario WHERE id=:id ";
            $this->stmt= $this->conn->prepare($query);

            $this->stmt->bindValue(':idEvento', $this->idEvento, PDO::PARAM_INT);
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
            $query="DELETE FROM favorita_evento WHERE id=:id ";
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
    
    public function listarTodos($evento, $idUsuario){
        
        try{
            $alunos = array();
            
            //Comando SQL para inserir um aluno
            if(!is_null($evento)){
                //Pesquisa pelo nome
                $query="SELECT id,idEvento,idUsuario FROM favorita_evento WHERE idEvento = :evento";
            }else{
                // Pesquisa todos
                $query="SELECT id,idEvento,idUsuario FROM favorita_evento";
            }
            $this->stmt= $this->conn->prepare($query);
            if(!is_null($evento))$this->stmt->bindValue(':evento', $evento, PDO::PARAM_INT);

            if($this->stmt->execute()){
                // Associa cada registro a uma classe aluno
                // Depois, coloca os resultados em um array
                $eventos = $this->stmt->fetchAll(PDO::FETCH_CLASS,"EventoFavorita");  
                
            }
            
            return $eventos;            
        } catch(PDOException $e) {
            echo "<div class='alert alert-danger'>".$e->getMessage()."</div>";   
            return null;
        }
        
    }
    
    public function listarUnico($id){
        
        try{
            $query="SELECT id,idEvento,idUsuario FROM favorita_evento WHERE id=:id";
            $this->stmt= $this->conn->prepare($query);
            $this->stmt->bindValue(':id', $id, PDO::PARAM_INT);
            
            if($this->stmt->execute()){
                // Associa o registro a uma classe aluno
                $evento = $this->stmt->fetchAll(PDO::FETCH_CLASS,"EventoFavorita");  
                
            }
            
            return $evento[0];            
        } catch(PDOException $e) {
            echo "<div class='alert alert-danger'>".$e->getMessage()."</div>";   
            return null;
        }
        
    }

    public function listarUltimo($idEvento){
        try{
            $query="SELECT id,idEvento,idUsuario FROM favorita_evento WHERE id = (SELECT MAX(ID) FROM favorita_evento WHERE idEvento = :idEvento)";
            $this->stmt= $this->conn->prepare($query);
            $this->stmt->bindValue(':idEvento', $idEvento, PDO::PARAM_INT);
            
            if($this->stmt->execute()){
                // Associa o registro a uma classe EventoFavorita
                $evento = $this->stmt->fetchAll(PDO::FETCH_CLASS,"EventoFavorita");  
                
            }
            
            return $evento[0];            
        } catch(PDOException $e) {
            echo "<div class='alert alert-danger'>".$e->getMessage()."</div>";   
            return null;
        }    
    }
}