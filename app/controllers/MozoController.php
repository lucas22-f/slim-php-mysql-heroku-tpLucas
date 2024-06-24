

<?php
require_once 'models/Mozo.php';


class MozoController extends Mozo implements IApiUsable{
	public function __construct(){

	}
    public function CargarUno($request, $response, $args) {
		$nombre = $request->getParsedBody()['nombre'];
        $apellido = $request->getParsedBody()['apellido'];
		$password = $request->getParsedBody()['password'];
		Mozo::crearMozo($nombre,$apellido,$password);
    
        $payload = json_encode(array("mensaje" => "Mozo creado con exito"));
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');

        
	}
    
	public function TraerTodos($request, $response, $args) {
		$lista = Mozo::obtenerListaMozos();
		$payload = json_encode(array("listaMozos" => $lista));
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
	}
	
	public function TraerUno($request, $response, $args) {
		$id = $args["id"];
		$mozo = Mozo::obtenerMozo($id);
		$payload = json_encode($mozo);
		$response->getBody()->write($payload);
		return $response->withHeader('Content-Type', 'application/json');
		
	}
	public function BorrarUno($request, $response, $args) {
		$id = $args["id"];
		Mozo::borrarMozo($id);
		$payload = json_encode(array("mensaje" => "Mozo eliminado con exito"));
        $response->getBody()->write($payload);

        return $response->withHeader('Content-Type', 'application/json');
	}
	
	public function ModificarUno($request, $response, $args) {
		$id = $args["id"];
		$nombre = $request->getParsedBody()["nombre"];
		$apellido = $request->getParsedBody()["apellido"];
		Mozo::modificarMozo($id, $nombre, $apellido);
		$payload = json_encode(array("mensaje" => "Mozo modificado con exito"));
		$response->getBody()->write($payload);
		return $response->withHeader('Content-Type', 'application/json');
	}
	
}