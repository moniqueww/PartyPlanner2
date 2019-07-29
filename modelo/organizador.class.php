<?php


class Organizador implements IBaseModelo{
    private $name;
    private $email;
    private $senha;
	private $nomeorg;
	private $celular;
    private $conn;
    private $stmt;
    

    public function getName() {
        return $this->name;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getSenha() {
        return $this->senha;
    }
	
	public function getNomeorg() {
        return $this->nomeorg;
    }
	
	public function getCelular() {
        return $this->celular;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setEmail($email) {
        $this->email = $email;
    }
    
    public function setSenha($senha) {
        $this->senha = $senha;
    }
    
	public function setNomeorg($nomeorg) {
        $this->nomeorg = $nomeorg;
    }
	
	public function setCelular($celular) {
        $this->celular = $celular;
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
            $query="INSERT INTO Organizadors (name,email,senha,celular,nomeorg) VALUES (:name,:email,:senha,:celular,:celular) ";

            $this->stmt= $this->conn->prepare($query);

            $this->stmt->bindValue(':name', $this->name, PDO::PARAM_STR);
            $this->stmt->bindValue(':email', $this->email, PDO::PARAM_STR);
            $this->stmt->bindValue(':senha', $this->senha, PDO::PARAM_STR);
            $this->stmt->bindValue(':celular', $this->celular, PDO::PARAM_STR);
			$this->stmt->bindValue(':nomeorg', $this->nomeorg, PDO::PARAM_STR);

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
            $query="UPDATE Organizadors SET name = :name, email = :email, senha = :senha, celular = :celular, nomeorg = :nomeorg  WHERE id=:id ";
            $this->stmt= $this->conn->prepare($query);

            $this->stmt->bindValue(':name', $this->name, PDO::PARAM_STR);
            $this->stmt->bindValue(':email', $this->email, PDO::PARAM_STR);
            $this->stmt->bindValue(':senha', $this->senha, PDO::PARAM_STR);
            $this->stmt->bindValue(':celular', $this->celular, PDO::PARAM_STR);
			$this->stmt->bindValue(':nomeorg', $this->nomeorg, PDO::PARAM_STR);
			$this->stmt->bindValue(':id', $param, PDO::PARAM_STR);


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
            $query="DELETE FROM Organizadors WHERE id=:id ";
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
    
    public function listarTodos($name=null, $param2){
        
        try{
            $organizadores = array();
            
            //Comando SQL para inserir um organizador
            if(!is_null($name)){
                //Pesquisa pelo nome
                $query="SELECT name,email,senha,celular,nomeorg FROM Organizadors WHERE name LIKE :name ORDER BY email, celular, name";
            }else{
                // Pesquisa todos
                $query="SELECT name,email,senha,celular,nomeorg FROM Organizadors ORDER BY email, celular, name";
            }
            $this->stmt= $this->conn->prepare($query);
            if(!is_null($name))$this->stmt->bindValue(':name', '%'.$name.'%', PDO::PARAM_STR);

            if($this->stmt->execute()){
                // Associa cada registro a uma classe organizador
                // Depois, coloca os resultados em um array
                $organizadores = $this->stmt->fetchAll(PDO::FETCH_CLASS,"Organizador");  
                
            }
            
            return $organizadores;            
        } catch(PDOException $e) {
            echo "<div class='alert alert-danger'>".$e->getMessage()."</div>";   
            return null;
        }
        
    }
    
    public function listarUnico($name){
        
        try{
            $query="SELECT name,email,senha,celular,nomeorg FROM Organizadors WHERE id=:id";
            $this->stmt= $this->conn->prepare($query);
            $this->stmt->bindValue(':id', $name, PDO::PARAM_INT);
            
            if($this->stmt->execute()){
                // Associa o registro a uma classe organizador
                $organizador = $this->stmt->fetchAll(PDO::FETCH_CLASS,"Organizador");  
                
            }
            
            return $organizador[0];            
        } catch(PDOException $e) {
            echo "<div class='alert alert-danger'>".$e->getMessage()."</div>";   
            return null;
        }
        
    }
    public function listarPorNome($name){
        
        try{
            $query="SELECT id,name FROM eventos WHERE name=:name";
            $this->stmt= $this->conn->prepare($query);
            $this->stmt->bindValue(':name', $name, PDO::PARAM_INT);
            
            if($this->stmt->execute()){
                // Associa o registro a uma classe aluno
                $evento = $this->stmt->fetchAll(PDO::FETCH_CLASS,"Evento");  
                
            }
            
            return $evento[0];            
        } catch(PDOException $e) {
            echo "<div class='alert alert-danger'>".$e->getMessage()."</div>";   
            return null;
        }    
    }
}