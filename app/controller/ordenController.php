<?php
require_once __DIR__ . '/../../config/app.php';// Verificar si la sesión está iniciada

// Verificar si la sesión ya está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verificar si el proyecto ha sido enviado por el formulario
if (isset($_POST['id_proyecto']) && $_POST['id_proyecto'] != "Seleccione proyecto") {
    // Capturar el ID del proyecto
    $id_proyecto = $_POST['id_proyecto'];
    
    // Guardar el ID del proyecto en la sesión (opcional si lo necesitas más tarde)
    $_SESSION['id_proyecto'] = $id_proyecto;
    
    // Redirigir a la página de la orden de compra con el ID del proyecto en la URL
    header("Location: ".APP_URL."?views=orden&id=" . $id_proyecto);
    exit(); // Asegurarse de que se detiene el script después de la redirección
} else {
    // Si no se ha seleccionado ningún proyecto, redirigir a la página anterior o mostrar un error
    echo "<script>alert('Error: No se seleccionó ningún proyecto.');
    window.location.href = ' ".APP_URL."?views=dashboard/';</script>";
}
?>