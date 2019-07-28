<?php


class Aluno implements IBaseModelo{
    private $nome;
    private $matricula;
    private $email;
	private $turma;
	private $curso;
    private $conn;
    private $stmt;
    

    public function getNome() {
        return $this->nome;
    }

    public function getMatricula() {
        return $this->matricula;
    }

    public function getEmail() {
        return $this->email;
    }
	
	public function getTurma() {
        return $this->turma;
    }
	
	public function getCurso() {
        return $this->curso;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setMatricula($matricula) {
        $this->matricula = $matricula;
    }

    public function setEmail($email) {
        $this->email = $email;
    }
	
	public function setTurma($turma) {
        $this->turma = $turma;
    }
	
	public function setCurso($curso) {
        $this->curso = $curso;
    }
    
    public function __construct() {
        //Cria conexão com o banco
        $this->conn = Database::conectar();
    }

    public function __destruct(){
        //Fecha a conexão
        Database::desconectar();
    }

    public function inserir(){
        try{
            //Comando SQL para inserir um aluno
            $query="INSERT INTO Aluno (nome,matricula,email,turma,curso) VALUES (:nome,:matricula,:email,:turma,:curso) ";

            $this->stmt= $this->conn->prepare($query);

            $this->stmt->bindValue(':nome', $this->nome, PDO::PARAM_STR);
            $this->stmt->bindValue(':matricula', $this->matricula, PDO::PARAM_STR);
            $this->stmt->bindValue(':email', $this->email, PDO::PARAM_STR);
			$this->stmt->bindValue(':turma', $this->turma, PDO::PARAM_STR);
			$this->stmt->bindValue(':curso', $this->curso, PDO::PARAM_STR);

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
            $query="UPDATE Aluno SET nome = :nome, matricula = :matricula, email = :email, curso = :curso, turma = :turma  WHERE matricula=:id ";
            $this->stmt= $this->conn->prepare($query);

            $this->stmt->bindValue(':nome', $this->nome, PDO::PARAM_STR);
            $this->stmt->bindValue(':matricula', $this->matricula, PDO::PARAM_STR);
            $this->stmt->bindValue(':email', $this->email, PDO::PARAM_STR);
			$this->stmt->bindValue(':curso', $this->curso, PDO::PARAM_STR);
			$this->stmt->bindValue(':turma', $this->turma, PDO::PARAM_STR);
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
            $query="DELETE FROM Aluno WHERE matricula=:matricula ";
            $this->stmt= $this->conn->prepare($query);
            $this->stmt->bindValue(':matricula', $this->matricula, PDO::PARAM_INT);
            if($this->stmt->execute()){
               return true;
            }        
        } catch(PDOException $e) {
            echo "<div class='alert alert-danger'>".$e->getMessage()."</div>";      
            return false;
        }
    }
    
    public function listarTodos($nome=null, $param2){
        
        try{
            $alunos = array();
            
            //Comando SQL para inserir um aluno
            if(!is_null($nome)){
                //Pesquisa pelo nome
                $query="SELECT nome,matricula,email,turma,curso FROM Aluno WHERE nome LIKE :nome ORDER BY curso, turma, nome";
            }else{
                // Pesquisa todos
                $query="SELECT nome,matricula,email,turma,curso FROM Aluno ORDER BY curso, turma, nome";
            }
            $this->stmt= $this->conn->prepare($query);
            if(!is_null($nome))$this->stmt->bindValue(':nome', '%'.$nome.'%', PDO::PARAM_STR);

            if($this->stmt->execute()){
                // Associa cada registro a uma classe aluno
                // Depois, coloca os resultados em um array
                $alunos = $this->stmt->fetchAll(PDO::FETCH_CLASS,"Aluno");  
                
            }
            
            return $alunos;            
        } catch(PDOException $e) {
            echo "<div class='alert alert-danger'>".$e->getMessage()."</div>";   
            return null;
        }
        
    }
    
    public function listarUnico($nome){
        
        try{
            $query="SELECT nome,matricula,email,turma,curso FROM Aluno WHERE matricula=:matricula";
            $this->stmt= $this->conn->prepare($query);
            $this->stmt->bindValue(':matricula', $nome, PDO::PARAM_INT);
            
            if($this->stmt->execute()){
                // Associa o registro a uma classe aluno
                $aluno = $this->stmt->fetchAll(PDO::FETCH_CLASS,"Aluno");  
                
            }
            
            return $aluno[0];            
        } catch(PDOException $e) {
            echo "<div class='alert alert-danger'>".$e->getMessage()."</div>";   
            return null;
        }
        
    }
    
}
