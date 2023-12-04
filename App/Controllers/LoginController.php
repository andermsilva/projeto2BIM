<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\UsuarioDAO;
use App\Models\DAO\EnderecoDAO;

class LoginController extends Controller
{

    public function index()
    {

        Sessao::limpaMensagem();
        //  Sessao::limpaErro();
        $this->render("login/index");
    }

    public function autentica()
    {

        $username = $_POST['username'];
        $password = $_POST['password'];

        // var_dump($_POST); exit;
        Sessao::gravaFormulario($_POST);

        if (empty(trim($username)) || empty(trim($password))) {

            $erro[] = "Faltou digitar usuário e/ou senha!";
            Sessao::gravaErro($erro);
            $this->redirect('/login');
        }
        $usuarioDAO = new UsuarioDAO();
        $usuario = $usuarioDAO->autenticar($username, $password);

        // var_dump($usuario);exit;

        /*   $id = $usuario->getId(); */

        if ($usuario == 0) {

            $erro[] = "Usuário ou senha incorretos. Tente novamente!";
            Sessao::gravaErro($erro);
            $this->redirect('/login');
        }
        /*   $end = new EnderecoDAO();
        //  var_dump($end);exit;
          Sessao::gravaEndereco( $end->getByIdUser($id));
 */
        Sessao::gravaLogin($usuario->getId(), $usuario->getNome(), $usuario->getTipo());

        Sessao::limpaFormulario();
        Sessao::limpaErro();

        Sessao::gravaMensagem("Usuário logado com sucesso!");

        if ($_SESSION["tipo"] == "admin") {

            $this->redirect('/login/dashboard');
        } else {

            $this->redirect('/home');
        }

        $this->redirect('/login/dashboad');

        Sessao::limpaMensagem();
    }

    public function dashboard()
    {

        $this->render('login/dashboard');
    }

    public function logout()
    {
        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        unset($_SESSION["endereco"]);
        $_SESSION["loggedin"] = false;
        $_SESSION['tipo'] = false;
        unset($_SESSION['username']);

        $this->redirect('/home');
    }

    public function reset()
    {
        $id = $_SESSION['iduser'];

        $usuarioDAO = new UsuarioDAO();

        $usuario = $usuarioDAO->getById($id);

        if (!$usuario) {
            Sessao::gravaMensagem("Usuário inexistente");
            $this->redirect('/login/dashboard');
        }
 
        self::setViewParam('usuario', $usuario);

        $this->render('login/resetpassword');

        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }
}
