<?php 
namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\UsuarioDAO;
use App\Models\Entidades\Usuario;
use App\Models\Validacao\UsuarioValidador;

class UsuarioController extends Controller{

    public function index(){
        
        $this->render("usuario/index");
    }

    public function cadastro()
    {
        $this->render('/usuario/cadastro');

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function register() {
        $this->render('usuario/register');
    }

    public function registrar() {
           
        $usuario = new Usuario();
        $usuario->setTipo($_POST['tipo']);
        $usuario->setNome($_POST['nome']);
        $usuario->setCpf($_POST['cpf']);
        $usuario->setDataNasc($_POST['datanasc']);
        $usuario->setSexo($_POST['sexo']);
        $usuario->setWhats($_POST['whats']);
        $usuario->setEmail($_POST['email']);
        $usuario->setSenha($_POST['password']);

        $usuarioDAO = new UsuarioDAO();

        $usuario->setSenha(password_hash($usuario->getSenha(), PASSWORD_DEFAULT));

        try {

            $usuarioDAO->Salvar($usuario);

        } catch (\Exception $e) {
            Sessao::gravaMensagem($e->getMessage());
            $this->redirect('/login');
        }

        Sessao::gravaMensagem("Faça seu login!");
        $this->redirect('/login/');

    }


    //

    public function edicao()
    {
        $id = $_SESSION['iduser'];

        $usuarioDAO = new UsuarioDAO();

        $user = $usuarioDAO->getById($id);

        
        $user->getId();
        $user->getNome();
        $user->getCpf();
        $user->getDataNasc();
        $user->getSexo();
        $user->getWhats();
        $user->getEmail();
        $user->getSenha();
        
        Self::setViewParam('usuario', $user);

        Sessao::gravaFormulario($user);

        $usuarioValidador = new UsuarioValidador();
        $resultadoValidacao = $usuarioValidador->validar($user);

        if($resultadoValidacao->getErros()){
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/usuario/edicao/' . $user->getId());
        }

        $erros = [];
        $usuarioDAO2 = new UsuarioDAO();

        $resultado  = $usuarioDAO2->verificaUsuario($user->getEmail());

        if($resultado && $resultado['id'] != $user->getId()) {
            $erros[] = "O email '{$user->getEmail()}' já está sendo utilizado!";
        }

        if ($erros) {
            Sessao::gravaErro($erros);
            $this->redirect('/usuario/edicao/' . $user->getId());
        }

     /*    try{
            
            $usuarioDAO2->atualizar($user);

        } catch (\Exception $e) {
            Sessao::gravaMensagem($e->getMessage());
            $this->redirect('/usuario/edicao/');
        } */

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        Sessao::gravaMensagem("Usuário atualizado com sucesso!");

        $this->render('usuario/editar');
    }

    // resetar senha

    public function resetarpassword() {
        $this->render('login/reset-password');
    }
    public function resetPassword()
    {
        $usuario = new Usuario();

        $usuario->setId($_POST['id']);
        $password = $_POST['password'];
        $password_confirm = $_POST['password_confirm'];

        Sessao::gravaFormulario($_POST);

        $erros = [];
        $usuarioDAO = new UsuarioDAO();

        if ($password !== $password_confirm) {
            $erros[] = "As senhas digitadas não coincidem!";
        }

        if ($erros) {
            Sessao::gravaErro($erros);
            $this->redirect('/login/reset-password' . $usuario->getId());
        }

        try{

            $usuario->setSenha(password_hash($password, PASSWORD_DEFAULT));
            $usuarioDAO->atualizarPassword($usuario);

        } catch (\Exception $e) {
            Sessao::gravaMensagem($e->getMessage());
            $this->redirect('/login/dashboard');
        }

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        Sessao::gravaMensagem("Usuário atualizado com sucesso!");

        $this->render('/login/dashboard');
    }

    public function atualizar(){

      //  var_dump($_POST);
        
        $usuario = new Usuario();

        $usuario->setId($_POST['id']);
        $usuario->setNome($_POST['nome']);
        $usuario->setSexo($_POST['sexo']);
        $usuario->setWhats($_POST['whats']);
        $usuario->setCpf($_POST['cpf']);
        $usuario->setDataNasc($_POST['datanasc']);
        $usuario->setSenha($_POST['password']);
        $usuario->setTipo("user");
       
        $usuario->setEmail($_POST['email']);
       

        Sessao::gravaFormulario($_POST);
 
        $usuarioValidador = new UsuarioValidador();
        $resultadoValidacao = $usuarioValidador->validar($usuario);

        if ($resultadoValidacao->getErros()) {
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/usuario/edicao/' . $_POST['cod']);
        }

        try {

          //  var_dump($usuario);
            //exit;
            $usuarioDAO = new UsuarioDAO();
            $usuarioDAO->atualizar($usuario);

        } catch (\Exception $e) {
            Sessao::gravaMensagem($e->getMessage());
            $this->redirect('/usuario');
        }

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        Sessao::gravaMensagem("Produto atualizado com sucesso!");

        $this->redirect('/login/dashborad'); 
    }

}

?>