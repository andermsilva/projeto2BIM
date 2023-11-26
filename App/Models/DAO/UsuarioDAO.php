<?php 
  namespace App\Models\DAO;
  use App\Models\Entidades\Usuario;

  class UsuarioDAO extends BaseDAO {

     public function getById( $id) {
        $resulatado = $this->select("SELECT * FROM usuario WHERE id = $id;");

        return $resulatado->fetchObject(Usuario::class);

     }

     public function autenticar($username, $password)
    {
      $usuario ="";

        try {

            $query = $this->select(
                "SELECT * FROM usuario WHERE email = '$username'"
            );

            
            $usuario = $query->fetchObject(Usuario::class);

            if(!$usuario) { 
                return 0; 
            }

            if(!password_verify($password, $usuario->getSenha())) { 
                return 0; 
            }

            return $usuario;            

        }catch (\Exception $e){
         
            throw new \Exception("Erro no acesso aos dados.", 500);
        }
    }

  }

?>