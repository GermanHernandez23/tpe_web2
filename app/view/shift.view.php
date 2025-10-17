<?php

class ShiftView {
    public function showShift($shift, $name) {
        $count = count($shift);

        // NOTA: el template va a poder acceder a todas las variables y 
        // constantes que tienen alcance en esta funcion
        require_once './templates/turnos.phtml';
    }

    public function showError($error, $name) {
        echo "<h1>$error</h1>";
    }
}