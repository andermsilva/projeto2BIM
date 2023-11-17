<?php 
  namespace App\Models\DAO;

use App\Lib\Sessao;
use App\Models\Entidades\TipoProduto;
  use App\Models\DAO\BaseDAO;

  class TipoProdutoDAO extends BaseDAO {

    public function listar(){
        $resultado = $this->select("SELECT * FROM tipoproduto");
    
        return $resultado->fetchAll(\PDO::FETCH_CLASS, TipoProduto::class);
    
    
    }

    public function salvar(TipoProduto $tipo){

      try {

        $nome = $tipo->getTipo_nome();
       
       
        return $this->insert('tipoproduto',":tipo_nome",[':tipo_nome' => $nome ]);
    } catch (\Exception $e) {

        throw new \Exception("Erro na gravação de dados." . $e->getMessage(), 500);
    }

    }
  
  
  }
?>