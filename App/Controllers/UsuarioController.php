<?php 
namespace App\Controllers;
use App\Models\DAO\UsuarioDAO;

class UsuarioController extends Controller{

    public function index(){
        
        $this->render("usuario/index");
    }
}

?>