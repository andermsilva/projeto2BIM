<?php

namespace App\Models\DAO;

use APP\Models\Entidades\TipoPagamento;
use App\Models\DAO\BaseDAO;

use APP\Models\Entidades\Pagamento;


class PagamentoDAO extends BaseDAO
{

    public function getAlla()
    {

        $resultado = $this->select(
            "SELECT cod, nome FROM tipo_pagamento ORDER BY cod;"
        );

        $dataSetTipos = $resultado->fetchAll();

        //  var_dump($dataSetTipos);exit; 

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

    public function salvar(Pagamento $pagamento)
    {

        try {
            $identificador = $pagamento->getTipoPgto()->getCod();
            $valor = $pagamento->getValor();
            $pedNum = $pagamento->getPedido()->getPed_num();

            return $this->insert(
                "pagamento",":tp_pgto_cod,:valor,:ped_num",
                [
                    ':tp_pgto_cod'=>$identificador,
                    ':valor'=>$valor,
                    ':ped_num' => $pedNum

                ]

            );


        } catch (\Exception $e) {
            throw new \Exception("Erro na grevação de dado pagamento. " . $e->getMessage());
        }



    }



}

?>