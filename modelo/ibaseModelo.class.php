<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BaseModel
 *
 * @author Mauri
 */
interface ibaseModelo {
    public function inserir();
    public function alterar($param);
    public function excluir($param,$param2);
    public function listarTodos($param=null, $param2);
    public function listarUnico($param);
    public function listarUltimo($param);
}
