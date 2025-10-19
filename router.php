<?php
require_once 'templates/index.phtml';
require_once 'templates/canchas.phtml';
require_once 'templates/turnos.phtml';

$action = 'home';

if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

$params = explode('/', $action);

switch ($params[0]) {
    case 'Home':
        showHome();
        break;
    case 'Turnos':
        showTurnos();
        break; 
    case 'Canchas':
        showCanchas();
        break;
    default:
        echo ("404 Not Found");
        break;
}
?>