<?php
require_once __DIR__ . '/../../config/app.php';// Verificar si la sesión está iniciada

// Verificar si la sesión está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Conexión a la base de datos
require_once __DIR__ . '/../../config/server.php'; // Ruta a la clase server.php
$conn = Database::connect();

echo "<script>
    window.location.href = '".APP_URL."?views=Rechazados/';
    </script>";