<?php
// Verificar si la sesión ya está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// Conexión a la base de datos
require_once __DIR__ . '/../../config/app.php';// Verificar si la sesión está iniciada

require_once __DIR__ . '/../../config/server.php'; // Ruta a la clase server.php
$conn = Database::connect();



// Verificar si se seleccionó un proyecto
if (isset($_POST['id_proyecto']) && !empty($_POST['id_proyecto'])) {
    $id_proyecto = $_POST['id_proyecto'];
} else {
    echo 'Por favor seleccione un proyecto.';
    exit();
}

// Variables para el estado
$id_estado = 1;  // Estado de la orden (ej. "Pendiente", "Aprobado", etc.)
?>

<div class="main-content">
    <section class="result-container">
        <div id="results" class="container">
            <div class="table-responsive"> <!-- Contenedor desplazable horizontalmente -->
                <?php
                // Consulta para obtener las aprobaciones
                $sql = "SELECT 
                            c.consecutivo AS consecutivo,
                            c.id AS id_compra,
                            c.codigo_oc AS codigo, 
                            p.nombre AS nombre_proyecto,
                            u.nombre AS nombre_usuario, 
                            u.apellido AS apellido_usuario,
                            e.estado AS estado_aprobacion, 
                            c.valor AS valor
                        FROM compra c 
                        INNER JOIN proyecto p ON c.proyecto = p.id 
                        INNER JOIN usuario u ON c.persona = u.id 
                        INNER JOIN estado_compra e ON c.id_estado_compra = e.id 
                        WHERE c.id_estado_compra = :estado AND c.proyecto = :proyecto
                        ORDER BY c.consecutivo DESC ";
                
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':estado', $id_estado);
                $stmt->bindParam(':proyecto', $id_proyecto);
                $stmt->execute();

                // Verificar si hay resultados
                if ($stmt->rowCount() > 0) {
                    echo '<table class="table is-striped">';
                    echo '<thead>';
                    echo '    <tr>';
                    echo '        <th>Orden Compra</th>';
                    echo '        <th>Código</th>';
                    echo '        <th>Proyecto</th>';
                    echo '        <th>Responsable técnico</th>';
                    echo '        <th>Estado</th>';
                    echo '        <th>Valor</th>';
                    echo '        <th>Acciones</th>';
                    echo '    </tr>';
                    echo '</thead>';
                    echo '<tbody>';

                    // Si existen compras, iteramos sobre los resultados
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo '<tr>';
                        echo '<td>OC' . $row['consecutivo'] . '</td>';
                        echo '<td>' . $row['codigo'] . '</td>';
                        echo '<td>' . $row['nombre_proyecto'] . '</td>';
                        echo '<td>' . $row['nombre_usuario'] . ' ' . $row['apellido_usuario'] . '</td>';
                        echo '<td>' . $row['estado_aprobacion'] . '</td>';
                        echo '<td>' . number_format($row['valor'], 2, ',', '.') . '</td>';
                        echo '<td>';
                        echo '<form action = "'.APP_URL.'app/controller/descargarOC.php" method= "POST">';
                        echo '<input type="hidden" name= "id_compra" value = "'. $row['id_compra'].'">';
                        echo '<button type="submit" class="button is-info is-rounded">Descargar OC</button>';
                        echo '</form>';
                        echo '</td>';
                        echo '</tr>';
                    }
                    echo '</tbody>';
                    echo '</table>';
                } else {
                    // Si no hay compras para el proyecto seleccionado
                    echo '<div class="main-container">';
                    echo '   <section class="hero-body">';
                    echo '        <div class="hero-body">';
                    echo            '<p class="title">Sin compras</p>';
                    echo            '<p class="subtitle">Aún no se encuentran compras para el proyecto seleccionado</p>';
                    echo '        </div>';
                    echo '    </section>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </section>
</div>

<style>
    /* Contenedor responsivo para tablas */
    .table-responsive {
        overflow-x: auto; /* Desplazamiento horizontal para pantallas pequeñas */
    }

    /* Tabla con ajuste completo al contenedor */
    .table.is-striped {
        width: 100%;
    }

    .table.is-striped th,
    .table.is-striped td {
        padding: 8px;
        white-space: nowrap; /* Evita salto de línea en celdas */
    }

    @media (max-width: 768px) {
        /* Ajustes para pantallas medianas */
        .table.is-striped th,
        .table.is-striped td {
            font-size: 0.9em;
        }
        .button.is-info.is-rounded {
            font-size: 0.8em;
            padding: 5px 10px;
        }
    }

    @media (max-width: 480px) {
        /* Ajustes para pantallas pequeñas */
        .table.is-striped th,
        .table.is-striped td {
            font-size: 0.8em;
        }
        .button.is-info.is-rounded {
            font-size: 0.7em;
            padding: 4px 8px;
        }
    }
</style>
