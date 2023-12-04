<?php 
namespace App\Controllers;

use App\Models\DAO\SobreNosDAO;
use App\Models\Entidades\SobreNos;

class SobreNosController extends Controller
{
    public function index(){
        $sobre = new SobreNosDAO();
        $sobre = $sobre->mostrar(40);
      /*   var_dump($sobre); */
        self::setViewParam("nos", $sobre);
        $this->render("sobrenos/index");
    }
}




