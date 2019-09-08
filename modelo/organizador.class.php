<?php


class Organizador implements IBaseModelo{
    private $id;
    private $nome;
    private $email;
    private $senha;
    private $cnpj;
    private $tipo;
    private $conn;
    private $stmt;
    

    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function getCnpj() {
        return $this->nome;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setEmail($email) {
        $this->email = $email;
    }
    
    public function setSenha($senha) {
        $this->senha = $senha;
    }

    public function setCnpj($cnpj) {
        $this->cnpj = $cnpj;
    }
    
    public function setTipo($tipo) {
        $this->tipo = $tipo;
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
            $query="INSERT INTO usuario (nome,email,senha,tipo) VALUES (:nome,:email,:senha,:tipo) ";

            $this->stmt= $this->conn->prepare($query);

            $this->stmt->bindValue(':nome', $this->nome, PDO::PARAM_STR);
            $this->stmt->bindValue(':email', $this->email, PDO::PARAM_STR);
            $this->stmt->bindValue(':senha', $this->senha, PDO::PARAM_STR);
			$this->stmt->bindValue(':tipo', 'O', PDO::PARAM_STR);

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
            $query="UPDATE usuario SET nome = :nome, email = :email, senha = :senha WHERE id=:id ";
            $this->stmt= $this->conn->prepare($query);

            $this->stmt->bindValue(':id', $param, PDO::PARAM_INT);
            $this->stmt->bindValue(':nome', $this->name, PDO::PARAM_STR);
            $this->stmt->bindValue(':email', $this->email, PDO::PARAM_STR);
            $this->stmt->bindValue(':senha', $this->senha, PDO::PARAM_STR);
			


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
            $query="DELETE FROM usuario WHERE id=:id ";
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
                $query="SELECT id,nome,email,senha FROM usuario WHERE nome LIKE :nome AND tipo='O'";
            }else{
                // Pesquisa todos
                $query="SELECT id,nome,email,senha FROM usuario WHERE tipo='O'";
            }
            $this->stmt= $this->conn->prepare($query);
            if(!is_null($name))$this->stmt->bindValue(':nome', '%'.$name.'%', PDO::PARAM_STR);

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
    
    public function listarUnico($id){
        
        try{
            $query="SELECT id,nome,email,senha FROM usuario WHERE id=:id";
            $this->stmt= $this->conn->prepare($query);
            $this->stmt->bindValue(':id', $id, PDO::PARAM_INT);
            
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
    public function listarUltimo($nome){
        
        try{
            $query="SELECT id,nome FROM usuario WHERE nome=:nome";
            $this->stmt= $this->conn->prepare($query);
            $this->stmt->bindValue(':nome', $nome, PDO::PARAM_INT);
            
            if($this->stmt->execute()){
                // Associa o registro a uma classe aluno
                $evento = $this->stmt->fetchAll(PDO::FETCH_CLASS,"Organizador");  
                
            }
            
            return $evento[0];            
        } catch(PDOException $e) {
            echo "<div class='alert alert-danger'>".$e->getMessage()."</div>";   
            return null;
        }    
    }
}