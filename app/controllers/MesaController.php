<?php
require_once './models/Mesa.php';
require_once './interfaces/IApiUsable.php';


class MesaController extends Mesa implements IApiUsable{
   
    public function CargarUno($request, $response, $args) {
        $parametros = $request->getParsedBody();
        $nombreCliente = $parametros['nombreCliente'];
        $mesa = new Mesa();
        $mesa->nombreCliente = $nombreCliente;
        $mesa->crearMesa();
        $payload = json_encode(array("mensaje" => "Mesa creada con exito"));
        $response->getBody()->write($payload);

        return $response->withHeader('Content-Type', 'application/json');

    }
    public function BorrarUno($request, $response, $args){
        $id = $args['id'];
        Mesa::borrarMesa($id);
        $payload = json_encode(array("mensaje" => "Mesa eliminada con exito"));
        $response->getBody()->write($payload);

        return $response->withHeader('Content-Type', 'application/json');

    }
    public function TraerTodos($request, $response, $args) {
        $lista = Mesa::obtenerTodos();
        $payload = json_encode(array("listaMesa" => $lista));
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function TraerUno($request, $response, $args) {
        $id = $args['id'];
        $mesa = Mesa::obtenerMesa($id);
        $payload = json_encode($mesa);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
        
    }

    public function ModificarUno($request, $response, $args) {
        $id = $args['id'];
        $nombreCliente = $request->getParsedBody()['nombreCliente'];
        $estado = $request->getParsedBody()['estado'];
        Mesa::modificarMesa($id, $nombreCliente, $estado);
        $payload = json_encode(array("mensaje" => "Mesa modificada con exito"));
        $response->getBody()->write($payload); 
        return $response->withHeader('Content-Type', 'application/json');
        
    }

  


}