<?php

namespace App\Models\DAO;

use App\Models\Entidades\Endereco;
use App\models\Entidades\Usuario;
use App\Models\DAO\BaseDAO;


class EnderecoDAO extends BaseDAO
{
    public function listar()
    {
        $resultado = $this->select("SELECT * FROM endereco order by end_cod; ");
        return $resultado->fetchAll(\PDO::FETCH_CLASS, Endereco::class);
    }




    public function getByIdUser($id)
    {
        $resultado = $this->select(
            "SELECT u.id, 
                    u.nome,
                    e.end_cod,
                    e.logradouro,
                    e.cep,
                    e.numero,
                    e.comp, 
                    e.bairro,
                    e.cidade
          FROM  usuario u inner join 
                endereco e on u.id = e.cliente_cli_id
           WHERE u.id = $id"
        );


         
        $dataSetEndereco = $resultado->fetch();
       
        if ($dataSetEndereco) {
            $endereco = new Endereco();

            $endereco->getUsuario()->setId($dataSetEndereco['id']);
            $endereco->getUsuario()->setNome($dataSetEndereco['nome']);
            $endereco->setEndCod($dataSetEndereco['end_cod']);
            $endereco->setLogradouro($dataSetEndereco['logradouro']);
            $endereco->setCep($dataSetEndereco['cep']);
            $endereco->setNumero($dataSetEndereco['numero']);
            $endereco->setComplemento($dataSetEndereco['comp']);

            $endereco->setBairro($dataSetEndereco['bairro']);
            $endereco->setCidade($dataSetEndereco['cidade']);
            

            return $endereco->getEndCod();
        }

        return false;
    }

    public function listarPorUsuario($id)
    { 
        $resultado = $this->select(
            "SELECT u.id, 
                    u.nome,
                    e.end_cod,
                    e.logradouro,
                    e.cep,
                    e.numero,
                    e.comp, 
                    e.bairro,
                    e.cidade
          FROM  usuario u inner join 
                endereco e on u.id = e.cliente_cli_id
           WHERE u.id = $id;");

            $dataSetEnderecos = $resultado->fetchAll();

          

            $listaEnderecos = [];

            if ($dataSetEnderecos) {

                foreach ($dataSetEnderecos as $dataSetEndereco) {

                    $endereco = new Endereco();
                                     
                    $endereco->getUsuario()->setId($dataSetEndereco['id']);
                   // $endereco->getUsuario()->setNome($dataSetEndereco['nome']);
                    $endereco->setEndCod($dataSetEndereco['end_cod']);
                    $endereco->setLogradouro($dataSetEndereco['logradouro']);
                    $endereco->setCep($dataSetEndereco['cep']);
                    $endereco->setNumero($dataSetEndereco['numero']);
                    $endereco->setComplemento($dataSetEndereco['comp']);

                    $endereco->setBairro($dataSetEndereco['bairro']);
                    $endereco->setCidade($dataSetEndereco['cidade']);
                  
                    $listaEnderecos[] = $endereco;
                }

            }

            return [
        
                'result' => $listaEnderecos
            ];


        }













   /*  public function salvar(Produto $produto)
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
            $file = 'public/image/produtos/' . $produto->getImageUrl();

            if (file_exists($file))
                unlink($file);

            return $this->delete('produto', "codigo = $id");

        } catch (\Exception $e) {
            throw new \Exception("Erro ao deletar" . $e->getMessage(), 500);
        }
    }
 */
}




?>