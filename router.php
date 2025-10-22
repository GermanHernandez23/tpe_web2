<?php
// ...existing code...

require_once 'libs/response.php';
require_once 'app/middlewares/session.auth.middleware.php';
require_once 'app/middlewares/verify.auth.middleware.php';
require_once 'app/controllers/shift.controller.php'; // <- actualizado
require_once 'app/controllers/auth.controller.php';
require_once 'templates/index.phtml';
require_once 'templates/turnos.phtml';
require_once 'templates/canchas.phtml';

// base_url para redirecciones y base tag
define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

$res = new Response();

$action = 'listar'; // accion por defecto si no se envia ninguna
if (!empty( $_GET['action'])) {
    $action = $_GET['action'];
}

// tabla de ruteo
// listar  -> ShiftController->showShifts();
// nueva   -> ShiftController->addShift();
// eliminar/:ID  -> ShiftController->deleteShift($id);
// finalizar/:ID -> ShiftController->finishShift($id);
// ver/:ID -> ShiftController->view($id);

$params = explode('/', $action);

switch ($params[0]) {
    case 'listar':
        sessionAuthMiddleware($res);
        $controller = new ShiftController($res);
        $controller->showShifts();
        break;
    case 'nueva':
        sessionAuthMiddleware($res); // Setea $res->user si existe session
        verifyAuthMiddleware($res); // Verifica que el usuario esté logueado o redirige a login
        $controller = new ShiftController($res);
        $controller->addShift();
        break;
    case 'eliminar':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new ShiftController($res);
        $controller->deleteShift($params[1]);
        break;
    case 'finalizar':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new ShiftController($res);
        $controller->finishShift($params[1]);
        break;
    case 'showLogin':
        $controller = new AuthController();
        $controller->showLogin();
        break;
    case 'login':
        $controller = new AuthController();
        $controller->login();
        break;
    case 'logout':
        $controller = new AuthController();
        $controller->logout();
        break; // <- agregado para evitar caer en default
    default:
        echo "404 Page Not Found";
        break;
}