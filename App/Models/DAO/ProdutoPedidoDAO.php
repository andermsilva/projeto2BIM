<?php 
 namespace App\Models\DAO;
use App\Models\DAO\BaseDAO;
 class ProdutoPedidoDAO extends BaseDAO{

    public function listaProdutoPedidoById($ped_num){

       $resultado =  $this->select("SELECT count(*) as teste
       
        FROM produto_has_pedido pp inner join pedido p
                on pp.pedido_ped_num = p.ped_num
         where p.ped_num = {$ped_num};");
     
       $dataLista = $resultado->fetchAll();
        return $dataLista;

    }

    
 }
?>