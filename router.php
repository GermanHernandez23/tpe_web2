<?php
require_once './app/controllers/shift.controller.php';
require_once './app/controllers/shift.controller.php';


/** TABLA DE RUTEO
 * 
 * listar           ->     shiftController->showshift()
 * nueva            ->     shiftController->addTask();
 * eliminar/:ID     ->     shiftController->removeshift($id)
 * login            ->     AuthController->showLogin()
 * do_login         ->     AuthController->doLogin()
 * logout           ->     AuthController->logout()
 */

session_start();

// base_url para redirecciones y base tag
define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

// accion por defecto si no se envia ninguna
$action = 'listar'; 
if (!empty( $_GET['action'])) {
    $action = $_GET['action'];
}

// parsea la accion para separar accion real de parametros
$params = explode('/', $action);

$request = new StdClass();
$request = (new SessionMiddleware())->run($request);

switch ($params[0]) {
    case 'listar':
        $controller = new TaskController();
        $controller->showshift($request);
        break;
    case 'nueva':
        $request = (new GuardMiddleware())->run($request);
        $controller = new shiftController();
        $controller->addTask($request);
        break;
    case 'eliminar':
        $request = (new GuardMiddleware())->run($request);
        $controller = new shiftController();
        $request->id = $params[1];
        $controller->removeshift($request);
        break;
    case 'login':
        $controller = new AuthController();
        $controller->showLogin($request);
        break;
    case 'do_login':
        $controller = new AuthController();
        $controller->doLogin($request);
        break;
    case 'logout':
        $request = (new GuardMiddleware())->run($request);
        $controller = new AuthController();
        $controller->logout($request);
        break;
    default: 
        echo "404 Page Not Found";
        break;
}