<?php


class Usuario implements IBaseModelo{
    private $id;
    private $nome;
    private $email;
    private $senha;
    private $tipo;
    private $cnpj;
    private $conn;
    private $stmt;
    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

        public function getSenha() {
        return $this->senha;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    public function getCnpj() {
        return $this->cnpj;
    }

    public function setCnpj($cnpj) {
        $this->cnpj = $cnpj;
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
            $query="INSERT INTO usuario (nome,email,senha,tipo,cnpj) VALUES (:nome,:email,:senha,:tipo,:cnpj) ";

            $this->stmt= $this->conn->prepare($query);

            $this->stmt->bindValue(':nome', $this->nome, PDO::PARAM_STR);
            $this->stmt->bindValue(':email', $this->email, PDO::PARAM_STR);
            $this->stmt->bindValue(':senha', $this->senha, PDO::PARAM_STR);
            $this->stmt->bindValue(':tipo', $this->tipo, PDO::PARAM_STR);
            $this->stmt->bindValue(':cnpj', $this->cnpj, PDO::PARAM_STR);

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
            $query="UPDATE usuario SET nome = :nome, email = :email, senha = :senha, tipo = :tipo, cnpj = :cnpj WHERE id=:id ";
            $this->stmt= $this->conn->prepare($query);

            $this->stmt->bindValue(':nome', $this->nome, PDO::PARAM_STR);
            $this->stmt->bindValue(':email', $this->email, PDO::PARAM_STR);
            $this->stmt->bindValue(':senha', $this->senha, PDO::PARAM_STR);
            $this->stmt->bindValue(':tipo', $this->tipo, PDO::PARAM_STR);
            $this->stmt->bindValue(':cnpj', $this->cnpj, PDO::PARAM_STR);
            $this->stmt->bindValue(':id', $this->id, PDO::PARAM_STR);


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
    
    public function listarTodos($email=null,$param2){
        
        try{
            $usuarios= array();
            // Pesquisa todos
			if(!is_null($email)){
                //Pesquisa pelo email
                $query="SELECT id,nome,email,senha,tipo,cnpj FROM usuario WHERE email LIKE :email";
            }else{
                // Pesquisa todos
                $query="SELECT id,nome,email,senha,tipo,cnpj FROM usuario";
            }
            $this->stmt= $this->conn->prepare($query);
			if(!is_null($email))$this->stmt->bindValue(':email', '%'.$email.'%', PDO::PARAM_STR);

            if($this->stmt->execute()){
                // Associa cada registro a uma classe aluno
                // Depois, coloca os resultados em um array
                $usuarios = $this->stmt->fetchAll(PDO::FETCH_CLASS,"Usuario");  
                
            }
            
            return $usuarios;            
        } catch(PDOException $e) {
            echo "<div class='alert alert-danger'>".$e->getMessage()."</div>";   
            return null;
        }
        
    }
    
    public function listarUnico($id){
        
        try{
            $query="SELECT id,nome,email,senha,tipo,cnpj FROM usuario WHERE id=:id";
            $this->stmt= $this->conn->prepare($query);
            $this->stmt->bindValue(':id', $id, PDO::PARAM_INT);
            
            if($this->stmt->execute()){
                // Associa o registro a uma classe aluno
                $usuario = $this->stmt->fetchAll(PDO::FETCH_CLASS,"Usuario");  
                
            }
            
            return $usuario[0];            
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