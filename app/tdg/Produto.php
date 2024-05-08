<?php

require_once "ProdutoGateway.php";
class Produto
{
    protected $data;

    public function setConnection($conn)
    {
//        $gw = new ProdutoGateway();
        ProdutoGateway::setConnection($conn);
    }

    public function __set($property, $value)
    {
        $this->data[$property] = $value;
    }

    public function __get($property)
    {
        return $this->data[$property];
    }

    public static function find($id)
    {
        $gw = new ProdutoGateway();
        return $gw->find($id,'Produto');
    }

    public static function all($filter = '')
    {
        $gw = new ProdutoGateway();
        return $gw->all($filter);
    }

    public function save()
    {
        $prodGetWay = new ProdutoGateway();
        $prodGetWay->save((object) $this->data);
    }

    public function delete()
    {
        $prodGetWay = new ProdutoGateway();
        $prodGetWay->delete($this->id);
    }

    public function getMargemLucro()
    {
        return (($this->preco_venda - $this->preco_custo) / $this->preco_custo) * 100;
    }

    public function registrarCompra($precoCusto, $qtdCompra)
    {
        $this->preco_custo  = $precoCusto;
        $this->estoque += $qtdCompra;
     }
}