<?php

class Socio extends Usuario{
    public $id;

    public function __construct($nombre, $apellido){
        parent::__construct($nombre, $apellido, "socio");
        
    }
    public function crearSocio(){
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("INSERT INTO socios (nombre, apellido, rol) VALUES (:nombre, :apellido, :rol)");
        $consulta->bindValue(':nombre', $this->nombre, PDO::PARAM_STR);
        $consulta->bindValue(':apellido', $this->apellido, PDO::PARAM_STR);
        $consulta->bindValue(':rol', $this->rol, PDO::PARAM_STR);
        $consulta->execute();
    }
}