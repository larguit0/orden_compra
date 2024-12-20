<?php
// Verificar si la sesión ya está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../../config/app.php';// Verificar si la sesión está iniciada

// Conexión a la base de datos
// Conexión a la base de datos
require_once __DIR__ . '/../../config/server.php'; // Ruta a la clase server.php
$conn = Database::connect();

// Variables de paginación
$itemsPorPagina = 10;
$page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
$offset = ($page - 1) * $itemsPorPagina;

if (isset($_POST['id_proyecto']) && !empty($_POST['id_proyecto'])) {
    $id_proyecto = $_POST['id_proyecto'];
}

$id_estado = 1;
?>

<div class="main-content">
    <div class="space"></div>

    <section class="result-container">
        <div id="results" class="container">
            <div class="table-responsive">
                
                    <?php
                    // Obtener el total de registros
                    $sqlCount = "SELECT COUNT(*) AS total FROM orden_compra WHERE id_proyecto = :id";
                    $stmtCount = $conn->prepare($sqlCount);
                    $stmtCount->bindParam(':id', $id_proyecto);
                    $stmtCount->execute();
                    $totalRows = $stmtCount->fetch(PDO::FETCH_ASSOC)['total'];
                    $totalPaginas = ceil($totalRows / $itemsPorPagina);

                    // Consulta para obtener las aprobaciones con paginación
                    $sql = "SELECT 
                                oc.consecutivo AS consecutivo,
                                oc.codigo_orden AS codigo_orden,
                                u.nombre AS nombre_usuario, 
                                u.apellido AS apellido_usuario, 
                                p.nombre AS nombre_proyecto, 
                                oc.valor AS valor_orden,
                                IFNULL(tecnico.estado, 'pendiente') AS estado_tecnico,
                                IFNULL(director.estado, 'pendiente') AS estado_director,
                                IFNULL(gerente_proyectos.estado, 'pendiente') AS estado_gerente_proyectos,
                                IFNULL(gerente.estado, 'pendiente') AS estado_gerente
                            FROM orden_compra oc
                            INNER JOIN proyecto p ON oc.id_proyecto = p.id
                            INNER JOIN usuario u ON oc.persona = u.id
                            LEFT JOIN (SELECT ap.id_orden_compra, e.estado 
                                    FROM aprobaciones ap 
                                    INNER JOIN usuario u ON ap.id_aprobador = u.id
                                    LEFT JOIN estado e ON ap.id_estado = e.id 
                                    WHERE u.id_rol = 7 OR u.id_rol = 3) AS tecnico 
                                ON tecnico.id_orden_compra = oc.id
                            LEFT JOIN (SELECT ap.id_orden_compra, e.estado 
                                    FROM aprobaciones ap 
                                    INNER JOIN usuario u ON ap.id_aprobador = u.id
                                    LEFT JOIN estado e ON ap.id_estado = e.id 
                                    WHERE u.id_rol = 3) AS director 
                                ON director.id_orden_compra = oc.id
                            LEFT JOIN (SELECT ap.id_orden_compra, e.estado 
                                    FROM aprobaciones ap 
                                    INNER JOIN usuario u ON u.id = ap.id_aprobador
                                    LEFT JOIN estado e ON ap.id_estado = e.id 
                                    WHERE u.id_rol = 4) AS gerente_proyectos 
                                ON gerente_proyectos.id_orden_compra = oc.id
                            LEFT JOIN (SELECT ap.id_orden_compra, e.estado 
                                    FROM aprobaciones ap 
                                    INNER JOIN usuario u ON u.id = ap.id_aprobador
                                    LEFT JOIN estado e ON ap.id_estado = e.id 
                                    WHERE u.id_rol = 1) AS gerente 
                                ON gerente.id_orden_compra = oc.id
                            WHERE oc.id_proyecto = :id
                            ORDER BY oc.consecutivo DESC
                            LIMIT $offset, $itemsPorPagina"; // Ajustado aquí

                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(':id', $id_proyecto);
                    $stmt->execute();

                    // Verificar si hay registros
                    if ($totalRows > 0) {
                        echo '<table class="table is-striped">
                            <thead>
                                <tr>
                                    <th>Orden Compra</th>
                                    <th>Id Orden</th>
                                    <th>Persona</th>
                                    <th>Proyecto</th>
                                    <th>Valor</th>
                                    <th>Técnico</th>
                                    <th>Director</th>
                                    <th>Gerente administrativo</th>
                                    <th>Gerente</th>
                                </tr>
                            </thead>';
                        echo '<tbody>';
                        // Generar las filas de la tabla
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo '<tr>';
                            echo '<td> OC' . $row['consecutivo'] . '</td>';
                            echo '<td>' . $row['codigo_orden'] . '</td>';
                            echo '<td>' . $row['nombre_usuario'] . ' ' . $row['apellido_usuario'] . '</td>';
                            echo '<td>' . $row['nombre_proyecto'] . '</td>';
                            echo '<td>' . number_format($row['valor_orden'], 2, ',', '.') . '</td>';
                            echo '<td>' . $row['estado_tecnico'] . '</td>';
                            echo '<td>' . $row['estado_director'] . '</td>';
                            echo '<td>' . $row['estado_gerente_proyectos'] . '</td>';
                            echo '<td>' . $row['estado_gerente'] . '</td>';
                            echo '</tr>';
                        }
                        echo '</tbody>';
                        echo '</table>';
                    } else {
                        // Mensaje o fila vacía si no hay registros
                        echo '<div class="main-container">';
                        echo '<section class="hero-body">';
                        echo '<div class="hero-body">';
                        echo '  <p class="title">Sin Registros</p>';
                        echo '  <p class="subtitle">No hay registros de órdenes en este proyecto</p>';
                        echo '</div>';
                        echo '</section>';
                        echo '</div>';
                    }
                    ?>

                <!-- Paginación -->
                <nav class="pagination">
                    <ul>
                        <?php
                        for ($i = 1; $i <= $totalPaginas; $i++) {
                            $active = ($i == $page) ? 'class="active"' : '';
                            echo '<li ' . $active . '><a href="#" onclick="loadForm(' . $i . ')">' . $i . '</a></li>';
                        }
                        ?>
                    </ul>
                </nav>
            </div>
        </div>
    </section>
</div>

<style>
    /* Estructura y Estilos Responsivos */
    .main-content {
        display: flex;
        justify-content: center;
        padding: 20px;
    }
    .result-container {
        width: 130%;
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
        padding: 8px;
        border: 1px solid #ddd;
        text-align: left;
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

    /* Ajustes Responsivos */
    @media (max-width: 768px) {
        .result-container {
            padding: 15px;
        }
        .table.is-striped th,
        .table.is-striped td {
            font-size: 0.9em;
        }
    }

    @media (max-width: 480px) {
        .table.is-striped th,
        .table.is-striped td {
            font-size: 0.8em;
            padding: 6px;
        }
    }
</style>

<script>
function loadForm(page) {
    var idProyecto = document.getElementById("id_proyecto").value;
    
    if (idProyecto === "") {
        document.getElementById("formulario-container").innerHTML = "";
        return;
    }
    
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "<?php echo APP_URL; ?>app/controller/cargar_historial.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onload = function() {
        if (this.status === 200) {
            document.getElementById("formulario-container").innerHTML = this.responseText;
        }
    };
    xhr.send("id_proyecto=" + idProyecto + "&page=" + page);
}
</script>
