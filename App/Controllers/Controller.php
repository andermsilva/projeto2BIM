<?php
namespace App\Controllers;

use App\Lib\Sessao;

abstract class Controller
{

  protected $app;
  private $viewVar;

  public static function auth()
  {
      if (!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"]) {
          return false;
      }

      return true;
  }

  public function __construct($app)
  {
    $this->setViewParam("nameController", $app->getControllerName());


  }

  public function render($view)
  {
   //var_dump($view);exit;
    $viewVar = $this->getViewVar();
    $Sessao = Sessao::class;
     
    require_once PATH . '/App/Views/layouts/header.php';
    require_once PATH . '/App/Views/layouts/menu.php';
    require_once PATH . '/App/Views/' . $view . '.php';
    require_once PATH . '/App/Views/layouts/footer.php';
  }
  
  
  public function redirect($view)
  {
    //var_dump($view);exit;
    header('Location: http://' . APP_HOST . $view);
    exit;
  }
  public function getViewVar()
  {
    return $this->viewVar;
  }
  public function setViewParam($varName, $varValue)
  {
    
    if ($varName != "" && $varValue != "") {
      $this->viewVar[$varName] = $varValue;
    }
    
  }
}

?>