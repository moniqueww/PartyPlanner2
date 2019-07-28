<?php


class Servico implements IBaseModelo{
    private $id;
    private $nome;
    private $email;
    private $cnpj;
    private $senha;
    private $categoria;
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

    public function getCnpj() {
        return $this->cnpj;
    }

    public function setCnpj($cnpj) {
        $this->cnpj = $cnpj;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }

    public function getCategoria() {
        return $this->categoria;
    }

    public function setCategoria($categoria) {
        $this->categoria = $categoria;
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
            $query="INSERT INTO servicos (nome, email, cnpj, senha, categoria) VALUES (:nome, :email, :cnpj, :senha, :categoria) ";

            $this->stmt= $this->conn->prepare($query);

            $this->stmt->bindValue(':nome', $this->nome, PDO::PARAM_STR);
            $this->stmt->bindValue(':email', $this->email, PDO::PARAM_STR);
            $this->stmt->bindValue(':cnpj', $this->cnpj, PDO::PARAM_STR);
            $this->stmt->bindValue(':senha', $this->senha, PDO::PARAM_STR);
            $this->stmt->bindValue(':categoria', $this->categoria, PDO::PARAM_STR);


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
            $query="UPDATE servicos SET nome = :nome, email = :email, cnpj = :cnpj, senha = :senha, categoria = :categoria WHERE id=:id ";
            $this->stmt= $this->conn->prepare($query);

            $this->stmt->bindValue(':nome', $this->nome, PDO::PARAM_STR);
            $this->stmt->bindValue(':email', $this->email, PDO::PARAM_STR);
            $this->stmt->bindValue(':cnpj', $this->cnpj, PDO::PARAM_STR);
            $this->stmt->bindValue(':senha', $this->senha, PDO::PARAM_STR);
            $this->stmt->bindValue(':categoria', $this->categoria, PDO::PARAM_STR);
            $this->stmt->bindValue(':id', $this->id, PDO::PARAM_INT);


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
            $query="DELETE FROM servicos WHERE id=:id ";
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
    
    public function listarTodos($nome=null, $email){
        
        try{
            $alunos = array();
            
            //Comando SQL para inserir um aluno
            if(!is_null($nome)){
                //Pesquisa pelo nome
                $query="SELECT id,nome, FROM servicos WHERE email = :email AND nome LIKE :nome";
            }else{
                // Pesquisa todos
                $query="SELECT id,nome,email,cnpj,categoria FROM servicos WHERE email = :email";
            }
            $this->stmt= $this->conn->prepare($query);
            if(!is_null($nome))$this->stmt->bindValue(':nome', '%'.$nome.'%', PDO::PARAM_STR);
            if(!is_null($email))$this->stmt->bindValue(':email', $email, PDO::PARAM_STR);
            if(!is_null($cnpj))$this->stmt->bindValue(':cnpj', $cnpj, PDO::PARAM_STR);
            if(!is_null($categoria))$this->stmt->bindValue(':categoria', $categoria, PDO::PARAM_STR);


            if($this->stmt->execute()){
                // Associa cada registro a uma classe aluno
                // Depois, coloca os resultados em um array
                $servicos = $this->stmt->fetchAll(PDO::FETCH_CLASS,"Servico");  
                
            }
            
            return $servicos;            
        } catch(PDOException $e) {
            echo "<div class='alert alert-danger'>".$e->getMessage()."</div>";   
            return null;
        }
        
    }
    
    public function listarUnico($id){
        
        try{
            $query="SELECT id,nome FROM servicos WHERE id=:id";
            $this->stmt= $this->conn->prepare($query);
            $this->stmt->bindValue(':id', $id, PDO::PARAM_INT);
            
            if($this->stmt->execute()){
                // Associa o registro a uma classe aluno
                $servico = $this->stmt->fetchAll(PDO::FETCH_CLASS,"Servico");  
                
            }
            
            return $servico[0];            
        } catch(PDOException $e) {
            echo "<div class='alert alert-danger'>".$e->getMessage()."</div>";   
            return null;
        }
        
    }
    
}
