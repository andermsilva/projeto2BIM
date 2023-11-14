<?php 
  namespace App\Controllers;
  use App\Models\DAO\TipoProdutoDAO;
  use App\Models\Entidades\TipoProduto;


  class TipoProdutoController extends Controller{

    public function index(){

      $tipoDAO = new TipoProdutoDAO(); 

      $listaTiposProduto = $tipoDAO->listar();

      self::setViewParam("listaTipos", $listaTiposProduto);

        
      $this->render("tipoproduto/index");



    }


    public function cadastro(){

      $tipoDAO = new TipoProdutoDAO();
      self::setViewParam("listaTipo", $tipoDAO->listar());
      $this->render("tipoproduto/cadastro");
    }

    
  }
 
?>