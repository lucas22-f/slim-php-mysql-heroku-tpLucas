<?php

class Bartender extends Usuario{
    public function crearBartender($nombre,$apellido,$passwd){
        parent::crearUsuario("bartender",$nombre,$apellido,$passwd);
    }
    public static function obtenerListaBartenders($rol){
        return parent::obtenerListaUsuarios($rol);
    }
    public static function obtenerBartender($id){
        return parent::obtenerUsuario($id);
    }
    public static function borrarBartender($id){
        parent::borrarUsuario($id);
    }
    public static function modificarBartender($id, $nombre, $apellido){
        parent::modificarUsuario($id, $nombre, $apellido, "bartender");
    }
}