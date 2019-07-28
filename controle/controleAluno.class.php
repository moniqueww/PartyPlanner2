<?php


class ControleAluno extends ControleBase {
    private $visao;
    private $aluno;
    
    public function getVisao() {
        return $this->visao;
    }

   
    public function setVisao($visao) {
        $this->visao = $visao;
    }

    
    public function __construct() {
        //Cria uma instância da classe Cliente
        $this->aluno = new Aluno();
    }
    
    public function controleAcao($acao,$param=null,$param2=null){
        
        switch ($acao) {
            //Permite adição de ações que não estão no ControleBase
            default:
                //Senão, utiliza os que estão no ControleBase
                return parent::controleAcao($acao,$param,$param2);
                break;
        }
    }
    
    private function preencheModelo(){
        // Passa dados do formulário para a classe Cliente
        $this->aluno->setNome((isset($this->visao["nome"]) && $this->visao["nome"] != null) ? $this->visao["nome"] : "");
        $this->aluno->setMatricula((isset($this->visao["matricula"]) && $this->visao["matricula"] != null) ? $this->visao["matricula"] : "");
        $this->aluno->setEmail((isset($this->visao["email"]) && $this->visao["email"] != null) ? $this->visao["email"] : "");
		$this->aluno->setTurma((isset($this->visao["turma"]) && $this->visao["turma"] != null) ? $this->visao["turma"] : "");
		$this->aluno->setCurso((isset($this->visao["curso"]) && $this->visao["curso"] != null) ? $this->visao["curso"] : "");
    }
    
    protected function inserir() {
        // Passa dados do formulário para a classe Cliente
        $this->preencheModelo();
        //Chama o método para inserir os dados no banco de dados
        return $this->aluno->inserir();
    }
    
    protected function alterar($param) {
        // Passa dados do formulário para a classe Cliente
        $this->preencheModelo();
        //Chama o método para alterar os dados no banco de dados
        return $this->aluno->alterar($param);
    }

    protected function excluir($param,$param2){
        // Passa dados do formulário (via GET) para a classe Cliente
        $this->aluno->setMatricula((isset($this->visao["matricula"]) && $this->visao["matricula"] != null) ? $this->visao["matricula"] : "");
        //Chama o método para excluir os dados no banco de dados
        return $this->aluno->excluir($param,$param2);
    }
    
    protected function listarTodos($param=null, $param2){
        
        //Chama o método para listar os clientes do banco de dados de acordo com um filtro
        return $this->aluno->listarTodos($param, $param2);
    }
    
    protected function listarUnico($param){
        
        
        //Chama o método para listar um cliente específico do banco de dados
        return $this->aluno->listarUnico($param);
    }
}
