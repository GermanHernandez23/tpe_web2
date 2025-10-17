<?php
// db.php - Conexión a la base de datos usando mysqli
$host = '127.0.0.1';
$user = 'root';
$pass = '';
$db   = 'tpe_web2_tudai';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_errno) {
    die('Error de conexión (' . $conn->connect_errno . ') ' . $conn->connect_error);
}
// establecer conjunto de caracteres
$conn->set_charset('utf8mb4');
?>