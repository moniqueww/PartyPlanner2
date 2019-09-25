<?php


class ControleFavorita extends ControleBase {
    private $visao;
    private $favorita;
    
    public function getVisao() {
        return $this->visao;
    }

   
    public function setVisao($visao) {
        $this->visao = $visao;
    }

    
    public function __construct() {
        //Cria uma instância da classe Produto
        $this->favorita = new Favorita();
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
        $this->favorita->setId((isset($this->visao["id"]) && $this->visao["id"] != null) ? $this->visao["id"] : "");
        $this->favorita->setidServico((isset($this->visao["idServico"]) && $this->visao["idServico"] != null) ? $this->visao["idServico"] : "");
        $this->favorita->setIdUsuario((isset($this->visao["idUsuario"]) && $this->visao["idUsuario"] != null) ? $this->visao["idUsuario"] : "");     
    }
    
    protected function inserir() {
        // Passa dados do formulário para a classe Produto
        $this->preencheModelo();
        //Chama o método para inserir os dados no banco de dados
        return $this->favorita->inserir();
    }
    
    protected function alterar($param) {
        // Passa dados do formulário para a classe Produto
        $this->preencheModelo();
        //Chama o método para alterar os dados no banco de dados
        return $this->favorita->alterar($param);
    }

    protected function excluir($param, $param2){
        // Passa dados do formulário (via GET) para a classe Produto
        $this->favorita->setId((isset($this->visao["id"]) && $this->visao["id"] != null) ? $this->visao["id"] : "");
        //Chama o método para excluir os dados no banco de dados
        return $this->favorita->excluir($param,$param2);
    }
    
    protected function listarTodos($param=null, $param2){
        
        //Chama o método para listar os produtos do banco de dados de acordo com um filtro
        return $this->favorita->listarTodos($param, $param2);
    }
    
    protected function listarUnico($param){
        
        
        //Chama o método para listar um produto específico do banco de dados
        return $this->favorita->listarUnico($param);
    }

    protected function listarUltimo($param){
        
        
        //Chama o método para listar um produto específico do banco de dados
        return $this->favorita->listarUltimo($param);
    }
}