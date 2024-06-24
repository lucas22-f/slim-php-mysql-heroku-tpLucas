<?
require_once 'models/Cocinero.php';
class CocineroController extends Cocinero implements IApiUsable{
    public function __construct(){
        
    }
    public function CargarUno($request, $response, $args) {
		
        $parametros = $request->getParsedBody();
        $nombre = $parametros['nombre'];
        $apellido = $parametros['apellido'];
        $password = $parametros['password'];
        Cocinero::crearCocinero($nombre,$apellido,$password);
        $payload = json_encode(array("mensaje" => "Cocinero creado con exito"));
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
	}
	public function BorrarUno($request, $response, $args) {
		$id = $args["id"];
        Cocinero::borrarCocinero($id);
        $payload = json_encode(array("mensaje" => "Cocinero eliminado con exito"));
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
	}
	
	public function ModificarUno($request, $response, $args) {
        $id = $args["id"];
        $nombre = $request->getParsedBody()["nombre"];
        $apellido = $request->getParsedBody()["apellido"];
        Cocinero::modificarCocinero($id, $nombre, $apellido);
        $payload = json_encode(array("mensaje" => "Cocinero modificado con exito"));
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
	}
	
	public function TraerTodos($request, $response, $args) {
		$lista = Cocinero::obtenerListaCocineros();
        $payload = json_encode(array("listaCocineros" => $lista));
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
	}
	
	public function TraerUno($request, $response, $args) {
		$id = $args["id"];
        $cocinero = Cocinero::obtenerCocinero($id);
        $payload = json_encode($cocinero);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
	}
}