<?php
namespace App\Controllers;

use App\Models\DAO\EnderecoDAO;

use App\Models\Entidades\Endereco;
use App\Models\Entidades\Produto;

use App\Lib\Sessao;


class EnderecoController extends Controller
{


    public function index()
    {

        if (!$this->auth())
            $this->redirect('/login');

        $endDAO = new EnderecoDAO();

        if ($_SESSION['tipo'] == 'admin') {

            $locais = $endDAO->listar();

            self::setViewParam("locais", $locais);
            $this->render("endereco/index");
            
        } else {
            $id = $_SESSION['iduser'];
            $enderecos = $endDAO->listarPorUsuario($id);
               

            if(!$enderecos){
               $this->render("endereco/cadastro");   
            }else{

                
                self::setViewParam('locais',$enderecos);
                $this->render("endereco/index");
            }
        }


    }


    public function gravar(){
        
        $end  = new Endereco();
        $endDAO = new EnderecoDAO();

        $end->setLogradouro($_POST['logradouro']);
        $end->setNumero($_POST['numero']);
        $end->setComplemento($_POST['comp']);
        $end->setBairro($_POST['bairro']);
        $end->setCep($_POST['cep']);
        $end->setCidade($_POST['cidade']);
        $end->getUsuario()->setId($_SESSION['iduser']);

        try{
            $result = $endDAO->salvar($end);
            $this->redirect("/endereco/index");
        }catch(\Exception $e){
            Sessao::gravaErro($e->getMessage());
        }


    }

   

    public function cadastro(){
        if (!$this->auth())
           $this->redirect('/login');
           $this->render("endereco/cadastro");  

    }

    public function excluir($params) {

        $endCod = $params[0];
        $endDAO = new EnderecoDAO();
        
        try{
            $endDAO->excluir($endCod);
            $this->redirect("/endereco/index");
        }catch(\Exception $e){
           
            Sessao::gravaErro("Erro ao excluir endereço... ". $e->getMessage());
        }
        
    }
}

?>