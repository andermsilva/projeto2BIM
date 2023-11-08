<?php 
namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\UsuarioDAO;

class LoginController extends Controller{

    public function index(){

        $this->render("login/index");
        Sessao::limpaMensagem();
    }

    public function autentica() 
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

       // var_dump($_POST); exit;
        Sessao::gravaFormulario($_POST);

        if(empty(trim($username)) && empty(trim($password))){
            $erro[] = "Faltou digitar usuário e/ou senha!";
            Sessao::gravaErro($erro);
            $this->redirect('/login');
        }
        $usuarioDAO = new UsuarioDAO();
        $usuario = $usuarioDAO->autenticar($username, $password);

        if ($usuario->getId() == 0) {
            $erro[] = "Usuário ou senha incorretos. Tente novamente!";
            Sessao::gravaErro($erro);
            $this->redirect('/login');
        }
       
        Sessao::gravaLogin($usuario->getId(),$usuario->getNome());

        Sessao::limpaFormulario();
        Sessao::limpaErro();

        Sessao::gravaMensagem("Usuário logado com sucesso!");

        $this->redirect('/login/dashboard');

        Sessao::limpaMensagem();
    }

    public function logout() 
    {
        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        $_SESSION["loggedin"] = false;
        unset($_SESSION['username']);

        $this->redirect('/home');
    }
}



?>