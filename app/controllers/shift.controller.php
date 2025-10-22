<?php
require_once './app/models/shift.model.php';
require_once './app/views/shift.view.php';

class ShiftController {
    private $model;
    private $view;

    public function __construct($res) {
        $this->model = new ShiftModel();
        $this->view = new ShiftView($res->user);
    }

    public function showShifts() {
        // obtengo las tareas de la DB
        $Shift = $this->model->getShifts();

        // mando las tareas a la vista
        return $this->view->showShifts($Shift);
    }

    public function addShift() {
        if (!isset($_POST['title']) || empty($_POST['title'])) {
            return $this->view->showError('Falta completar el título');
        }
    
        if (!isset($_POST['priority']) || empty($_POST['priority'])) {
            return $this->view->showError('Falta completar la prioridad');
        }
    
        $title = $_POST['title'];
        $description = $_POST['description'];
        $priority = $_POST['priority'];
    
        $id = $this->model->insertShift($id, $nombre, $telefono, $horario, $fecha, $id_cancha);
    
        // redirijo al home (también podriamos usar un método de una vista para motrar un mensaje de éxito)
        header('Location: ' . BASE_URL);
    }

    
    public function deleteShift($id) {
        // obtengo la tarea por id
        $Shift = $this->model->getShifts($id);

        if (!$Shift) {
            return $this->view->showError("No existe la tarea con el id=$id");
        }

        // borro la tarea y redirijo
        $this->model->eraseShift($id);

        header('Location: ' . BASE_URL);
    }

    public function finishShift($id) {
        $task = $this->model->getShifts($id);

        if (!$Shift) {
            return $this->view->showError("No existe la tarea con el id=$id");
        }

        // actualiza la tarea
        $this->model->updateShift($id);

        header('Location: ' . BASE_URL);
    }
}

