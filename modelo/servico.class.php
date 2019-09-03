<?php


class Servico implements IBaseModelo{
    private $id;
    private $nome;
    private $email;
    private $cnpj;
    private $telefone;
    private $senha;
    private $tipo;
    private $idCategoria;
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

    public function getTelefone() {
        return $this->telefone;
    }

    public function setTelefone($telefone) {
        $this->telefone = $telefone;
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

    public function getTipo() {
        return $this->tipo;
    }

    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    public function getIdCategoria() {
        return $this->idCategoria;
    }

    public function setIdCategoria($idCategoria) {
        $this->idCategoria = $idCategoria;
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
            $query="INSERT INTO usuario (nome, email, telefone, senha, cnpj, tipo, idCategoria) VALUES (:nome, :email, :telefone, :senha, :cnpj, :tipo, :idCategoria)";

            $this->stmt= $this->conn->prepare($query);

            $this->stmt->bindValue(':nome', $this->nome, PDO::PARAM_STR);
            $this->stmt->bindValue(':email', $this->email, PDO::PARAM_STR);
            $this->stmt->bindValue(':telefone', $this->telefone, PDO::PARAM_STR);
            $this->stmt->bindValue(':cnpj', $this->cnpj, PDO::PARAM_STR);
            $this->stmt->bindValue(':senha', $this->senha, PDO::PARAM_STR);
            $this->stmt->bindValue(':tipo', 'S', PDO::PARAM_STR);
            $this->stmt->bindValue(':idCategoria', $this->idCategoria, PDO::PARAM_STR);


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
            $query="UPDATE usuario SET nome = :nome, email = :email, telefone = :telefone, cnpj = :cnpj WHERE id=:id ";
            $this->stmt= $this->conn->prepare($query);

            $this->stmt->bindValue(':nome', $this->nome, PDO::PARAM_STR);
            $this->stmt->bindValue(':email', $this->email, PDO::PARAM_STR);
            $this->stmt->bindValue(':telefone', $this->telefone, PDO::PARAM_STR);
            $this->stmt->bindValue(':cnpj', $this->cnpj, PDO::PARAM_STR);
            //$this->stmt->bindValue(':senha', $this->senha, PDO::PARAM_STR);
            //$this->stmt->bindValue(':categoria', $this->categoria, PDO::PARAM_STR);
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
    
    public function listarTodos($nome=null, $idCategoria){
        
        try{
            $alunos = array();
            
            //Comando SQL para inserir um aluno
            if(!is_null($nome)){
                if (!is_null($idCategoria)) {
                    $query="SELECT id, nome, email, telefone, senha, cnpj, idCategoria FROM usuario WHERE nome LIKE :nome AND idCategoria=:idCategoria AND tipo='S'";
                }else {
                    $query="SELECT id, nome, email, telefone, senha, cnpj, idCategoria FROM usuario WHERE nome LIKE :nome AND tipo='S'";
                }
                //Pesquisa pelo nome
            }else{
                if (!is_null($idCategoria)) {
                    $query="SELECT id, nome, email, telefone, senha, cnpj, idCategoria FROM usuario WHERE idCategoria=:idCategoria AND tipo='S'";
                }else {
                    $query="SELECT id, nome, email, telefone, senha, cnpj, idCategoria FROM usuario WHERE tipo='S'";
                }
            }
            $this->stmt= $this->conn->prepare($query);
            if(!is_null($nome))$this->stmt->bindValue(':nome', '%'.$nome.'%', PDO::PARAM_STR);
            if(!is_null($idCategoria))$this->stmt->bindValue(':idCategoria', $idCategoria, PDO::PARAM_STR);


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
            $query="SELECT id, nome, email, telefone, senha, cnpj, idCategoria FROM usuario WHERE id=:id AND tipo='S'";
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
    public function listarUltimo($nome){
        
        try{
            $query="SELECT * FROM eventos WHERE nome=:nome";
            $this->stmt= $this->conn->prepare($query);
            $this->stmt->bindValue(':nome', $nome, PDO::PARAM_INT);
            
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