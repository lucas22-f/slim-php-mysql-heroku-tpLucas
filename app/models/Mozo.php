<?php
require_once 'Usuario.php';
class Mozo extends Usuario{

    public function crearMozo($nombre,$apellido,$passwd){
        parent::crearUsuario("mozo",$nombre,$apellido,$passwd);
    }
    public static function obtenerListaMozos($rol){
        return parent::obtenerListaUsuarios($rol);
    }
    public static function obtenerMozo($id){
        return parent::obtenerUsuario($id);
    }
    public static function borrarMozo($id){
        parent::borrarUsuario($id);
    }
    public static function modificarMozo($id, $nombre, $apellido){
        parent::modificarUsuario($id, $nombre, $apellido, "mozo");
    }
}