<?php


class Estrela implements ibaseModelo{
    private $id;
    private $idUsuario;
    private $idServico;
    private $qtdEstrelas;
    private $conn;
    private $stmt;
    
    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getIdUsuario() {
        return $this->idUsuario;
    }

    public function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    public function getIdServico() {
        return $this->idServico;
    }

    public function setIdServico($idServico) {
        $this->idServico = $idServico;
    }

    public function getQtdEstrelas() {
        return $this->qtdEstrelas;
    }

    public function setQtdEstrelas($qtdEstrelas) {
        $this->qtdEstrelas = $qtdEstrelas;
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
            $query="INSERT INTO estrelas (idUsuario, idServico, qtdEstrelas) VALUES (:idUsuario, :idServico, :qtdEstrelas) ";

            $this->stmt= $this->conn->prepare($query);

            $this->stmt->bindValue(':idUsuario', $this->idUsuario, PDO::PARAM_INT);
            $this->stmt->bindValue(':idServico', $this->idServico, PDO::PARAM_INT);
            $this->stmt->bindValue(':qtdEstrelas', $this->qtdEstrelas, PDO::PARAM_INT);

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
            $query="UPDATE estrelas SET idUsuario = :idUsuario, idServico = :idServico WHERE id=:id ";
            $this->stmt= $this->conn->prepare($query);

            $this->stmt->bindValue(':idUsuario', $this->idUsuario, PDO::PARAM_INT);
            $this->stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
            $this->stmt->bindValue(':idServico', $this->idServico, PDO::PARAM_INT);


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
            $query="DELETE FROM evento_artista WHERE id=:id ";
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
                $query="SELECT id,idUsuario,idServico,qtdEstrelas FROM estrelas WHERE idServico = :evento";
            }else{
                // Pesquisa todos
                $query="SELECT id,idUsuario,idServico,qtdEstrelas FROM estrelas";
            }
            $this->stmt= $this->conn->prepare($query);
            if(!is_null($evento))$this->stmt->bindValue(':evento', $evento, PDO::PARAM_INT);

            if($this->stmt->execute()){
                // Associa cada registro a uma classe aluno
                // Depois, coloca os resultados em um array
                $eventos = $this->stmt->fetchAll(PDO::FETCH_CLASS,"Estrela");  
                
            }
            
            return $eventos;            
        } catch(PDOException $e) {
            echo "<div class='alert alert-danger'>".$e->getMessage()."</div>";   
            return null;
        }
        
    }
    
    public function listarUnico($id){
        
        try{
            $query="SELECT id,idUsuario,idServico,qtdEstrelas FROM estrelas WHERE id=:id";
            $this->stmt= $this->conn->prepare($query);
            $this->stmt->bindValue(':id', $id, PDO::PARAM_INT);
            
            if($this->stmt->execute()){
                // Associa o registro a uma classe aluno
                $evento = $this->stmt->fetchAll(PDO::FETCH_CLASS,"Estrela");  
                
            }
            
            return $evento[0];            
        } catch(PDOException $e) {
            echo "<div class='alert alert-danger'>".$e->getMessage()."</div>";   
            return null;
        }
        
    }

    public function listarUltimo($idEvento){
        try{
            $query="SELECT id,idEvento,idServico FROM evento_artista WHERE id = (SELECT MAX(ID) FROM evento_artista WHERE idEvento = :idEvento)";
            $this->stmt= $this->conn->prepare($query);
            $this->stmt->bindValue(':idEvento', $idEvento, PDO::PARAM_INT);
            
            if($this->stmt->execute()){
                // Associa o registro a uma classe aluno
                $evento = $this->stmt->fetchAll(PDO::FETCH_CLASS,"Estrela");  
                
            }
            
            return $evento[0];            
        } catch(PDOException $e) {
            echo "<div class='alert alert-danger'>".$e->getMessage()."</div>";   
            return null;
        }    
    }
}