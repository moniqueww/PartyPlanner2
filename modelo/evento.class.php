<?php


class Evento implements ibaseModelo{
    private $id;
    private $nome;
    private $descricao;
    private $idEstabelecimento;
    private $status;
    private $idUsuario;
    private $imagem;
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

    public function getDescricao() {
        return $this->descricao;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function getIdEstabelecimento() {
        return $this->idEstabelecimento;
    }

    public function setIdEstabelecimento($idEstabelecimento) {
        $this->idEstabelecimento = $idEstabelecimento;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function getIdUsuario() {
        return $this->idUsuario;
    }

    public function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    public function getImagem() {
        return $this->imagem;
    }

    public function setImagem($imagem) {
        $this->imagem = $imagem;
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
            $query="INSERT INTO eventos (nome, idUsuario) VALUES (:nome, :idUsuario) ";

            $this->stmt= $this->conn->prepare($query);

            $this->stmt->bindValue(':nome', $this->nome, PDO::PARAM_STR);
            $this->stmt->bindValue(':idUsuario', $this->idUsuario, PDO::PARAM_STR);


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
            $query="UPDATE eventos SET nome = :nome, descricao = :descricao, idEstabelecimento = :idEstabelecimento, status = :status, imagem = :imagem, visitas = :visitas WHERE id=:id ";
            $this->stmt= $this->conn->prepare($query);

            $this->stmt->bindValue(':nome', $this->nome, PDO::PARAM_STR);
            $this->stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
            $this->stmt->bindValue(':descricao', $this->descricao, PDO::PARAM_STR);
            $this->stmt->bindValue(':idEstabelecimento', $this->idEstabelecimento, PDO::PARAM_INT);
            $this->stmt->bindValue(':status', $this->status, PDO::PARAM_INT);
            $this->stmt->bindValue(':imagem', $this->imagem, PDO::PARAM_STR);
            $this->stmt->bindValue(':visitas', $this->visitas, PDO::PARAM_INT);



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
            $query="DELETE FROM eventos WHERE id=:id ";
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
    
    public function listarTodos($nome=null, $idUsuario){
        
        try{
            $alunos = array();
            
            //Comando SQL para inserir um aluno
            if(!is_null($nome)){
                //Pesquisa pelo nome
                $query="SELECT id,nome,descricao,idEstabelecimento,status,idUsuario,imagem FROM eventos WHERE idUsuario = :idUsuario AND nome LIKE :nome";
            }else{
                // Pesquisa todos
                $query="SELECT id,nome,descricao,idEstabelecimento,status,idUsuario,imagem FROM eventos WHERE idUsuario = :idUsuario";
            }
            $this->stmt= $this->conn->prepare($query);
            if(!is_null($nome))$this->stmt->bindValue(':nome', '%'.$nome.'%', PDO::PARAM_STR);
            if(!is_null($idUsuario))$this->stmt->bindValue(':idUsuario', $idUsuario, PDO::PARAM_STR);

            if($this->stmt->execute()){
                // Associa cada registro a uma classe aluno
                // Depois, coloca os resultados em um array
                $eventos = $this->stmt->fetchAll(PDO::FETCH_CLASS,"Evento");  
                
            }
            
            return $eventos;            
        } catch(PDOException $e) {
            echo "<div class='alert alert-danger'>".$e->getMessage()."</div>";   
            return null;
        }
        
    }
    
    public function listarUnico($id){
        
        try{
            $query="SELECT id,nome,descricao,idEstabelecimento,status,idUsuario,imagem FROM eventos WHERE id=:id";
            $this->stmt= $this->conn->prepare($query);
            $this->stmt->bindValue(':id', $id, PDO::PARAM_INT);
            
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

    public function listarUltimo($idUsuario){
        try{
            $query="SELECT id,nome,imagem FROM eventos WHERE id = (SELECT MAX(ID) FROM eventos WHERE idUsuario = :idUsuario)";
            $this->stmt= $this->conn->prepare($query);
            $this->stmt->bindValue(':idUsuario', $idUsuario, PDO::PARAM_STR);
            
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