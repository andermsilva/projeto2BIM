<?php 
  namespace App\Models\DAO;

  use App\Models\Entidades\TipoProduto;
  use App\Models\DAO\BaseDAO;

  class TipoProdutoDAO extends BaseDAO {

    public function listar(){
        $resultado = $this->select("SELECT * FROM tipoproduto");
    
        return $resultado->fetchAll(\PDO::FETCH_CLASS, TipoProduto::class);
    
    
    }
  }
?>