<?php
// Verificar si la sesión ya está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Incluir la clase server.php para usar la conexión
require_once __DIR__ . '/../../../config/server.php'; // Ajusta la ruta según la estructura de tu proyecto

// Establecer la conexión
$conn = Database::connect();

$persona = $_SESSION['id'];
$recordsPerPage = 10; // Número de registros por página
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $recordsPerPage;

// Obtener el número total de registros
$countStmt = $conn->prepare("SELECT COUNT(*) FROM orden_compra oc WHERE oc.persona = :id");
$countStmt->bindParam(':id', $persona);
$countStmt->execute();
$totalRecords = $countStmt->fetchColumn();
$totalPages = ceil($totalRecords / $recordsPerPage);

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
                   FROM aprobaciones ap INNER JOIN usuario u ON ap.id_aprobador = u.id
                   LEFT JOIN estado e ON ap.id_estado = e.id 
                   WHERE u.id_rol = 2) AS tecnico ON tecnico.id_orden_compra = oc.id

        LEFT JOIN (SELECT ap.id_orden_compra, e.estado 
                   FROM aprobaciones ap INNER JOIN usuario u ON ap.id_aprobador = u.id
                   LEFT JOIN estado e ON ap.id_estado = e.id 
                   WHERE u.id_rol = 3) AS director ON director.id_orden_compra = oc.id

        LEFT JOIN (SELECT ap.id_orden_compra, e.estado 
                   FROM aprobaciones ap INNER JOIN usuario u ON u.id = ap.id_aprobador
                   LEFT JOIN estado e ON ap.id_estado = e.id 
                   WHERE u.id_rol = 4) AS gerente_proyectos ON gerente_proyectos.id_orden_compra = oc.id

        LEFT JOIN (SELECT ap.id_orden_compra, e.estado 
                   FROM aprobaciones ap INNER JOIN usuario u ON u.id = ap.id_aprobador
                   LEFT JOIN estado e ON ap.id_estado = e.id 
                   WHERE u.id_rol = 1) AS gerente ON gerente.id_orden_compra = oc.id
                   
        WHERE oc.persona = :id
        ORDER BY oc.consecutivo DESC
        LIMIT :start, :recordsPerPage";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $persona, PDO::PARAM_INT);
$stmt->bindParam(':start', $start, PDO::PARAM_INT);
$stmt->bindParam(':recordsPerPage', $recordsPerPage, PDO::PARAM_INT);
$stmt->execute();
?>

<div class="main content">
    <section class="result-container">
        <div id="results" class="container">
            <div class="table-responsive">
                <table class="table is-striped">
                    <thead>
                        <tr>
                            <th>Orden Compra</th>
                            <th>ID Orden</th>
                            <th>Persona</th>
                            <th>Proyecto</th>
                            <th>Valor</th>
                            <th>Técnico</th>
                            <th>Director</th>
                            <th>Gerente Proyectos</th>
                            <th>Gerente</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
                            <tr>
                                <td> OC<?= $row['consecutivo'] ?></td>
                                <td><?= $row['codigo_orden'] ?></td>
                                <td><?= $row['nombre_usuario'] . ' ' . $row['apellido_usuario'] ?></td>
                                <td><?= $row['nombre_proyecto'] ?></td>
                                <td><?= number_format($row['valor_orden'], 2, ',', '.') ?></td>
                                <td><?= $row['estado_tecnico'] ?></td>
                                <td><?= $row['estado_director'] ?></td>
                                <td><?= $row['estado_gerente_proyectos'] ?></td>
                                <td><?= $row['estado_gerente'] ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                
                </table>
                <nav class="pagination" role="navigation" aria-label="pagination">
                    <ul class="pagination-list">
                        <?php if ($page > 1) : ?>
                            <li><a class="pagination-previous" href="?views=esColaboradorOC&page=<?= $page - 1 ?>">Anterior</a></li>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                            <li>
                                <a class="pagination-link <?= $i == $page ? 'is-current' : '' ?>" 
                                href="?views=esColaboradorOC&page=<?= $i ?>"><?= $i ?></a>
                            </li>
                        <?php endfor; ?>

                        <?php if ($page < $totalPages) : ?>
                            <li><a class="pagination-next" href="?views=esColaboradorOC&page=<?= $page + 1 ?>">Siguiente</a></li>
                        <?php endif; ?>
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
        width: 100%;
        max-width: 1200px;
        padding: 20px;
        background-color: #f4f4f4;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin: 0 auto;
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

    /* Estilos para la paginación */
    .pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 20px;
    }

    .pagination-list {
        display: flex;
        list-style: none;
        padding: 0;
    }

    .pagination-list li {
        margin: 0 5px;
    }

    .pagination-link.is-current {
        font-weight: bold;
        color: #007bff;
    }

    .pagination-previous, .pagination-next {
        color: #007bff;
        text-decoration: none;
    }

    /* Ajustes Responsivos */
    @media (max-width: 992px) {
        .result-container {
            padding: 15px;
        }
        .table.is-striped th,
        .table.is-striped td {
            font-size: 0.9em;
        }
    }

    @media (max-width: 768px) {
        .result-container {
            padding: 10px;
        }
        .table.is-striped th,
        .table.is-striped td {
            font-size: 0.85em;
            padding: 6px;
        }

        /* Ajuste de la paginación */
        .pagination {
            flex-direction: column;
        }

        .pagination-previous, .pagination-next {
            margin: 5px 0;
        }
    }

    @media (max-width: 576px) {
        .result-container {
            padding: 8px;
        }
        .table.is-striped th,
        .table.is-striped td {
            font-size: 0.8em;
            padding: 4px;
        }
        
        .pagination-list li {
            margin: 2px;
        }

        .pagination-link, .pagination-previous, .pagination-next {
            font-size: 0.8em;
            padding: 4px 8px;
        }
    }
</style>
