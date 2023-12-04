<?php

namespace App\Models\Validacao;

use \App\Models\Validacao\ResultadoValidacao;
use \App\Models\Entidades\Usuario;

class UsuarioValidador{

    public function validar(Usuario $usuario)
    {
        $resultadoValidacao = new ResultadoValidacao();

        if(empty($usuario->getNome()))
        {
            $resultadoValidacao->addErro('nome',"Nome: Este campo não pode ser vazio.");
        }

        if(empty($usuario->getEmail()))
        {
            $resultadoValidacao->addErro('email',"E-Mail: Este campo não pode ser vazio.");
        }

        if(empty($usuario->getCpf()))
        {
            $resultadoValidacao->addErro('cpf',"CPF: Este campo não pode ser vazio");
        }

        if(empty($usuario->getDataNasc()))
        {
            $resultadoValidacao->addErro('datanasc',"Data de Nascimento: Este campo não pode ser vazio");
        }

        if(empty($usuario->getSexo()))
        {
            $resultadoValidacao->addErro('sexo',"Sexo: Este campo não pode ser vazio");
        }

        if(empty($usuario->getWhats()))
        {
            $resultadoValidacao->addErro('whats',"WhatsApp: Este campo não pode ser vazio");
        }

        if(empty($usuario->getSenha()))
        {
            $resultadoValidacao->addErro('password',"Senha: Este campo não pode ser vazio");
        }


        return $resultadoValidacao;
    }
}