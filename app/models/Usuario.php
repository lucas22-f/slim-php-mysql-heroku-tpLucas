<?php

class Usuario
{
   
    public $nombre;
    public $rol;
    public $apellido;

    public function __construct($nombre, $apellido, $rol)
    {
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->rol = $rol;
    }
    public function crearUsuario()
    {
       
    }

    public static function obtenerTodos()
    {
       
    }

    public static function obtenerUsuario($usuario)
    {
       
    }

    public static function modificarUsuario()
    {
       
    }

    public static function borrarUsuario($usuario)
    {
       
    }
}