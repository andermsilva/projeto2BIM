<?php
namespace App\Models\DAO;

use App\Lib\Conexao;

abstract class BaseDAO
{

    private $conexao;

    public function __construct()
    {
        $this->conexao = Conexao::getConnection();
    }

    public function select($sql)
    {

        /*   if($where){
              $sql = "select * from $sql  WHERE $where ";
              }else{
                  $sql = "select * from $sql";
              }
          */

        if (!empty($sql)) {

         // var_dump($sql);exit;
            return $this->conexao->query($sql);
        }
    }

    public function insert($table, $cols, $values)
    {



        if (!empty($table) && !empty($cols) && !empty($values)) {
            $parametros = $cols;
            $colunas = str_replace(":", "", $cols);
            $stmt = $this->conexao->prepare("insert into $table($colunas) values($parametros)");


            $stmt->bindParam($parametros, $colunas);



            $stmt->execute($values);

            return $this->conexao->lastInsertId();
        } else {
            return false;
        }

    }

    public function update($table, $cols, $values, $where = null)
    {

        if (!empty($table) && !empty($cols) && !empty($values)) {

            if ($where)
                " $where = WHERE $where ";

            $stmt = $this->conexao->prepare("update $table set $cols Where $where");
                /*  var_dump($table);
                 echo "<br";
                 var_dump($cols);
                 echo "<br";
                 var_dump($values);
                 
                 echo "<br";
                 var_dump($stmt);exit; */
           
                 $stmt->execute($values);

            return $stmt->rowCount();
        } else {
            return false;
        }


    }

    public function delete( $table, $where = null)
    {
            if (!empty($table)) {

            if ($where) {
                $where = " where $where ";
            }

         
            $stmt = $this->conexao->prepare("delete from $table $where");
            $stmt->execute();
            $stmt->rowCount();
        } else {
            return false;
        }
    }
}

?>