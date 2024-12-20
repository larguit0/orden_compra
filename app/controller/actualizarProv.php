<?php
require_once __DIR__ . '/../../config/app.php';// Verificar si la sesión está iniciada
require_once __DIR__ . '/../../config/server.php'; // Ruta a la clase server.php
$conn = Database::connect();

// Verificar si la sesión está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

//placeholder values
$nombre_ph = $_POST['nombre_ph'];
$direccion_ph = $_POST['direccion_ph'];
$ciudad = $_POST['ciudad_ph'];
$nit_ph = $_POST['nit_ph'];

//values

$id_provedor = $_POST['id_provedor'];
$nombre = $_POST['nombre'];
$direccion = $_POST['direccion'];
$ciudad = $_POST['ciudad'];
$nit = $_POST['nit'];