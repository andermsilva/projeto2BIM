<?php

namespace App\Models\DAO;

use App\Models\DAO\BaseDAO;
use App\Models\DAO\ProdutoPedidoDAO;
use App\Models\DAO\PagamentoDAO;
use App\Models\Entidades\Pedido;
use App\Models\Entidades\Produto;
use App\Models\Entidades\ProdutoPedido;
use APP\Models\Entidades\TipoPagamento;

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
            'contagem' => $result

         ];

      }
   }

   public function salvar(Pedido $pedido)
   {

      try {

         $pgto = $pedido->getTipoPagamento()->getCod();
         $cliId = $pedido->getUsuario()->getId();
         $valor = $pedido->getValor();
         $end = $pedido->getEndereco()->getEndCod();


         return $this->insert(
            'pedido',
            ":tipo_pgto_cod, :cliente_id,:valor_total,:end_cod",
            [
               ':tipo_pgto_cod' => $pgto,
               ':cliente_id' => $cliId,
               ':valor_total' => $valor,
               ':end_cod' => $end,

            ]
         );
      } catch (\Exception $e) {

         /* echo 'aqui5';
         echo '<hr>';
         var_dump($e->getMessage()); */

         //exit;
         throw new \Exception("Erro na gravação de dados." . $e->getMessage(), 500);
      }



   }


   public function salvarLista(ProdutoPedido $pedido)
   {

      try {

         $pcod = $pedido->getProduto()->getCodigo();
         $ppedNum = $pedido->getPedido()->getPed_num();
         $qtd = $pedido->getQtde();
         $total = $pedido->getSutotal();
         $preco = $pedido->getValorUnitario();


         return $this->insert(
            'produto_has_pedido',
            ":produto_codigo,:pedido_ped_num,:qtde,:valorUnitario,:subtotal",
            [
               ':produto_codigo' => $pcod,
               ':pedido_ped_num' => $ppedNum,
               ':qtde' => $qtd,
               ':valorUnitario' => $preco,
               ':subtotal' => $total

            ]
         );
      } catch (\Exception $e) {

         throw new \Exception("Erro na gravação de dados." . $e->getMessage(), 500);
      }



   }


   public function getAllTpgto()
   {
      $resultado = $this->select(
         "SELECT cod, nome FROM tipo_pagamento ORDER BY cod;"
      );

      $dataSetTipos = $resultado->fetchAll();



      $listaTipos = [];

      if ($dataSetTipos) {

         foreach ($dataSetTipos as $dataSetTipo) {



            $tipo = new TipoPagamento();

            $tipo->setCod($dataSetTipo['cod']);
            $tipo->setNome($dataSetTipo['nome']);

            $listaTipos[] = $tipo;
         }

      }

      return [

         'resultado' => $listaTipos
      ];
   }

   public function getById($id)
   {

      $resultado = $this->select("SELECT pr.imageurl as imagem, pr.codigo as cod, pr.nome,
            pr.peso, pd.qtde as qtd,pd.valorUnitario as preco,pd.subtotal as valor
            FROM pedido p inner join usuario u on p.cliente_id = u.id
            inner join produto_has_pedido pd on pd.pedido_ped_num = p.ped_num
            inner join produto pr on pr.codigo = pd.produto_codigo
      WHERE p.ped_num = $id; ");

      $dataSetPedidos = $resultado->fetchAll();


      $listaPedidos = [];

      if ($dataSetPedidos) {

         foreach ($dataSetPedidos as $dataSetPedido) {
            $aux =[];   
            $pedProd = new ProdutoPedido();
            $produto = new Produto();
            $pedido = new Pedido();
            
            $produto->setNome($dataSetPedido['nome']);
            $aux ['nome'] = $produto->getNome();   
            
            $produto->setCodigo($dataSetPedido['cod']);
            $aux ['cod'] = $produto->getCodigo();   

            $produto->setImageUrl($dataSetPedido['imagem']);
            $aux ['imagem'] = $produto->getImageUrl();  

            $produto->setPeso($dataSetPedido['peso']);
            $aux ['peso'] = $produto->getImageUrl();   
            
            $pedProd->setValorUnitario($dataSetPedido['preco']);
            $aux ['preco'] = $pedProd->getValorUnitario(); 

            $pedProd->setQtde($dataSetPedido['qtd']);
            $aux ['qtd'] = $pedProd->getQtde();  

            $pedProd->setSutotal($dataSetPedido['valor']);
            $aux ['valor'] = $pedProd->getSutotal();  

           
            $listaPedidos[] = $aux;
         }

      }

      return [

         'resultado' => $listaPedidos
      ];


   }


   public function pedidosNoPagos($id){

      $resultado = $this->select("SELECT count(*) as pendencias FROM pedido p
      inner join status_pedido s on s.status_id = p.status
      where p.cliente_id = $id and p.status = 2 ;"
    );

   $pendencias = $resultado->fetch()['pendencias'];

 
   return [
      'pendencias' => $pendencias
      
   ];

   }

}
?>