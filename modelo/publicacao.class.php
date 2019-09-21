<?php


class Publicacao implements ibaseModelo{
    private $id;
    private $idEvento;
    private $titulo;
    private $descricao;
    private $imagem;
    private $data;
    private $conn;
    private $stmt;
    
    
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

    public function getTitulo() {
        return $this->titulo;
    }

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function getImagem() {
        return $this->imagem;
    }

    public function setImagem($imagem) {
        $this->imagem = $imagem;
    }

    public function getData() {
        return $this->data;
    }

    public function setData($data) {
        $this->data = $data;
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
            $query="INSERT INTO publicacao (idEvento, titulo, descricao, imagem, data) VALUES (:idEvento, :titulo, :descricao, :imagem, :data) ";

            $this->stmt= $this->conn->prepare($query);

            $this->stmt->bindValue(':idEvento', $this->idEvento, PDO::PARAM_INT);
            $this->stmt->bindValue(':titulo', $this->titulo, PDO::PARAM_STR);
            $this->stmt->bindValue(':descricao', $this->descricao, PDO::PARAM_STR);
            $this->stmt->bindValue(':imagem', $this->imagem, PDO::PARAM_STR);
            $this->stmt->bindValue(':data', $this->data, PDO::PARAM_STR);

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
            $query="UPDATE publicacao SET idEvento = :idEvento, titulo = :titulo, imagem = :imagem, descricao = :descricao WHERE id=:id ";
            $this->stmt= $this->conn->prepare($query);

            $this->stmt->bindValue(':idEvento', $this->idEvento, PDO::PARAM_INT);
            $this->stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
            $this->stmt->bindValue(':titulo', $this->titulo, PDO::PARAM_STR);
            $this->stmt->bindValue(':imagem', $this->imagem, PDO::PARAM_STR);
            $this->stmt->bindValue(':descricao', $this->descricao, PDO::PARAM_STR);


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
            $query="DELETE FROM publicacao WHERE id=:id ";
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
                $query="SELECT id,idEvento,titulo,descricao,imagem,data FROM publicacao WHERE idEvento = :evento";
            }else{
                // Pesquisa todos
                $query="SELECT id,idEvento,titulo,descricao,imagem,data FROM publicacao";
            }
            $this->stmt= $this->conn->prepare($query);
            if(!is_null($evento))$this->stmt->bindValue(':evento', $evento, PDO::PARAM_INT);

            if($this->stmt->execute()){
                // Associa cada registro a uma classe aluno
                // Depois, coloca os resultados em um array
                $eventos = $this->stmt->fetchAll(PDO::FETCH_CLASS,"Publicacao");  
                
            }
            
            return $eventos;            
        } catch(PDOException $e) {
            echo "<div class='alert alert-danger'>".$e->getMessage()."</div>";   
            return null;
        }
        
    }
    
    public function listarUnico($id){
        
        try{
            $query="SELECT id,idEvento,titulo,descricao,imagem,data FROM publicacao WHERE id=:id";
            $this->stmt= $this->conn->prepare($query);
            $this->stmt->bindValue(':id', $id, PDO::PARAM_INT);
            
            if($this->stmt->execute()){
                // Associa o registro a uma classe aluno
                $evento = $this->stmt->fetchAll(PDO::FETCH_CLASS,"Publicacao");  
                
            }
            
            return $evento[0];            
        } catch(PDOException $e) {
            echo "<div class='alert alert-danger'>".$e->getMessage()."</div>";   
            return null;
        }
        
    }

    public function listarUltimo($idEvento){
        try{
            $query="SELECT id,idEvento,titulo,descricao,imagem,data FROM publicacao WHERE id = (SELECT MAX(ID) FROM publicacao WHERE idEvento = :idEvento)";
            $this->stmt= $this->conn->prepare($query);
            $this->stmt->bindValue(':idEvento', $idEvento, PDO::PARAM_INT);
            
            if($this->stmt->execute()){
                // Associa o registro a uma classe aluno
                $evento = $this->stmt->fetchAll(PDO::FETCH_CLASS,"Publicacao");  
                
            }
            
            return $evento[0];            
        } catch(PDOException $e) {
            echo "<div class='alert alert-danger'>".$e->getMessage()."</div>";   
            return null;
        }    
    }
}