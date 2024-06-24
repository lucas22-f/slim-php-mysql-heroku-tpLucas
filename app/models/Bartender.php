<?php

class Bartender extends Usuario{
    public function crearBartender($nombre,$apellido,$password){
        parent::crearUsuario("bartender",$nombre,$apellido,$password);
    }
    public static function obtenerListaBartenders(){
        return parent::obtenerListaUsuarios();
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