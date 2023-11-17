<?php 

namespace App\Lib;


class Sessao{

    public static function gravaLogin($iduser, $username,$tp){
        $_SESSION['loggedin'] = true;
        $_SESSION['iduser'] = $iduser;
        $_SESSION['username'] = $username;
        $_SESSION['tipo'] =$tp;
    }
    
    public static function limpaLogin(){
        $_SESSION['loggedin'] = false;
        $_SESSION['tipo'] = false;
        unset($_SESSION['iduser']);
        unset($_SESSION['username']);       
    }

    public static function gravaMensagem($mensagem){
        $_SESSION['mensagem'] = $mensagem;
    }

    public static function limpaMensagem(){
        unset($_SESSION['mensagem']);
    }

    public static function retornaMensagem(){
        return (isset($_SESSION['mensagem'])) ? $_SESSION['mensagem'] : "";
    }

    public static function gravaFormulario($form){
        $_SESSION['form'] = $form;
    }

    public static function limpaFormulario(){
        unset($_SESSION['form']);
    }

    public static function retornaValorFormulario($key){
        return (isset($_SESSION['form'][$key])) ? $_SESSION['form'][$key] : "";
    }

    public static function existeFormulario(){
        return (isset($_SESSION['form'])) ? $_SESSION['form'] : "";
    }

    public static function gravaErro($erros){
        $_SESSION['erro'] = $erros;
    }

    public static function retornaErro(){
       return (isset($_SESSION['erro'])) ? $_SESSION['erro'] : false;
    }

    public static function limpaErro(){
        unset($_SESSION['erro']);
    }

    public static function GravarCarrinho($array){
      
        $aux = [];
        if (empty($_SESSION['carrinho'])) {
            $_SESSION['carrinho'] = [];
        }
        $aux = $array;
      //  var_dump( $_SESSION['carrinho']);exit;
        $test = false;
        foreach ($_SESSION['carrinho'] as $key => $value) {
            if (isset($value[0])) {
                 
                if ($value[0] == $array[0]) {
                    $_SESSION['carrinho'][$key][1] += $array[1];
                    $test = true;
                }
            }
        }
        if(!$test){
          array_push($_SESSION['carrinho'], $aux);
        }
       // header("Location: cardapio.php");

    }

    public static function retornarCarrinho() {

    return isset($_SESSION['carrinho']) ? $_SESSION['carrinho'] : false;
    }
    public static function limparCarrinho() {
        unset($_SESSION['carrinho']);
        unset($_POST['']);
    }
}
?>