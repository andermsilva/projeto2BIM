<?php 
 namespace  App\Controllers;
 use App\Models\DAO\ProdutoDAO;

 class HomeController extends Controller{

    public function index(){

        $produto = new ProdutoDAO();

        self::setViewParam("listaProdutos", $produto->listar());



        $this->render("home/index");
    }
 }
?>