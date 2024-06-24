<?php

class Cervezero extends Usuario{
    public function crearCervezero($nombre,$apellido,$password){
        parent::crearUsuario("cervezero",$nombre,$apellido,$password);
    }
    public static function obtenerListaCervezeros(){
        return parent::obtenerListaUsuarios();
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