<?php
// Verificar si la sesión ya está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../../config/app.php';// Verificar si la sesión está iniciada

// Conexión a la base de datos
require_once __DIR__ . '/../../config/server.php'; // Ruta a la clase server.php
$conn = Database::connect();

// Verificar si se seleccionó una ubicación y una compra
if (isset($_POST['id_ubicacion']) && !empty($_POST['id_ubicacion']) && isset($_POST['id_compra']) && !empty($_POST['id_compra'])) {
    $id_ubicacion = $_POST['id_ubicacion'];
    $id_compra = $_POST['id_compra'];

    if ($id_ubicacion == 3) {
        echo '<h5>Seleccione persona que recibirá en el proyecto</h5>';
        echo '<div class="select">';
        echo '<select class="select-persona" id="id_persona" name="id_persona" required>';
        echo '<option value="">Seleccione una persona encargada</option>';

        // Consulta SQL para obtener las personas encargadas
        $sql = "SELECT u.id, u.nombre, u.apellido 
                FROM proyecto_asignado pa 
                INNER JOIN usuario u ON u.id = pa.id_lider
                INNER JOIN proyecto p ON p.id = pa.id_proyecto 
                INNER JOIN compra c ON c.proyecto = p.id 
                WHERE c.id = :id_compra AND u.id_rol = 8";

        // Preparar y ejecutar la consulta
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_compra', $id_compra, PDO::PARAM_INT);
        $stmt->execute();

        // Iterar sobre los resultados para llenar el select
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<option value="' . htmlspecialchars($row['id']) . '">' . htmlspecialchars($row['nombre']) . ' ' . htmlspecialchars($row['apellido']) . '</option>';
        }

        echo '</select>';
        echo '</div>';
    }else{
        echo '<label class="form-label">Seleccione persona que recibirá en el proyecto: </label>';
        echo '<div class="select">';
        echo '<select class="select-persona" id="id_persona" name="id_persona" required>';
        echo '<option value="">Seleccione una persona encargada</option>';

        // Consulta SQL para obtener las personas encargadas
        $sql = "SELECT u.id, u.nombre, u.apellido 
                FROM usuario u
                WHERE u.id_rol != 8 AND u.id_rol = 5 OR u.id_rol =7 ";

        // Preparar y ejecutar la consulta
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        // Iterar sobre los resultados para llenar el select
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<option value="' . htmlspecialchars($row['id']) . '">' . htmlspecialchars($row['nombre']) . ' ' . htmlspecialchars($row['apellido']) . '</option>';
        }

        echo '</select>';
        echo '</div>';
    }
} else {
    echo 'Por favor seleccione una ubicación y una compra válida.';
}
?>
<style>
    <style>
    /* Estructura de la interfaz */
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .select-container {
        width: 100%;
        max-width: 500px;
        margin: 10px auto;
        padding: 10px;
    }

    h5, .form-label {
        font-size: 1.2em;
        text-align: center;
        margin: 10px 0;
    }

    /* Estilos del select */
    .select-persona {
        width: 100%;
        padding: 8px;
        font-size: 1em;
        border: 1px solid #ccc;
        border-radius: 4px;
        margin-top: 5px;
    }

    /* Responsividad */
    @media (max-width: 768px) {
        .select-container {
            padding: 15px;
        }

        h5, .form-label {
            font-size: 1em;
        }

        .select-persona {
            font-size: 0.9em;
        }
    }

    @media (max-width: 480px) {
        .select-container {
            padding: 10px;
        }

        h5, .form-label {
            font-size: 0.9em;
        }

        .select-persona {
            font-size: 0.85em;
        }
    }
</style>
