<?php
namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\ProdutoDAO;
use App\Models\Entidades\Produto;


class PedidoController extends Controller
{
    public function index()
    {

        $this->render("pedido/index");
    }


    public function carrinho()
    {
        $car = [];
        $car[0] = $_POST['cod'];
        $car[1] = $_POST['qtd'];
        $car[2] = $_POST['preco'];
        Sessao::GravarCarrinho($car);

        $this->redirect('/produto');

    }

    public function carrpedido()
    {
        if(isset($_SESSION['carrinho'])){

       
        $arr = Sessao::retornarCarrinho();
        $produtoDAO = new ProdutoDAO();
        $arrProd = [];
        foreach ($arr as $prod) {
            
            $produto = $produtoDAO->getById($prod[0]);
            $arrProd [] = $produto;

        }
    }
        $this->render('carrinho/index');
    }

    public function esvaziar()
    {
        Sessao::limparCarrinho();
        $this->redirect('/home');
    }
}
?>