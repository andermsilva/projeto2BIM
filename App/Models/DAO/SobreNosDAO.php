<?php 
  namespace App\Models\DAO;
  use App\Models\Entidades\SobreNos;
 

  class SobreNosDAO extends BaseDAO  {

    public function mostrar($id)
    {

      
      $resultado = $this->select("SELECT real_id, fundacao, de_onde_viemos,porque_cidade,curiosidades FROM  historia where real_id= $id ; ");
     /*  var_dump(reset($resultado));exit; */


        return $resultado->fetchObject(SobreNos::class);
    }

     




  }





?>


            
            


