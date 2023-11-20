<?php 

  namespace App\Models\Entidades;

  class Endereco{

    private int $endCod;
    private Usuario $usuario;
    private string $cep;
    private string $logradouro;
    private string $numero;
    private string $complemento;
    private string $cidade;
    private string $bairro;


    public function __construct() {

        $this->usuario = new Usuario();
    }
    
    public function getUsuario()
    {
        return $this->usuario;
    }

    
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;

        return $this;
    }

    
    public function getEndCod()
    {
        return $this->endCod;
    }

    
    public function setEndCod($endCod)
    {
        $this->endCod = $endCod;

        return $this;
    }

    
    public function getCep()
    {
        return $this->cep;
    }

    
    public function setCep($cep)
    {
        $this->cep = $cep;

        return $this;
    }

   
    public function getLogradouro()
    {
        return $this->logradouro;
    }

    
    public function setLogradouro($logradouro)
    {
        $this->logradouro = $logradouro;

        return $this;
    }

    
    public function getNumero()
    {
        return $this->numero;
    }

   
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    
    public function getComplemento()
    {
        return $this->complemento;
    }

    public function setComplemento($complemento)
    {
        $this->complemento = $complemento;

        return $this;
    }

   
    public function getBairro()
    {
        return $this->bairro;
    }

    
    public function setBairro($bairro)
    {
        $this->bairro = $bairro;

        return $this;
    }

   
    public function getCidade()
    {
        return $this->cidade;
    }

    public function setCidade($cidade)
    {
        $this->cidade = $cidade;

        return $this;
    }
  }
?>