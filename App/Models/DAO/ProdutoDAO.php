<?php 

namespace App\Models\DAO;

use App\Models\Entidades\Produto;
use App\Models\DAO\BaseDAO;

class ProdutoDAO extends BaseDAO{
public function listar(){
    $resultado = $this->select("SELECT * FROM produto");

    return $resultado->fetchAll(\PDO::FETCH_CLASS, Produto::class);


}

}




?>