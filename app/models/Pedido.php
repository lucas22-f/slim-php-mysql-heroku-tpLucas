<?php

require_once './models/Producto.php';
class Pedido
{

    public $id;

    public array $productos = [];

    public $id_mesa;
    public $estado;
    public $tiempo_estimado;
    public $total;

    public function __construct()
    {

    }
    public function crearPedido()
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();

        $subConsulta = $objAccesoDatos->prepararConsulta("INSERT INTO pedidos_productos (id_pedido, id_producto) VALUES (:id_pedido, :id_producto)");
        $this->id = $objAccesoDatos->obtenerUltimoId();
        foreach ($this->productos as $producto) {
            $subConsulta->bindValue(':id_pedido', $this->id, PDO::PARAM_INT);
            $subConsulta->bindValue(':id_producto', $producto, PDO::PARAM_INT);
            $subConsulta->execute();
        }

        $productos = Producto::obtenerListaProductos($this->productos);
        $this->productos = $productos;

        foreach ($this->productos as $producto) {
            $this->total += $producto->precio;
            $this->tiempo_estimado += $producto->tiempo_estimado_minutos;
        }

     

        $this->estado = "pendiente";

        $consulta = $objAccesoDatos->prepararConsulta("INSERT INTO pedidos (id_mesa,estado,tiempo_estimado,total) VALUES (:id_mesa , :estado, :tiempo_estimado, :total)");
        $consulta->bindValue(':id_mesa', $this->id_mesa, PDO::PARAM_INT);
        $consulta->bindValue(':estado', $this->estado, PDO::PARAM_STR);
        $consulta->bindValue(':tiempo_estimado', $this->tiempo_estimado, PDO::PARAM_INT);
        $consulta->bindValue(':total', $this->total, PDO::PARAM_INT);
        $consulta->execute();
        

        return $objAccesoDatos->obtenerUltimoId();
    }

    public static function borrarPedido($id)
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();

        $subConsulta = $objAccesoDatos->prepararConsulta("DELETE FROM pedidos_productos WHERE id_pedido = :id");
        $subConsulta->bindValue(':id', $id, PDO::PARAM_INT);
        $subConsulta->execute();


        $consulta = $objAccesoDatos->prepararConsulta("DELETE FROM pedidos WHERE id = :id");
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->execute();

        return $objAccesoDatos->obtenerUltimoId();
    }

    public static function obtenerTodos()
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT id, id_mesa FROM pedidos");
        $consulta->execute();

        $subConsulta = $objAccesoDatos->prepararConsulta("SELECT id_producto FROM pedidos_productos WHERE id_pedido = :id");

        $pedidos = $consulta->fetchAll(PDO::FETCH_CLASS, 'Pedido');
        foreach ($pedidos as $pedido) {
            $subConsulta->bindValue(':id', $pedido->id, PDO::PARAM_INT);
            $subConsulta->execute();
            $pedido->productos = Producto::obtenerListaProductos($subConsulta->fetchAll(PDO::FETCH_COLUMN, 0));

        }


        return $pedidos;
    }

    public static function obtenerPedido($id)
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT id, id_mesa,estado FROM pedidos WHERE id = :id");
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->execute();

        $subConsulta = $objAccesoDatos->prepararConsulta("SELECT id_producto FROM pedidos_productos WHERE id_pedido = :id");
        $subConsulta->bindValue(':id', $id, PDO::PARAM_INT);
        $subConsulta->execute();

        $pedido = $consulta->fetchObject('Pedido');
        $pedido->productos = Producto::obtenerListaProductos($subConsulta->fetchAll(PDO::FETCH_COLUMN, 0));

        return $pedido;
    }

    public static function modificarPedido($id, $id_mesa, $productos)
    {
        $objAccesoDato = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDato->prepararConsulta("UPDATE pedidos SET id_mesa = :id_mesa , estado = :estado WHERE id = :id");
        $consulta->bindValue(':id_mesa', $id_mesa, PDO::PARAM_INT);
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->execute();

        $subConsulta = $objAccesoDato->prepararConsulta("DELETE FROM pedidos_productos WHERE id_pedido = :id");
        $subConsulta->bindValue(':id', $id, PDO::PARAM_INT);
        $subConsulta->execute();

        $subConsulta = $objAccesoDato->prepararConsulta("INSERT INTO pedidos_productos (id_pedido, id_producto) VALUES (:id_pedido, :id_producto)");

        foreach ($productos as $producto) {
            $subConsulta->bindValue(':id_pedido', $id, PDO::PARAM_INT);
            $subConsulta->bindValue(':id_producto', $producto, PDO::PARAM_INT);
            $subConsulta->execute();
        }

    }

}