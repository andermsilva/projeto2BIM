<?php
namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\TipoProdutoDAO;
use App\Models\Entidades\TipoProduto;


class TipoProdutoController extends Controller
{

  public function index()
  {
   
    $tipoDAO = new TipoProdutoDAO();

    $listaTiposProduto = $tipoDAO->listar();

    self::setViewParam("listaTipos", $listaTiposProduto);


    $this->render("tipoproduto/index");



  }


  public function cadastro()
  {

    $this->render("tipoproduto/cadastro");
  }
  public function salvar()
  {

    $nome = $_POST['nome'];
    $tipo = new TipoProduto();

    $tipo->setTipo_nome($nome);

    Sessao::gravaFormulario($_POST);

    try {
      $tipoDAO = new TipoProdutoDAO();

      $tipoDAO->salvar($tipo);
     
      Sessao::gravaMensagem("Tipo de produto cadastrado com sucesso!");
      //$tipoDAO = new TipoProdutoDAO();

      $listaTiposProduto = $tipoDAO->listar();
  
      self::setViewParam("listaTipos", $listaTiposProduto);

      $this->render('tipoproduto/index');


    } catch (\Exception $e) {

      $this->redirect('/tipoproduto/cadastro');

    }

  }
}

?>