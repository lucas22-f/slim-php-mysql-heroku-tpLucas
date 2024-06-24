<?php
require_once './models/Usuario.php';
require_once './interfaces/IApiUsable.php';
require_once './controllers/MozoController.php';
require_once './controllers/CocineroController.php';
require_once './controllers/BartenderController.php';
require_once './controllers/CervezeroController.php';

class UsuarioController extends Usuario implements IApiUsable
{
  public function CargarUno($request, $response, $args)
  {
    $parametros = $request->getParsedBody();
    $rol = $parametros['rol'];
    $return = null;

    switch ($rol) {
      case "mozo":
        $mozoController = new MozoController();
        $return = $mozoController->CargarUno($request, $response, $args);
        break;
      case "cocinero":
        $cocineroController = new CocineroController();
        $return = $cocineroController->CargarUno($request, $response, $args);
        break;
      case "bartender":
        $bartenderController = new BartenderController();
        $return = $bartenderController->CargarUno($request, $response, $args);
        break;
      case "cervecero":
        $cerveceroController = new CervezeroController();
        $return = $cerveceroController->CargarUno($request, $response, $args);
        break;

    }
    return $return;

  }

  public function TraerUno($request, $response, $args)
  {


    $rol = $request->getQueryParams()['rol'];

    switch ($rol) {
      case "mozo":
        $mozoController = new MozoController();
        $response = $mozoController->TraerUno($request, $response, $args);
        break;
      case "cocinero":
        $cocineroController = new CocineroController();
        $response = $cocineroController->TraerUno($request, $response, $args);
        break;
      case "bartender":
        $bartenderController = new BartenderController();
        $response = $bartenderController->TraerUno($request, $response, $args);
        break;
      case "cervecero":
        $cerveceroController = new CervezeroController();
        $response = $cerveceroController->TraerUno($request, $response, $args);
        break;
        default:
        // Asegúrate de manejar el caso por defecto o de devolver una respuesta de error si el rol no es reconocido
        $response->getBody()->write("Rol no reconocido");
        return $response->withStatus(400);
    }
    return $response;
  }

  public function TraerTodos($request, $response, $args)
  {
    $rol = $request->getQueryParams()['rol'];

    switch ($rol) {
      case "mozo":
        $mozoController = new MozoController();
        $response = $mozoController->TraerTodos($request, $response, $args);
        break;
      case "cocinero":
        $cocineroController = new CocineroController();
        $response = $cocineroController->TraerTodos($request, $response, $args);
        break;
      case "bartender":
        $bartenderController = new BartenderController();
        $response = $bartenderController->TraerTodos($request, $response, $args);
        break;
      case "cervecero":
        $cerveceroController = new CervezeroController();
        $response = $cerveceroController->TraerTodos($request, $response, $args);
        break;
      default:
        // Asegúrate de manejar el caso por defecto o de devolver una respuesta de error si el rol no es reconocido
        $response->getBody()->write("Rol no reconocido");
        return $response->withStatus(400);
    }

    return $response; // Asegúrate de devolver $response al final
  }

  public function ModificarUno($request, $response, $args)
  {

    $rol = $request->getQueryParams()['rol'];
   
    switch ($rol) {
      case "mozo":
        $mozoController = new MozoController();
        $response = $mozoController->ModificarUno($request, $response, $args);
        break;
      case "cocinero":
        $cocineroController = new CocineroController();
        $response = $cocineroController->ModificarUno($request, $response, $args);
        break;
      case "bartender":
        $bartenderController = new BartenderController();
        $response = $bartenderController->ModificarUno($request, $response, $args);
        break;
      case "cervecero":
        $cerveceroController = new CervezeroController();
        $response = $cerveceroController->ModificarUno($request, $response, $args);
        break;
      default:
        // Asegúrate de manejar el caso por defecto o de devolver una respuesta de error si el rol no es reconocido
        $response->getBody()->write("Rol no reconocido");
        return $response->withStatus(400);
    }
    return $response;
  }

  public function BorrarUno($request, $response, $args)
  {
    $rol = $request->getQueryParams()['rol'];
    switch ($rol) {
      case "mozo":
        $mozoController = new MozoController();
        $response = $mozoController->BorrarUno($request, $response, $args);
        break;
      case "cocinero":
        $cocineroController = new CocineroController();
        $response = $cocineroController->BorrarUno($request, $response, $args);
        break;
      case "bartender":
        $bartenderController = new BartenderController();
        $response = $bartenderController->BorrarUno($request, $response, $args);
        break;
      case "cervecero":
        $cerveceroController = new CervezeroController();
        $response = $cerveceroController->BorrarUno($request, $response, $args);
        break;
      default:
        // Asegúrate de manejar el caso por defecto o de devolver una respuesta de error si el rol no es reconocido
        $response->getBody()->write("Rol no reconocido");
        return $response->withStatus(400);
    }

    return $response;
  }
}
