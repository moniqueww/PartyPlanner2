<?php


class ControleEventoArtista extends ControleBase {
    private $visao;
    private $eventoArtista;
    
    public function getVisao() {
        return $this->visao;
    }

   
    public function setVisao($visao) {
        $this->visao = $visao;
    }

    
    public function __construct() {
        //Cria uma instância da classe Produto
        $this->eventoArtista = new EventoArtista();
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
        $this->eventoArtista->setId((isset($this->visao["id"]) && $this->visao["id"] != null) ? $this->visao["id"] : "");
        $this->eventoArtista->setIdEvento((isset($this->visao["idEvento"]) && $this->visao["idEvento"] != null) ? $this->visao["idEvento"] : "");
        $this->eventoArtista->setIdServico((isset($this->visao["idServico"]) && $this->visao["idServico"] != null) ? $this->visao["idServico"] : "");     
    }
    
    protected function inserir() {
        // Passa dados do formulário para a classe Produto
        $this->preencheModelo();
        //Chama o método para inserir os dados no banco de dados
        return $this->eventoArtista->inserir();
    }
    
    protected function alterar($param) {
        // Passa dados do formulário para a classe Produto
        $this->preencheModelo();
        //Chama o método para alterar os dados no banco de dados
        return $this->eventoArtista->alterar($param);
    }

    protected function excluir($param, $param2){
        // Passa dados do formulário (via GET) para a classe Produto
        $this->eventoArtista->setId((isset($this->visao["id"]) && $this->visao["id"] != null) ? $this->visao["id"] : "");
        //Chama o método para excluir os dados no banco de dados
        return $this->eventoArtista->excluir($param,$param2);
    }
    
    protected function listarTodos($param=null, $param2){
        
        //Chama o método para listar os produtos do banco de dados de acordo com um filtro
        return $this->eventoArtista->listarTodos($param, $param2);
    }
    
    protected function listarUnico($param){
        
        
        //Chama o método para listar um produto específico do banco de dados
        return $this->eventoArtista->listarUnico($param);
    }

    protected function listarUltimo($param){
        
        
        //Chama o método para listar um produto específico do banco de dados
        return $this->eventoArtista->listarUltimo($param);
    }
}