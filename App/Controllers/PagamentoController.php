<?php
namespace App\Controllers;

use App\Lib\Paginacao;
use App\Lib\Sessao;
use App\Models\DAO\EnderecoDAO;
use App\Models\DAO\PagamentoDAO;

use App\Models\Entidades\Endereco;
use App\Models\Entidades\TipoPagamento;

class PagamentoController extends Controller
{
    public function index()
    {
        Sessao::limpaErro();
        Sessao::limpaMensagem();
      
      $tipo = new TipoPagamento();
      $teste = new PagamentoDAO(); 
       
      $ende = new Endereco();
       
      $listaEnd = new EnderecoDAO();
    
      $vetor = $teste->getAll();

      $vetor1 = $listaEnd->listarPorUsuario($_SESSION['iduser']);
    
      self::setViewParam('result', $vetor1);

      self::setViewParam("tipos",$vetor['resultado'] );
                   
      $this->render("pagamento/index");

    }

public function verificar(){

   // $pedido = new P();
    $this->render("pagamento/verificar");

    
    
    exit;
}
   

}
?>