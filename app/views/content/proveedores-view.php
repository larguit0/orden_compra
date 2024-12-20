<?php
// Verificar si la sesión ya está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Incluir la clase server.php para usar la conexión
require_once __DIR__ . '/../../../config/server.php'; // Ajusta la ruta según la estructura de tu proyecto

// Establecer la conexión
$conn = Database::connect();


$id_aprobador = $_SESSION['id'];
?>

<div class="main content">
    <section class="result-container">
        <div id="results" class="container">
            <div class = "table-responsive">
            <?php
            // Consulta para obtener las aprobaciones
            $sql = "SELECT id,nombre,direccion,ciudad,nit FROM proveedor";
            
            $stmt = $conn->prepare($sql);
            $stmt->execute();

            // Verificar si hay registros
            if ($stmt->rowCount() > 0) {
                // Estructura de la tabla
                echo '<table class="table is-striped">';
                echo '<thead>';
                echo '<tr>';
                echo '<th>Nombre</th>';
                echo '<th>Direccion</th>';
                echo '<th>Ciudad</th>';
                echo '<th>Nit</th>';
                echo '<th>Actualizar</th>';
                echo '<th>Eliminar</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';



                // Generar las filas de la tabla
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo '<tr>';
                    echo '<td>OC' . $row['nombre'] . '</td>';
                    echo '<td>' . $row['direccion'] . '</td>';
                    echo '<td>' . $row['ciudad'] . '</td>';
                    echo '<td>' . $row['nit'] . '</td>';
                    echo '<td>';
                    echo '<a href="?views=ActualizarProv&id=' . $row['id'] . '">';
                    echo '<button type="submit" class="button is-info is-rounded">Actualizar</button>';
                    echo '</a>';
                    echo '</td>';
                    echo '<td>';
                    echo '<a href="?views=EliminarProv&id=' . $row['id'] . '">';
                    echo '<button type="submit" class="button is-info is-rounded-eliminar">Eliminar</button>';
                    echo '</a>';
                    echo '</td>';
                    echo '</tr>';
                }
                
                echo '</tbody>';
                echo '</table>';
            } else {
                // Mensaje si no hay registros
                echo '<div class="main-container">';
                echo '<section class="hero-body">';
                echo '<div class="hero-body">';
                echo '  <p class="title">Sin Registros</p>';
                echo '  <p class="subtitle">No hay provedores disponibles</p>';
                echo '</div>';
                echo '</section>';
                echo '</div>';
            }
            ?>
        </div>
    </section>
</div>
<style>
    /* Estructura general y estilo básico */
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

    .result-container {
        width: 100%;
        max-width: 1200px;
        padding: 20px;
        background-color: #f4f4f4;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .table-responsive {
        overflow-x: auto;
    }

    .table.is-striped {
        width: 100%;
        border-collapse: collapse;
    }

    .table.is-striped th,
    .table.is-striped td {
        padding: 10px;
        border: 1px solid #ddd;
        text-align: left;
    }

    /* Botón de acción */
    .button.is-info.is-rounded {
        font-size: 0.9em;
        padding: 8px 16px;
        border: none;
        border-radius: 8px;
        color: #fff;
        background-color: #3273dc;
        cursor: pointer;
    }

    .button.is-info.is-rounded:hover {
        background-color: #275ba3;
    }

    .button.is-info.is-rounded-eliminar{
        font-size: 0.9em;
        padding: 8px 16px;
        border: none;
        border-radius: 8px;
        color: #fff;
        background-color: #3273dc;
        cursor: pointer;

    }

    .button.is-info.is-rounded-eliminar:hover{
        background-color: #CC0000;

    }

    /* Paginación */
    .pagination ul {
        list-style: none;
        padding: 0;
        display: flex;
        gap: 5px;
    }

    .pagination ul li {
        display: inline;
    }

    .pagination ul li a {
        padding: 5px 10px;
        border: 1px solid #ccc;
        text-decoration: none;
        color: #333;
    }

    .pagination ul li a:hover,
    .pagination ul li.active a {
        background-color: #007bff;
        color: white;
    }

    /* Ajustes responsivos para pantallas más pequeñas */
    @media (max-width: 1024px) {
        .table.is-striped th,
        .table.is-striped td {
            font-size: 0.95em;
        }

        .button.is-info.is-rounded {
            padding: 6px 12px;
            font-size: 0.85em;
        }
    }

    @media (max-width: 768px) {
        .result-container {
            padding: 15px;
        }

        .table.is-striped th,
        .table.is-striped td {
            font-size: 0.85em;
        }

        .button.is-info.is-rounded {
            padding: 5px 10px;
            font-size: 0.8em;
        }
    }

    @media (max-width: 600px) {
        .table-responsive {
            overflow-x: scroll;
        }

        .table.is-striped th,
        .table.is-striped td {
            font-size: 0.8em;
            padding: 8px 10px;
        }

        .button.is-info.is-rounded {
            padding: 4px 8px;
            font-size: 0.75em;
        }
    }

    /* Mensaje de "Sin registros" */
    .main-container {
        text-align: center;
        padding: 20px;
        color: #666;
    }

    .main-container .title {
        font-size: 1.5em;
        margin-bottom: 10px;
    }

    .main-container .subtitle {
        font-size: 1.2em;
        color: #999;
    }
</style>

