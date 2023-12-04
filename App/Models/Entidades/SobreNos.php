<?php 

namespace App\Models\Entidades;


class SobreNos{
    private int $real_id;
    private string $fundacao;
    private string $de_onde_viemos;
    private string $porque_cidade;
    private string $curiosidades;
     

  public function getReal_id()
  {
    return $this->real_id;
  }


  public function setReal_id($real_id)
  {
    $this->real_id = $real_id;

  }
  public function getFundacao()
  {
    return $this->fundacao;
  }


  public function setFundacao($fundacao)
  {
    $this->fundacao = $fundacao;

  }
  public function getDe_onde_viemos()
  {
    return $this->de_onde_viemos;

  }
  public function setDe_onde_viemos($de_onde_viemos)
  {
    $this->de_onde_viemos = $de_onde_viemos;

  }
  public function getPorqueCidade()
  {
    return $this->porque_cidade;

  }
  public function setPorqueCidade($porque_cidade)
  {
    $this->porque_cidade = $porque_cidade;

  }
  public function getCuriosidades()
  {
    return $this->curiosidades;

  }
  public function setCuriosidades($curiosidades)
  {
    $this->curiosidades = $curiosidades;

  }
  
        
        
        
       

        


}







?>