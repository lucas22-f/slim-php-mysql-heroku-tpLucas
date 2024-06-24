<?php
require_once './models/Producto.php';
require_once './interfaces/IApiUsable.php';

class ProductoController extends Producto implements IApiUsable{
       
    public function CargarUno($request, $response, $args) {
        $parametros = $request->getParsedBody();
        $nombre = $parametros['nombre'];
        $precio = $parametros['precio'];
        $tipo = $parametros['tipo'];
        $tiempo_estimado_minutos = $parametros['tiempo_estimado_minutos'];
      
        $producto = new Producto();
        $producto->nombre = $nombre;
        $producto->precio = $precio;
        $producto->tipo = $tipo;
        $producto->tiempo_estimado_minutos = $tiempo_estimado_minutos;
        $producto->crearProducto();
        $payload = json_encode(array("mensaje" => "Producto creado con exito"));
        $response->getBody()->write($payload);

        return $response->withHeader('Content-Type', 'application/json');

    }
    public function BorrarUno($request, $response, $args){
        $id = $args['id'];
        Producto::borrarProducto($id);
        $payload = json_encode(array("mensaje" => "Producto eliminado con exito"));
        $response->getBody()->write($payload);

        return $response->withHeader('Content-Type', 'application/json');

    }
    public function TraerTodos($request, $response, $args) {
        $lista = Producto::obtenerTodos();
        $payload = json_encode(array("listaProductos" => $lista));
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function TraerUno($request, $response, $args) {
        $id = $args['id'];
        $producto = Producto::obtenerProducto($id);
        $payload = json_encode($producto);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
        
    }

    public function ModificarUno($request, $response, $args) {
        $id = $args['id'];
        $nombre = $request->getParsedBody()['nombre'];
        $precio = $request->getParsedBody()['precio'];
        $tipo = $request->getParsedBody()['tipo'];
      
        Producto::modificarProducto($id, $nombre, $precio, $tipo);
        $payload = json_encode(array("mensaje" => "Producto modificado con exito"));
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }
}