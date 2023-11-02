<?php
namespace App\Models\Entidades;

use App\Models\Entidades\TipoProduto;

class Produto
{
  private int $codigo;
  private TipoProduto $tipoProduto;
  private string $nome;
  private string $descricao;
  private float $preco;
  private string $promo;
  private string $imageurl;
  private float $peso;
  private float $desconto=0;


public function __construct(){

  $this->tipoProduto = new TipoProduto();
}

  public function getCodigo()
  {
    return $this->codigo;
  }


  public function setCodigo($codigo)
  {
    $this->codigo = $codigo;

  }

 
  public function getPreco()
  {
    return $this->preco;
  }


  public function setPreco($preco)
  {
    $this->preco = $preco;

 
  }

 
  public function getPromo()
  {
    return $this->promo;
  }

 
  public function setPromo($promo)
  {
    $this->promo = $promo;

  }

 
  public function getImageUrl()
  {
    return $this->imageurl;
  }


  public function setImageUrl($imageurl)
  {
    $this->imageurl = $imageurl;


  }


  public function getPeso()
  {
    return $this->peso;
  }


  public function setPeso($peso)
  {
    $this->peso = $peso;


  }


  public function getDesconto()
  {
    return $this->desconto;
  }


  public function setDesconto($desconto)
  {
    $this->desconto = $desconto;


  }


  public function getDescricao()
  {
    return $this->descricao;
  }

  public function setDescricao($descricao)
  {
    $this->descricao = $descricao;


  }


  public function getNome()
  {
    return $this->nome;
  }

  public function setNome($nome)
  {
    $this->nome = $nome;

    return $this;
  }


  public function getTipoProduto()
  {
    return $this->tipoProduto;
  }

  public function setTipoProduto($tipoProduto)
  {
    $this->tipoProduto = $tipoProduto;


  }
}

?>