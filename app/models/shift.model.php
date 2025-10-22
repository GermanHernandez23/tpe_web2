<?php
 

class ShiftModel {
    private $db;

    public function __construct() {
       $this->db = new PDO('mysql:host=localhost;dbname=tpe_web2_tudai;charset=utf8', 'root', '');
    }
 
    public function getShifts() {
        // 2. Ejecuto la consulta
        $query = $this->db->prepare('SELECT * FROM turno');
        $query->execute();
    
        // 3. Obtengo los datos en un arreglo de objetos
        $shifts = $query->fetchAll(PDO::FETCH_OBJ); 
    
        return $shifts;
    }
 
    public function getShift($id) {    // Cambié getShifts por getShift (en singular)
        $query = $this->db->prepare('SELECT * FROM turno WHERE id = ?');
        $query->execute([$id]);   
    
        $shift = $query->fetch(PDO::FETCH_OBJ); // Cambié $task por $shift
    
        return $shift; // Cambié $Shift por $shift
    }
 
    public function insertShift($nombre, $telefono, $horario, $fecha, $id_cancha) { // Quité $id y = false
        $query = $this->db->prepare('INSERT INTO turno(nombre, telefono, horario, fecha, id_cancha) VALUES (?, ?, ?, ?, ?)');
        $query->execute([$nombre, $telefono, $horario, $fecha, $id_cancha]);
    
        return $this->db->lastInsertId();
    }
 
    public function eraseShift($id) {
        $query = $this->db->prepare('DELETE FROM turno WHERE id = ?');
        $query->execute([$id]);
    }

    public function updateShift($id) {        
        $query = $this->db->prepare('UPDATE turno SET finalizada = 1 WHERE id = ?');
        $query->execute([$id]);
    }
}