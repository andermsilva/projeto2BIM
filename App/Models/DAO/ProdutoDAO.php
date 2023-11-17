<?php

namespace App\Models\DAO;

use App\Models\Entidades\Produto;
use App\Models\DAO\BaseDAO;
use App\Models\Entidades\TipoProduto;

class ProdutoDAO extends BaseDAO
{
    public function listar()
    {
        $resultado = $this->select("SELECT * FROM produto order by tipocod; ");
        return $resultado->fetchAll(\PDO::FETCH_CLASS, Produto::class);
    }


    

    public function getById($id)
    {
        $resultado = $this->select(
            "SELECT p.codigo,
                    p.nome ,
                    p.preco,
                    p.peso,
                    p.promo,
                    p.descricao,
                    t.tipocod as tipocod,
                    t.tipo_nome as tipo,
                    p.imageurl
                FROM produto as p INNER JOIN tipoproduto as t ON p.tipocod = t.tipocod  WHERE p.codigo = $id"
        );

        $dataSetProduto = $resultado->fetch();

        if ($dataSetProduto) {
            $produto = new Produto();
            $produto->setCodigo($dataSetProduto['codigo']);
            $produto->setNome($dataSetProduto['nome']);
            $produto->setPreco($dataSetProduto['preco']);
            $produto->setPeso($dataSetProduto['peso']);
            $produto->setPromo($dataSetProduto['promo']);

            $produto->setDescricao($dataSetProduto['descricao']);
            $produto->getTipoProduto()->setTipocod($dataSetProduto['tipocod']);
            $produto->getTipoProduto()->setTipo_nome($dataSetProduto['tipo']);
            $produto->setImageUrl($dataSetProduto['imageurl']);

            return $produto;
        }

        return false;
    }


    public function salvar(Produto $produto)
    {

        try {

            $nome = $produto->getNome();
            $preco = $produto->getPreco();
            $peso = $produto->getPeso();
            $promo = $produto->getPromo();
            $descricao = $produto->getDescricao();
            $idTipo = $produto->getTipoProduto()->getTipocod();
            $imagem = $produto->getImageUrl();

            return $this->insert(
                'produto',
                ":tipocod, :nome,:descricao, :preco,:promo, :imageurl, :peso",
                [
                    ':tipocod' => $idTipo,
                    ':nome' => $nome,
                    ':descricao' => $descricao,
                    ':preco' => $preco,
                    ':promo' => $promo,
                    ':imageurl' => $imagem,
                    ':peso' => $peso,

                ]
            );
        } catch (\Exception $e) {

            throw new \Exception("Erro na gravação de dados." . $e->getMessage(), 500);
        }

    }

    public function atualizarImagem(Produto $produto)
    {
        try {
            $id = $produto->getCodigo();
            $imagem = $produto->getImageUrl();


            return $this->update(
                'produto',
                "imageurl = :imageurl",
                [
                    ':codigo' => $id,
                    ':imageurl' => $imagem
                ],
                "codigo = :codigo"
            );

        } catch (\Exception $e) {
            throw new \Exception("Erro na gravação de dados." . $e->getMessage(), 500);
        }
    }

    public function listarPaginacao($busca = null, $totalPorPagina = 6, $paginaSelecionada = 1)
    {
        $inicio = (($paginaSelecionada - 1) * $totalPorPagina);
        $whereBusca = ($busca) ? "AND (p.nome LIKE '%$busca%' OR p.descricao LIKE '%$busca%')" : '';
        
        $resultadoTotal = $this->select(
            "SELECT count(*) as total 
                FROM produto as p,tipoproduto as t 
                WHERE p.tipocod = t.tipocod
                {$whereBusca}"
        );

        $resultado = $this->select(
            "SELECT p.codigo,
                    p.nome ,
                    p.preco,
                    p.peso,
                    p.descricao,
                    t.tipocod ,
                    t.tipo_nome as tipo ,
                    p.imageurl,
                    p.promo
                FROM produto as p,tipoproduto as t
                WHERE p.tipocod = t.tipocod
                {$whereBusca} 
                LIMIT {$inicio}, {$totalPorPagina}"
        );

        $dataSetProdutos = $resultado->fetchAll();
        $totalLinhas = $resultadoTotal->fetch()['total'];
        $listaProdutos = [];

        if ($dataSetProdutos) {

            foreach ($dataSetProdutos as $dataSetProduto) {

                $produto = new Produto();
                $produto->setCodigo($dataSetProduto['codigo']);
                $produto->setNome($dataSetProduto['nome']);
                $produto->setPreco($dataSetProduto['preco']);
                $produto->setPeso($dataSetProduto['peso']);
                $produto->setPromo($dataSetProduto['promo']);
                $produto->setDescricao($dataSetProduto['descricao']);

                $produto->getTipoProduto()->setTipocod($dataSetProduto['tipocod']);
                $produto->getTipoProduto()->setTipo_nome($dataSetProduto['tipo']);
                $produto->setImageurl($dataSetProduto['imageurl']);

                $listaProdutos[] = $produto;
            }

        }

        return [
            'paginaSelecionada' => $paginaSelecionada,
            'totalPorPagina' => $totalPorPagina,
            'totalLinhas' => $totalLinhas,
            'resultado' => $listaProdutos
        ];
    }



    public function atualizar(Produto $produto)
    {
        try {

            $id = $produto->getCodigo();
            $nome = $produto->getNome();
            $preco = $produto->getPreco();
            $peso = $produto->getPeso();
            $promo = $produto->getPromo();
            $descricao = $produto->getDescricao();
            $tipo = $produto->getTipoProduto()->getTipocod();
            $imagem = $produto->getImageUrl();

            return $this->update(
                'produto',
                "tipocod = :tipocod, nome = :nome, descricao = :descricao, preco = :preco, promo = :promo, imageurl= :imageurl,peso= :peso",
                [
                    ':codigo' => $id,
                    ':tipocod' => $tipo,
                    ':nome' => $nome,
                    ':descricao' => $descricao,
                    ':preco' => $preco,
                    ':promo' => $promo,
                    ':imageurl' => $imagem,
                    ':peso' => $peso
                ],
                "codigo = :codigo"
            );

        } catch (\Exception $e) {
            throw new \Exception("Erro na gravação de dados." . $e->getMessage(), 500);
        }
    }

    public function excluir(Produto $produto)
    {
        try {

            $id = $produto->getCodigo();
            $file = 'public/image/produtos/'.$produto->getImageUrl();

            if (file_exists($file)) unlink($file);

            return $this->delete('produto',"codigo = $id");

        }catch (\Exception $e){
            throw new \Exception("Erro ao deletar" . $e->getMessage(), 500);
        }
    }

}




?>