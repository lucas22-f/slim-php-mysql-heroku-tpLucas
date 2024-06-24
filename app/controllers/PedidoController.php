<?php
require_once './models/Pedido.php';
require_once './interfaces/IApiUsable.php';

class PedidoController extends Pedido implements IApiUsable{
    // Implement abstract methods
    public function CargarUno($request, $response, $args) {
        $params = $request->getParsedBody();
        $productos = $params['productos'];
        $id_mesa = $params['id_mesa'];
        $pedido = new Pedido();
        $pedido->id_mesa = $id_mesa;
        $pedido->productos = $productos; // coleccion de ids de productos 
        $pedido->crearPedido();

        $payload = json_encode(array("mensaje" => "Pedido creado con exito"));
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');


    }

    public function BorrarUno($request, $response, $args) {
        $id = $args["id"];
        Pedido::borrarPedido($id);

    }

    public function TraerTodos($request, $response, $args) {
        $lista = Pedido::obtenerTodos();
        $payload = json_encode(array("listaPedidos" => $lista));
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function TraerUno($request, $response, $args) {
        $id = $args["id"];
        $pedido = Pedido::obtenerPedido($id);
        $payload = json_encode($pedido);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function ModificarUno($request, $response, $args) {
        $id = $args["id"];
        $productos = $request->getParsedBody()["productos"];
        $id_mesa = $request->getParsedBody()["id_mesa"];
        Pedido::modificarPedido($id, $id_mesa, $productos);
        $payload = json_encode(array("mensaje" => "Pedido modificado con exito"));
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }

    
    
}