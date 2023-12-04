<?php

namespace App\Models\DAO;

use App\Models\Entidades\Usuario;

class UsuarioDAO extends BaseDAO
{

    public function getById($id)
    {
        $resultado = $this->select("SELECT * FROM usuario WHERE id = $id;");
        //var_dump($resultado);exit;

        return $resultado->fetchObject(Usuario::class);
    }

    public function autenticar($email, $password)
    {
        $usuario = "";

        try {

            $query = $this->select("SELECT * FROM usuario WHERE email = '$email'");


            $usuario = $query->fetchObject(Usuario::class);

            if (!$usuario) {
                return 0;
            }

            if (!password_verify($password, $usuario->getSenha())) {
                return 0;
            }

            return $usuario;
        } catch (\Exception $e) {

            throw new \Exception("Erro no acesso aos dados.", 500);
        }
    }

    public  function Salvar(Usuario $usuario)
    {
        try {
            $tipo      = $usuario->getTipo();
            $nome      = $usuario->getNome();
            $cpf       = $usuario->getCpf();
            $datanasc  = $usuario->getDataNasc();
            $sexo      = $usuario->getSexo();
            $whats     = $usuario->getWhats();
            $email     = $usuario->getEmail();
            $password  = $usuario->getSenha();

            return $this->insert(
                'usuario',
                ":nome, :sexo, :dt_nasc, :tipo, :senha, :whatsapp, :email, :cpf",
                [
                    ':nome'     => $nome,
                    ':sexo'     => $sexo,
                    ':dt_nasc'  => $datanasc,
                    ':tipo'     => $tipo,
                    ':senha'    => $password,
                    ':whatsapp' => $whats,
                    ':email'    => $email,
                    ':cpf'      => $cpf
                ]
            );
        } catch (\Exception $e) {

            throw new \Exception("Erro na gravação de dados.", 500);
        }
    }

    public function atualizar(Usuario $usuario)
    {
        try {

            $id         = $usuario->getId();
            $tipo      = $usuario->getTipo();
            $nome      = $usuario->getNome();
            $cpf       = $usuario->getCpf();
            $datanasc  = $usuario->getDataNasc();
            $sexo      = $usuario->getSexo();
            $whats     = $usuario->getWhats();
            $email     = $usuario->getEmail();
            $password  = $usuario->getSenha();

            return $this->update(
                'usuario',
                "nome = :nome, sexo = :sexo, dt_nasc = :dt_nasc, tipo = :tipo, senha = :senha, whatsapp = :whatsapp, email = :email, cpf = :cpf",
                [
                    ':id'       => $id,
                    ':nome'     => $nome,
                    ':sexo'     => $sexo,
                    ':dt_nasc'  => $datanasc,
                    ':tipo'     => $tipo,
                    ':senha'    => $password,
                    ':whatsapp' => $whats,
                    ':email'    => $email,
                    ':cpf'      => $cpf                    
                ],
                "id = :id"
            );
        } catch (\Exception $e) {
            throw new \Exception("Erro na atualização dos dados." . $e->getMessage(), 500);
        }
    }

    public function atualizarPassword(Usuario $usuario)
    {
        try {

            $id         = $usuario->getId();
            $password   = $usuario->getSenha();

            return $this->update(
                'usuario',
                "senha = :senha",

                [
                    ':id'       => $id,
                    ':senha' => $password
                ],
                "id = :id"
            );
        } catch (\Exception $e) {
            throw new \Exception("Erro na atualização dos dados." . $e->getMessage(), 500);
        }
    }

    public function verificaUsuario($email)
    {
        try {

            $query = $this->select(
                "SELECT * FROM usuario WHERE email = '$email'"
            );
            return $query->fetch();

        }catch (\Exception $e){
            throw new \Exception("Erro no acesso aos dados.", 500);
        }
    }
}
