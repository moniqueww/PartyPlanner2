<?php


class ControleServico extends ControleBase {
    private $visao;
    private $servico;
    
    public function getVisao() {
        return $this->visao;
    }

   
    public function setVisao($visao) {
        $this->visao = $visao;
    }

    
    public function __construct() {
        //Cria uma instância da classe Produto
        $this->servico = new Servico();
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
        // Passa dados do formulário para a classe Produto
        $this->servico->setNome((isset($this->visao["nome"]) && $this->visao["nome"] != null) ? $this->visao["nome"] : "");
        $this->servico->setEmail((isset($this->visao["email"]) && $this->visao["email"] != null) ? $this->visao["email"] : "");
        $this->servico->setTelefone((isset($this->visao["telefone"]) && $this->visao["telefone"] != null) ? $this->visao["telefone"] : "");
        $this->servico->setCnpj((isset($this->visao["cnpj"]) && $this->visao["cnpj"] != null) ? $this->visao["cnpj"] : "");
        $this->servico->setSenha((isset($this->visao["senha"]) && $this->visao["senha"] != null) ? $this->visao["senha"] : "");
        $this->servico->setTipo((isset($this->visao["tipo"]) && $this->visao["tipo"] != null) ? $this->visao["tipo"] : "");
        $this->servico->setIdCategoria((isset($this->visao["idCategoria"]) && $this->visao["idCategoria"] != null) ? $this->visao["idCategoria"] : "");
        $this->servico->setId((isset($this->visao["id"]) && $this->visao["id"] != null) ? $this->visao["id"] : "");
    }
    
    protected function inserir() {
        // Passa dados do formulário para a classe Produto
        $this->preencheModelo();
        //Chama o método para inserir os dados no banco de dados
        return $this->servico->inserir();
    }
    
    protected function alterar($param) {
        // Passa dados do formulário para a classe Produto
        $this->preencheModelo();
        //Chama o método para alterar os dados no banco de dados
        return $this->servico->alterar($param);
    }

    protected function excluir($param, $param2){
        // Passa dados do formulário (via GET) para a classe Produto
        $this->servico->setId((isset($this->visao["id"]) && $this->visao["id"] != null) ? $this->visao["id"] : "");
        //Chama o método para excluir os dados no banco de dados
        return $this->servico->excluir($param,$param2);
    }
    
    protected function listarTodos($param=null, $param2){
        
        //Chama o método para listar os produtos do banco de dados de acordo com um filtro
        return $this->servico->listarTodos($param, $param2);
    }
    
    protected function listarUnico($param){
        
        
        //Chama o método para listar um produto específico do banco de dados
        return $this->servico->listarUnico($param);
    }

    protected function listarUltimo($param){
        
        
        //Chama o método para listar um produto específico do banco de dados
        return $this->servico->listarUltimo($param);
    }
}