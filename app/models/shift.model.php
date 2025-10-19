<?php

class ShiftModel {
    private $db;

    function __construct() {
     // 1. abro conexión con la DB
     $this->db = new PDO('mysql:host=localhost;dbname=tpe_web2_tudai;charset=utf8', 'root', '');
    }

    public function get($id) {
        $query = $this->db->prepare('SELECT * FROM turno WHERE id = ?');
        $query->execute([$id]);
        $shift = $query->fetch(PDO::FETCH_OBJ);

        return $shift;
    }
    
    public function getAll() {
        // 2. ejecuto la consulta SQL (SELECT * FROM tareas)
        $query = $this->db->prepare('SELECT * FROM turno');
        $query->execute();

        // 3. obtengo los resultados de la consulta
        $shift = $query->fetchAll(PDO::FETCH_OBJ);

        return $shift;
    }

    function insert($title, $description, $priority) {
        $query = $this->db->prepare("INSERT INTO tareas(nombre, telefono, fecha, id_cancha, horario) VALUES(?,?,?,?,?,0)");
        $query->execute([$name, $phone, $date, $court, $time]);

        // var_dump($query->errorInfo());

        return $this->db->lastInsertId();
    }

    function remove($id) {
        $query = $this->db->prepare('DELETE from turno where id = ?');
        $query->execute([$id]);

        // return $this->db->;
    }

}