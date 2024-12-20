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
 
    <section>
        <div class="buscar-bar">
            <h5>Seleccione proyecto inspeccionar el inventario:</h5>
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
                <div class="space"></div>
                <section class="action-container">
                    <div class="columns">
                        <div class="column">
                            <a href="?views=inventario">
                                <button type="submit" class="button is-info is-rounded ">Busqueda inividual</button>
                            </a>
                        </div>
                    </div>
                </section>


           <div class="space1"></div>
           <div class="space1"></div>
           <div class="space1"></div>
           <div class="space1"></div>
           <div class="space1"></div>
           <div class="space1"></div>

            </div>

            <!-- Contenedor donde se muestra el formulario dinámico -->
            <div class="form" id="formulario-container"></div>
        </div>
    </section>

 
</div>
<style>
    
    <style>
    .main-content {
        padding: 20px;
    }
    
    .buscar-bar {
        display: flex;
        flex-direction: column;
        gap: 20px;
        align-items: center;
    }

    .buscar-bar h5 {
        font-size: 1.2em;
        text-align: center;
    }

    .select-container {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        justify-content: center;
        align-items: center;
    }

    .select-marca {
        width: 100%;
        max-width: 300px;
        padding: 8px;
        border-radius: 5px;
    }

    .button.is-info.is-rounded {
        padding: 8px 12px;
        font-size: 1em;
    }

    .form {
        width: 100%;
        max-width: 600px;
        margin-top: 20px;
    }

    /* Responsive styling */
    @media (min-width: 768px) {
        .select-container {
            flex-direction: row;
            gap: 20px;
        }

        .buscar-bar h5 {
            font-size: 1.4em;
        }
    }
    <style>
    .main-content {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        padding: 15px;
        box-sizing: border-box;
    }

    .container {
        max-width: 800px;
        width: 100%;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .table.is-striped {
        width: 100%;
        border-collapse: collapse;
    }

    .table.is-striped th, .table.is-striped td {
        padding: 10px;
        text-align: left;
    }

    .table.is-striped tbody tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    /* Paginación */
    .pagination ul {
        list-style: none;
        padding: 0;
        display: flex;
        justify-content: center;
        margin-top: 20px;
        flex-wrap: wrap;
    }

    .pagination ul li {
        margin: 0 5px;
    }

    .pagination ul li a {
        text-decoration: none;
        padding: 10px 15px;
        background-color: #f4f4f4;
        color: #333;
        border: 1px solid #ddd;
        border-radius: 5px;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .pagination ul li a:hover, .pagination ul li.active a {
        background-color: #007bff;
        color: #fff;
    }

    /* Responsividad */
    @media (max-width: 768px) {
        .container {
            padding: 10px;
        }

        .table.is-striped th, .table.is-striped td {
            padding: 8px;
            font-size: 14px;
        }

        .pagination ul li a {
            padding: 8px 12px;
            font-size: 14px;
        }
    }

    @media (max-width: 480px) {
        .table.is-striped, .table.is-striped thead {
            display: none;
        }

        .table.is-striped tbody, .table.is-striped tr, .table.is-striped td {
            display: block;
            width: 100%;
        }

        .table.is-striped tbody tr {
            margin-bottom: 10px;
            border: 1px solid #ddd;
            padding: 8px;
        }

        .table.is-striped td {
            text-align: right;
            padding-left: 50%;
            position: relative;
        }

        .table.is-striped td::before {
            content: attr(data-label);
            position: absolute;
            left: 10px;
            font-weight: bold;
            text-align: left;
        }
    }
</style>

<script>
function loadForm(page = 1) {
    var idProyecto = document.getElementById("id_proyecto").value;
    
    if (idProyecto === "") {
        document.getElementById("formulario-container").innerHTML = "";
        return;
    }

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "<?php echo APP_URL; ?>app/controller/cargar_inventario.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            document.getElementById("formulario-container").innerHTML = xhr.responseText;
        }
    };
    xhr.send("id_proyecto=" + idProyecto + "&page=" + page);
}
</script>

