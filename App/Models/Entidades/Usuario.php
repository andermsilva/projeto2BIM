<?php 
namespace App\Models\Entidades;

class Usuario{


    private int $id;
    private string $tipo;
    private string $nome;
    private string $cpf;
    private string $dt_nasc;
    private string $sexo;
    private string $whatsapp;
    private string $email;
    private string $senha;
    
   
    public function getId()
    {
        return $this->id;
    }

    
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function setCpf($cpf) {
        return $this->cpf = $cpf;
    }

    public function getCpf() {
        return $this->cpf;
    }

    public function setDataNasc($dataNasc) {
        return $this->dt_nasc = $dataNasc;
    }

    public function getDataNasc() {
        return $this->dt_nasc;
    }

    public function setSexo($sexo) {
        return $this->sexo = $sexo;
    }

    public function getSexo() {
        return $this->sexo;
    }
    
    public function setWhats($whats) {
        return $this->whatsapp = $whats;
    }

    public function getWhats() {
        return $this->whatsapp;
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

   
    public function getEmail()
    {
        return $this->email;
    }

   
    public function setEmail($email)
    {
        $this->email = $email;

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