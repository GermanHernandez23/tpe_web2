<?php
// ...existing code...


class ShiftView {
    private $user;

    function __construct($user) {
        $this->user = $user;
    }

    public function showShifts($shifts) {
        // preparo las variables que necesita la plantilla
        $shifts = $shifts;        // disponible dentro del template
        $user   = $this->user;    // disponible dentro del template

        // incluyo la plantilla completa (project_root/templates/turnos.phtml)
        require_once __DIR__ . './templates/index.phtml';
        
    }

    public function showError($msg) {
        echo "<h1>ERROR!</h1>";
        echo "<h2>$msg</h2>";
    }
}