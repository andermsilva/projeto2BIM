<?php 
 namespace  App\Controllers;
 use App\Models\DAO\ProdutoDAO;

 class HomeController extends Controller{

    public function index(){

        $produtos = new ProdutoDAO();

        self::setViewParam("listaProdutos", $produtos->listar());



        $this->render("home/index");
    }
 }
?>