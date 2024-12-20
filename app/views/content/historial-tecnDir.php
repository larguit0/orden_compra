<?php
// Verificar si la sesión ya está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Incluir la clase server.php para usar la conexión
require_once __DIR__ . '/../../../config/server.php'; // Ajusta la ruta según la estructura de tu proyecto

// Establecer la conexión
$conn = Database::connect();


$id_lider = $_SESSION['id'];
?>

<div class="main-content">
    <section class="buscar-container">
        <!-- Buscador -->
        <div class="buscar-bar">
            <h5>Seleccione proyecto para hacer la orden de compra:</h5>
            <div class="select">
                <select class="select-marca" id="id_proyecto" name="id_proyecto" required onchange="loadForm()">
                    <option value="">Seleccione proyecto</option>
                    <?php
                    // Preparar la consulta
                    $sqlmodelo = "SELECT p.id, p.nombre FROM proyecto p INNER JOIN proyecto_asignado pa ON pa.id_proyecto = p.id WHERE pa.id_lider = :id";
                    $stmt = $conn->prepare($sqlmodelo);
                    $stmt->bindParam(':id', $id_lider);

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
function loadForm(page) {
    var idProyecto = document.getElementById("id_proyecto").value;
    
    // Si no se selecciona un proyecto, limpiamos el formulario
    if (idProyecto === "") {
        document.getElementById("formulario-container").innerHTML = "";
        return;
    }
    
    // Realizar la solicitud AJAX para cargar el formulario
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "<?php echo APP_URL; ?>app/controller/cargar_historial1.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Mostrar el formulario en el contenedor
            document.getElementById("formulario-container").innerHTML = xhr.responseText;
        }
    };
    xhr.send("id_proyecto=" + idProyecto + "&page=" + page);
}
</script>
<style>
        /* Estilos básicos */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .main-content {
            display: flex;
            justify-content: center;
            padding: 20px;
        }
        .buscar-container {
            width: 100%;
            max-width: 800px;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .buscar-bar h5 {
            margin: 0 0 10px;
            font-size: 1.2em;
        }
        .select {
            width: 100%;
            margin-bottom: 15px;
        }
        .select-marca {
            width: 100%;
            padding: 8px;
            font-size: 1em;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        #formulario-container {
            margin-top: 20px;
        }
        /* Estilos responsivos */
        @media (max-width: 600px) {
            .buscar-container {
                padding: 15px;
            }
            .buscar-bar h5 {
                font-size: 1em;
            }
            .select-marca {
                font-size: 0.9em;
                padding: 6px;
            }
        }
    </style>
