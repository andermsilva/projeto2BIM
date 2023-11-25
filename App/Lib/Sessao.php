<?php 

namespace App\Lib;


class Sessao{

    public static function gravaLogin($iduser, $username,$tp){
        $_SESSION['loggedin'] = true;
        $_SESSION['iduser'] = $iduser;
        $_SESSION['username'] = $username;
        $_SESSION['tipo'] =$tp;
    }
    
    public static function gravaEndereco($endereco){

        $_SESSION['endereco'] = $endereco;
    }
    public static function limpaLogin(){
        $_SESSION['loggedin'] = false;
        $_SESSION['tipo'] = false;
        unset($_SESSION['iduser']);
        unset($_SESSION['username']);       
    }

    public static function gravaMensagem($mensagem){

      //  echo "see".$mensagem;exit;
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


    public static function gravarListaPedidos($lista){
       $_SESSION['listaPedidos'] = $lista;
    

       $aux=[];

       foreach ($lista as $item) {
          foreach ($_SESSION['carrinho'] as $nova) {
            if ($item['cod']== $nova['cod']){

                $aux [] = $nova;
            }
          }
       }
       $_SESSION['carrinho'] = $aux;

    }
    public static function limparListaPedidos(){

        unset($_SESSION['listaPedidos']);
    }
    public static function GravarCarrinho($array){
      
        $aux = [];
        if (empty($_SESSION['carrinho'])) {
            $_SESSION['carrinho'] = [];
        }
        $aux = $array;
    
        $test = false;
        foreach ($_SESSION['carrinho'] as $key => $value) {
            if (isset($value['cod'])) {
                 
                if ($value['cod'] == $array['cod']) {
                    $_SESSION['carrinho'][$key]['qtd'] += $array['qtd'];
                    $test = true;
                }
            }
        }
       
        if(!$test){
          array_push($_SESSION['carrinho'], $aux);
        }

    }

    public static function retornarCarrinho() {

        return isset($_SESSION['carrinho']) ? $_SESSION['carrinho'] : false;
    }
    public static function retornarListaPedidos() {

        return isset($_SESSION['listaPedidos']) ? $_SESSION['listaPedidos'] : false;
    }
    public static function limparCarrinho() {
        unset($_SESSION['carrinho']);
        unset($_POST['']);
    }
   

    public static function gravarPedido($pedido) {
       $_SESSION['pedido'] = $pedido;

    }
    public static function retornarPedido() {
      return isset($_SESSION['pedido'])? $_SESSION['pedido']: false; 

    }
}
?>