<?php


class ControleOrganizador extends ControleBase {
    private $visao;
    private $organizador;
    
    public function getVisao() {
        return $this->visao;
    }

   
    public function setVisao($visao) {
        $this->visao = $visao;
    }

    
    public function __construct() {
        //Cria uma instância da classe Cliente
        $this->organizador = new Organizador();
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
        $this->organizador->setNome((isset($this->visao["nome"]) && $this->visao["nome"] != null) ? $this->visao["nome"] : "");
        $this->organizador->setEmail((isset($this->visao["email"]) && $this->visao["email"] != null) ? $this->visao["email"] : "");
        $this->organizador->setSenha((isset($this->visao["senha"]) && $this->visao["senha"] != null) ? $this->visao["senha"] : "");
		$this->organizador->setCnpj((isset($this->visao["cnpj"]) && $this->visao["cnpj"] != null) ? $this->visao["cnpj"] : "");
		$this->organizador->setTipo((isset($this->visao["tipo"]) && $this->visao["tipo"] != null) ? $this->visao["tipo"] : "");
        $this->organizador->setId((isset($this->visao["id"]) && $this->visao["id"] != null) ? $this->visao["id"] : "");
    }
    
    protected function inserir() {
        // Passa dados do formulário para a classe Cliente
        $this->preencheModelo();
        //Chama o método para inserir os dados no banco de dados
        return $this->organizador->inserir();
    }
    
    protected function alterar($param) {
        // Passa dados do formulário para a classe Cliente
        $this->preencheModelo();
        //Chama o método para alterar os dados no banco de dados
        return $this->organizador->alterar($param);
    }

    protected function excluir($param,$param2){
        // Passa dados do formulário (via GET) para a classe Cliente
        $this->organizador->setEmail((isset($this->visao["email"]) && $this->visao["email"] != null) ? $this->visao["email"] : "");
        //Chama o método para excluir os dados no banco de dados
        return $this->organizador->excluir($param,$param2);
    }
    
    protected function listarTodos($param=null, $param2){
        
        //Chama o método para listar os clientes do banco de dados de acordo com um filtro
        return $this->organizador->listarTodos($param, $param2);
    }
    
    protected function listarUnico($param){
        
        
        //Chama o método para listar um cliente específico do banco de dados
        return $this->organizador->listarUnico($param);
    }

    protected function listarUltimo($param){
        
        
        //Chama o método para listar um cliente específico do banco de dados
        return $this->organizador->listarUltimo($param);
    }
}