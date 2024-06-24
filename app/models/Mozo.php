<?php
class Mozo extends Usuario{
    public $id;

    public function __construct($nombre, $apellido){
        parent::__construct($nombre, $apellido, "mozo");
        
    }
    public function crearMozo(){
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("INSERT INTO usuarios (nombre, apellido, rol) VALUES (:nombre, :apellido, :rol)");
    }
}