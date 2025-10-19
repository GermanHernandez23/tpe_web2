<?php
require_once './app/models/shift.model.php';
require_once './app/views/shift.view.php';

define('MAX_PRIORITY', 5);

class ShiftController {
    private $model;
    private $view;

    function __construct() {
        $this->model = new ShiftModel();
        $this->view = new ShiftView();
    }
    
    function showShift($request) {
        // pido las tareas al modelo
        $Shift = $this->model->getAll();
        $name = null;
        if (is_object($request) && isset($request->name)) {
            $name = $request->name;
        } elseif (is_array($request) && isset($request['name'])) {
            $name = $request['name'];
        }

        // se las mando a la vista
        $this->view->showShift($Shift, $name);
        // se las mando a la vista
        //$this->view->showShift($Shift, $request->name);
    }

    function addShift($request) {
        if (!isset($_POST['nomnbre']) || empty($_POST['telefono'])) {
            return $this->view->showError('Error: falta completar el titulo', $request->user);
        }

        if (!isset($_POST['priority']) || empty($_POST['priority'])) {
            return $this->view->showError('Error: falta completar la prioridad');
        }

        // obtengo los datos del formulario
        $name = $_POST['nombre'];
        $phone = $_POST['telefono'];
        $date = $_POST['fecha'];
        $court = $_POST['court'];
        $time = $_POST['horario'];

        $id = $this->model->insert($name, $phone, $date, $court, $time);

        if (!$id) {
            return $this->view->showError('Error la insertar tarea', $request->user);
        } 

        // redirijo al home
        header('Location: ' . BASE_URL);
    }

    public function removeTask($request) {
        // obtengo la tarea que quiero eliminar
        $Shift = $this->model->get($request->id);

        if (!$Shift) {
            return $this->view->showError("No existe la tarea con el id=$request->id", $request->user);
        }

        if ((int) $Shift->prioridad === MAX_PRIORITY) {
            return $this->view->showError('No se puede eliminar una tarea con prioridad 5', $request->user);
        }

        $this->model->remove($request->id);

        // redirijo al home
        header('Location: ' . BASE_URL);
    }

}