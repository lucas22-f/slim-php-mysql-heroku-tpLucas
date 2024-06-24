<?php

class Cervezero extends Usuario{
    public function crearCervezero($nombre,$apellido,$passwd){
        parent::crearUsuario("cervezero",$nombre,$apellido,$passwd);
    }
    public static function obtenerListaCervezeros($rol){
        return parent::obtenerListaUsuarios($rol);
    }
    public static function obtenerCervezero($id){
        return parent::obtenerUsuario($id);
    }
    public static function borrarCervezero($id){
        parent::borrarUsuario($id);
    }
    public static function modificarCervezero($id, $nombre, $apellido){
        parent::modificarUsuario($id, $nombre, $apellido, "cervezero");
    }
}