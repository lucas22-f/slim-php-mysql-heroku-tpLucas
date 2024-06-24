<?php

require_once 'models/Bartender.php';

class BartenderController extends Bartender implements IApiUsable
{
    public function __construct(){

    }
    public function CargarUno($request, $response, $args) {
        $parametros = $request->getParsedBody();
        $nombre = $parametros['nombre'];
        $apellido = $parametros['apellido'];
        $passwd = $parametros['passwd'];
        Bartender::crearBartender($nombre,$apellido,$passwd);
        $payload = json_encode(array("mensaje" => "Bartender creado con exito"));
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }
    public function BorrarUno($request, $response, $args) {
        $id = $args["id"];
        Bartender::borrarBartender($id);
        $payload = json_encode(array("mensaje" => "Bartender eliminado con exito"));
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }
    public function TraerTodos($request, $response, $args) {
        $lista = Bartender::obtenerListaBartenders("bartender");
        $payload = json_encode(array("listaBartenders" => $lista));
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }
    
    public function TraerUno($request, $response, $args) {
        $id = $args["id"];
        $bartender = Bartender::obtenerBartender($id);
        $payload = json_encode($bartender);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }
    
    public function ModificarUno($request, $response, $args) {
        $id = $args["id"];
        $nombre = $request->getParsedBody()["nombre"];
        $apellido = $request->getParsedBody()["apellido"];
        Bartender::modificarBartender($id, $nombre, $apellido);
        $payload = json_encode(array("mensaje" => "Bartender modificado con exito"));
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }
    
   
}