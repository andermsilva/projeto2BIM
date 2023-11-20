<?php 
namespace APP\Models\Entidades;


class TipoPagamento{
    private int $cod;
    private string $nome;

 
    public function getNome()
    {
        return $this->nome;
    }


    public function setNome($nome)
    {
        $this->nome = $nome;

       
    }

    public function getCod()
    {
        return $this->cod;
    }

  
    public function setCod($cod)
    {
        $this->cod = $cod;

       
    }
}
?>