<?php

class Cocinero extends Usuario{
    public function crearCocinero($nombre,$apellido,$password){
        parent::crearUsuario("cocinero",$nombre,$apellido,$password);
    }
    public static function obtenerListaCocineros(){
        return parent::obtenerListaUsuarios();
    }
    public static function obtenerCocinero($id){
        return parent::obtenerUsuario($id);
    }
    public static function borrarCocinero($id){
        parent::borrarUsuario($id);
    }
    public static function modificarCocinero($id, $nombre, $apellido){
        parent::modificarUsuario($id, $nombre, $apellido, "cocinero");
    }
}