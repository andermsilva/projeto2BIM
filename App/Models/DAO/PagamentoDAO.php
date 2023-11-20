<?php

namespace App\Models\DAO;

use App\Models\DAO\BaseDAO;

use APP\Models\Entidades\TipoPagamento;


class PagamentoDAO extends BaseDAO
{

    public function getAll()
    { 
            $resultado = $this->select(
                "SELECT cod, nome FROM tipo_pagamento ORDER BY cod;" );

            $dataSetTipos = $resultado->fetchAll();

          

            $listaTipos = [];

            if ($dataSetTipos) {

                foreach ($dataSetTipos as $dataSetTipo) {

                    $tipo = new TipoPagamento();
                    
                    $tipo->setCod($dataSetTipo['cod']);
                    $tipo->setNome($dataSetTipo['nome']);
                  
                    $listaTipos[] = $tipo;
                }

            }

            return [
        
                'resultado' => $listaTipos
            ];


        }



    

}

?>