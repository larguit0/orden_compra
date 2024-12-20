<?php
// Verificar si la sesión ya está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Incluir la clase server.php para usar la conexión
require_once __DIR__ . '/../../../config/server.php'; // Ajusta la ruta según la estructura de tu proyecto

// Establecer la conexión
$conn = Database::connect();
?>

<div class="main-content">
    <section class="buscar-container">
        <!-- Buscador -->
        <div class="buscar-bar">
            <h5 ><strong>Seleccione proyecto </strong></h5>
            <div class="select">
                <select class="select-marca" id="id_proyecto" name="id_proyecto" required onchange="loadForm()">
                    <option value="">Seleccione proyecto</option>
                    <?php
                    // Preparar la consulta
                    $sqlmodelo = "SELECT id, nombre FROM proyecto";
                    $stmt = $conn->prepare($sqlmodelo);
                    $stmt->execute();
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo '<option value="' . $row['id'] . '">' . $row['nombre'] . '</option>';
                    }
                    ?>
                </select>
            </div>

            <!-- Contenedor donde se muestra el formulario dinámico -->
            <div id="formulario-container"></div>
        </div>
    </section>
</div>

<script>
function loadForm() {
    var idProyecto = document.getElementById("id_proyecto").value;
    
    // Si no se selecciona un proyecto, limpiamos el formulario
    if (idProyecto === "") {
        document.getElementById("formulario-container").innerHTML = "";
        return;
    }
    
    // Realizar la solicitud AJAX para cargar el formulario
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "<?php echo APP_URL; ?>app/controller/cargar_formulario_compra.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Mostrar el formulario en el contenedor
            document.getElementById("formulario-container").innerHTML = xhr.responseText;
        }
    };
    xhr.send("id_proyecto=" + idProyecto);
}
</script>
<style>
    /* Responsividad */
    @media (max-width: 768px) {
        .main-content {
            padding: 15px;
        }

        .buscar-container {
            padding: 15px;
        }

        .buscar-bar h5 {
            font-size: 1em;
        }

        .select-marca {
            font-size: 0.9em;
        }
    }

    @media (max-width: 480px) {
        .main-content {
            padding: 10px;
        }

        .buscar-container {
            padding: 10px;
        }

        .buscar-bar h5 {
            font-size: 0.9em;
        }

        .select-marca {
            font-size: 0.85em;
        }
    }
</style>
