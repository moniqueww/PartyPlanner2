<?php


class ControleEventoPreco extends ControleBase {
    private $visao;
    private $eventoPreco;
    
    public function getVisao() {
        return $this->visao;
    }

   
    public function setVisao($visao) {
        $this->visao = $visao;
    }

    
    public function __construct() {
        //Cria uma instância da classe Produto
        $this->eventoPreco = new EventoPreco();
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
        $this->eventoPreco->setId((isset($this->visao["id"]) && $this->visao["id"] != null) ? $this->visao["id"] : "");
        $this->eventoPreco->setIdEvento((isset($this->visao["idEvento"]) && $this->visao["idEvento"] != null) ? $this->visao["idEvento"] : "");
        $this->eventoPreco->setValor((isset($this->visao["valor"]) && $this->visao["valor"] != null) ? $this->visao["valor"] : "");
        $this->eventoPreco->setNome((isset($this->visao["nome"]) && $this->visao["nome"] != null) ? $this->visao["nome"] : "");
        $this->eventoPreco->setDescricao((isset($this->visao["descricao"]) && $this->visao["descricao"] != null) ? $this->visao["descricao"] : "");     
    }
    
    protected function inserir() {
        // Passa dados do formulário para a classe Produto
        $this->preencheModelo();
        //Chama o método para inserir os dados no banco de dados
        return $this->eventoPreco->inserir();
    }
    
    protected function alterar($param) {
        // Passa dados do formulário para a classe Produto
        $this->preencheModelo();
        //Chama o método para alterar os dados no banco de dados
        return $this->eventoPreco->alterar($param);
    }

    protected function excluir($param, $param2){
        // Passa dados do formulário (via GET) para a classe Produto
        $this->eventoPreco->setId((isset($this->visao["id"]) && $this->visao["id"] != null) ? $this->visao["id"] : "");
        //Chama o método para excluir os dados no banco de dados
        return $this->eventoPreco->excluir($param,$param2);
    }
    
    protected function listarTodos($param=null, $param2){
        
        //Chama o método para listar os produtos do banco de dados de acordo com um filtro
        return $this->eventoPreco->listarTodos($param, $param2);
    }
    
    protected function listarUnico($param){
        
        
        //Chama o método para listar um produto específico do banco de dados
        return $this->eventoPreco->listarUnico($param);
    }

    protected function listarUltimo($param){
        
        
        //Chama o método para listar um produto específico do banco de dados
        return $this->eventoPreco->listarUltimo($param);
    }
}