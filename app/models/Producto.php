<?php

class Producto {
    public $id;
    public $nombre;
    public $precio;
    public $tipo;
    public $tiempo_estimado_minutos; // tiempo de preparado. 
    public $fecha_creacion;

    public function crearProducto(){
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("INSERT INTO productos (nombre, precio, tipo, tiempo_estimado_minutos) VALUES (:nombre, :precio, :tipo , :tiempo_estimado_minutos)");
        $consulta->bindValue(':nombre', $this->nombre, PDO::PARAM_STR);
        $consulta->bindValue(':precio', $this->precio, PDO::PARAM_INT);
        $consulta->bindValue(':tipo', $this->tipo, PDO::PARAM_STR);
        $consulta->bindValue(':tiempo_estimado_minutos', $this->tiempo_estimado_minutos, PDO::PARAM_INT);
        $consulta->execute();

        return $objAccesoDatos->obtenerUltimoId();
    }

    public static function obtenerTodos()
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT id, nombre, precio, tipo, tiempo_estimado_minutos  FROM productos");
        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_CLASS, 'Producto');
    }
    public static function obtenerListaProductos($coleccionIdProductos){
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $productos = [];
        foreach ($coleccionIdProductos as $idProducto) {
            $consulta = $objAccesoDatos->prepararConsulta("SELECT id, nombre, precio, tipo, tiempo_estimado_minutos  FROM productos WHERE id = :id");
            $consulta->bindValue(':id', $idProducto, PDO::PARAM_INT);
            $consulta->execute();
            $resultado = $consulta->fetchAll(PDO::FETCH_CLASS, 'Producto');
            if(!empty($resultado)){
                $productos = array_merge($productos, $resultado);
            }
        }

        return $productos;
    
    }

    public static function obtenerProducto($id)
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT id, nombre, precio, tipo, tiempo_estimado_minutos  FROM productos WHERE id = :id");
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->execute();

        return $consulta->fetchObject('Producto');
    }

    public static function modificarProducto($id, $nombre, $precio, $tipo)
    {
        $objAccesoDato = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDato->prepararConsulta("UPDATE productos SET nombre = :nombre, precio = :precio, tipo = :tipo , tiempo_estimado_minutos = :tiempo_estimado_minutos WHERE id = :id");
        $consulta->bindValue(':nombre', $nombre, PDO::PARAM_STR);
        $consulta->bindValue(':precio', $precio, PDO::PARAM_INT);
        $consulta->bindValue(':tipo', $tipo, PDO::PARAM_STR);
    }
    public static function borrarProducto($id)
    {
        $objAccesoDato = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDato->prepararConsulta("DELETE FROM productos WHERE id = :id");
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->execute();
    }
}