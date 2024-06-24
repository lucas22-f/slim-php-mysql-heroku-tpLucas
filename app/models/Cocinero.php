<?php

class Cocinero extends Usuario{
    public function crearCocinero($nombre,$apellido,$passwd){
        parent::crearUsuario("cocinero",$nombre,$apellido,$passwd);
    }
    public static function obtenerListaCocineros($rol){
        return parent::obtenerListaUsuarios($rol);
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