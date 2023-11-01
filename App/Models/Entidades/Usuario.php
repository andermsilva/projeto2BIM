<?php 
namespace App\Models\Entidades;

class Usuario{


    private int $id;
    private string $nome;
    private string $smail;
    private string $senha;
    private string $tipo;

   
    public function getId()
    {
        return $this->id;
    }

    
    public function setId($id)
    {
        $this->id = $id;

        return $this;
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

   
    public function getSmail()
    {
        return $this->smail;
    }

   
    public function setSmail($smail)
    {
        $this->smail = $smail;

        return $this;
    }

   
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * Set the value of senha
     *
     * @return  self
     */ 
    public function setSenha($senha)
    {
        $this->senha = $senha;

        return $this;
    }

    public function getTipo()
    {
        return $this->tipo;
    }

   
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }
}

?>