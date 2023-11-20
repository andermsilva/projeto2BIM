<?php

namespace App\Models\DAO;

use App\Models\DAO\BaseDAO;
use App\Models\DAO\ProdutoPedidoDAO;;
use App\Models\Entidades\Pedido;
use App\Models\Entidades\ProdutoPedido;

class PedidoDAO extends BaseDAO
{

   public function listaPaginacao($busca = null, $totalPorPagina = 6, $paginaSelecionada = 1)
   {

      $inicio = (($paginaSelecionada - 1) * $totalPorPagina);

      $whereBusca = ($busca) ? "AND (p.ped_data = '$busca' " : '';

      $resultadoTotal = $this->select(
         "SELECT count(*) as total 
        FROM pedido p inner join usuario u on p.cliente_id = u.id 
        WHERE u.id = " . $_SESSION['iduser'] . ";"
      );


      $resultado = $this->select("SELECT p.ped_num as pnum, pg.nome as pgto,
                     p.cliente_id,p.ped_data, p.valor_total, p.end_cod,p.status
          FROM pedido p inner join usuario u on p.cliente_id = u.id
          inner join tipo_pagamento pg on pg.cod = tipo_pgto_cod
        
          WHERE u.id = {$_SESSION['iduser']} LIMIT {$inicio}, {$totalPorPagina};");
     // var_dump($resultado);exit;
     
      $dataSetPedidos = $resultado->fetchAll();
      $totalLinhas = $resultadoTotal->fetch()['total'];

      $listaPedidos = [];


      if ($dataSetPedidos) {

         foreach ($dataSetPedidos as $dataSetPedido) {

          $produtoPedido = new ProdutoPedido();
          $prodPed = new ProdutoPedidoDAO();

          
           $result = $prodPed->listaProdutoPedidoById($dataSetPedido['pnum']); 

           $qtde = $result[0]['teste'];
         
           // $resultado->fetch();

            $pedido = new Pedido();
            $pedido->setPed_num($dataSetPedido['pnum']);
            $pedido->getTipoPagamento()->setNome($dataSetPedido['pgto']);
            //$pedido->getUsuario()->setId($dataSetPedido['cliente_id']);
            $pedido->getUsuario()->setId($dataSetPedido['cliente_id']);
            $pedido->setData($dataSetPedido['ped_data']);
            $pedido->getEndereco()->setEndCod($dataSetPedido['end_cod']);
            $pedido->getStatus()->setStatus($dataSetPedido['status']);
            $pedido->setProdutos($qtde);
            $pedido->setValor($dataSetPedido['valor_total']);

            $listaPedidos[] = $pedido;

         }
        // var_dump($listaPedidos);exit;
         return [
            'paginaSelecionada' => $paginaSelecionada,
            'totalPorPagina' => $totalPorPagina,
            'totalLinhas' => $totalLinhas,
            'resultado' => $listaPedidos,
            'contagem' =>$result
             
         ];

      }
   }

   public function salvar(Pedido $pedido){

   try {

     $pgto = $pedido->getTipoPagamento()->getCod();
     $cliId = $pedido->getUsuario()->getId();
     $valor = $pedido->getValor();
     $end = $pedido->getEndereco()->getEndCod();
     
     
     return $this->insert(
          'pedido',
          ":tipo_pgto_cod, cliente_id,:valor_total,:end_cod",
          [
            ':tipo_pgto_cod' => $pgto,
            ':cliente_id' => $cliId,
            ':valor_total'=> $valor,
            ':end_cod'=> $end,
           
          ]
      );
  } catch (\Exception $e) {

      throw new \Exception("Erro na gravação de dados." . $e->getMessage(), 500);
  }



   }
}
?>