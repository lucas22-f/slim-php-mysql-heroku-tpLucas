<?php
require_once 'models/Cervezero.php';

class CervezeroController extends Cervezero implements IApiUsable {
    public function __construct(){

    }
    public function CargarUno($request, $response, $args) {
        $parametros = $request->getParsedBody();
        $nombre = $parametros['nombre'];
        $apellido = $parametros['apellido'];
        $password = $parametros['password'];
        Cervezero::crearCervezero($nombre,$apellido,$password);
        $payload = json_encode(array("mensaje" => "Cervezero creado con exito"));
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }
    public function TraerTodos($request, $response, $args) {
        $lista = Cervezero::obtenerListaCervezeros();
        $payload = json_encode(array("listaCervezeros" => $lista));
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }
    
    public function TraerUno($request, $response, $args) {
        $id = $args["id"];
        $cervezero = Cervezero::obtenerCervezero($id);
        $payload = json_encode($cervezero);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }
    public function BorrarUno($request, $response, $args) {
        $id = $args["id"];
        Cervezero::borrarCervezero($id);
        $payload = json_encode(array("mensaje" => "Cervezero eliminado con exito"));
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    
    }
    public function ModificarUno($request, $response, $args) {
        $id = $args["id"];
        $nombre = $request->getParsedBody()["nombre"];
        $apellido = $request->getParsedBody()["apellido"];
        Cervezero::modificarCervezero($id, $nombre, $apellido);
        $payload = json_encode(array("mensaje" => "Cervezero modificado con exito"));
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }
    
   
}