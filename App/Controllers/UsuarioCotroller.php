<?php 
namespace App\Controllers;
use App\Models\DAO\UsuarioDAO;

class UsuarioController extends Controller{

    public function index(){
        echo "aqui";exit;
        $usuario = new UsuarioDAO();

        $this->render("usuario/index");
    }
}

?>