<?php
// Verificar si la sesión ya está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Incluir la clase server.php para usar la conexión
require_once __DIR__ . '/../../../config/server.php'; // Ajusta la ruta según la estructura de tu proyecto

// Establecer la conexión
$conn = Database::connect();

$id_persona = $_SESSION['id'];
$registros_por_pagina = 10; // Define el número de registros por página

// Obtener el número de la página actual
if (isset($_GET['pagina']) && is_numeric($_GET['pagina'])) {
    $pagina_actual = (int)$_GET['pagina'];
} else {
    $pagina_actual = 1;
}

// Calcular el offset
$offset = ($pagina_actual - 1) * $registros_por_pagina;

// Consulta para obtener el número total de registros
$sqlTotal = "SELECT COUNT(*) FROM orden_compra_rechazada WHERE persona = :id OR compra_per = :id";
$stmtTotal = $conn->prepare($sqlTotal);
$stmtTotal->bindParam(':id', $id_persona);
$stmtTotal->execute();
$total_registros = $stmtTotal->fetchColumn();
$total_paginas = ceil($total_registros / $registros_por_pagina);

// Consulta para obtener las aprobaciones con paginación
$sql = "SELECT r.id AS id, r.id_codigo_orden AS id_orden, p.nombre AS proyecto, r.fecha AS fecha
        FROM orden_compra_rechazada r
        INNER JOIN proyecto p ON r.id_proyecto = p.id
        WHERE r.persona = :id OR r.compra_per = :id
        ORDER BY r.fecha DESC
        LIMIT :offset, :registros_por_pagina";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $id_persona);
$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
$stmt->bindParam(':registros_por_pagina', $registros_por_pagina, PDO::PARAM_INT);
$stmt->execute();
?>

<div class="main content">
    <section class="result-container">
        <div id="results" class="container">
            <?php if ($stmt->rowCount() > 0): ?>
                <table class="table is-striped">
                    <thead>
                        <tr>
                            <th>ID Orden</th>
                            <th>Proyecto</th>
                            <th>Fecha</th>
                            <th>Inspeccionar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                            <tr>
                                <td><?= $row['id_orden']; ?></td>
                                <td><?= $row['proyecto']; ?></td>
                                <td><?= $row['fecha']; ?></td>
                                <td>
                                    <a href="?views=detallesRechazo&id=<?= $row['id']; ?>">
                                        <button type="submit" class="button is-info is-rounded">Inspeccionar</button>
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>

                <!-- Paginación -->
                <div class="pagination-container">
                    <nav class="pagination is-centered" role="navigation" aria-label="pagination">
                        <ul class="pagination-list">
                            <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
                                <li>
                                    <a href="?views=Rechazados&pagina=<?= $i; ?>" class="pagination-link <?= $i == $pagina_actual ? 'is-current' : ''; ?>">
                                        <?= $i; ?>
                                    </a>
                                </li>
                            <?php endfor; ?>
                        </ul>
                    </nav>
                </div>
            <?php else: ?>
                <div class="main-container">
                    <section class="hero-body">
                        <div class="hero-body">
                            <p class="title">Sin Registros</p>
                            <p class="subtitle">No hay ordenes de compra rechazadas</p>
                        </div>
                    </section>
                </div>
            <?php endif; ?>
        </div>
    </section>
</div>
<style>
    .pagination-container {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }

    .pagination-list {
        list-style-type: none;
        display: flex;
        gap: 8px;
    }

    .pagination-link {
        display: inline-block;
        padding: 8px 12px;
        border: 1px solid #ddd;
        color: #4a4a4a;
        border-radius: 5px;
        text-decoration: none;
    }

    .pagination-link.is-current {
        background-color: #3273dc;
        color: #fff;
        font-weight: bold;
        border: none;
    }

    .pagination-link:hover {
        background-color: #3273dc;
        color: white;
    }

    /* Responsividad */
    @media (max-width: 768px) {
        .table {
            display: block;
            overflow-x: auto;
            white-space: nowrap;
        }

        .pagination-list {
            flex-wrap: wrap;
            justify-content: center;
        }

        .pagination-link {
            padding: 6px 10px;
            font-size: 14px;
        }
    }

    @media (max-width: 480px) {
        .pagination-link {
            padding: 4px 8px;
            font-size: 12px;
        }
        
        .title, .subtitle {
            text-align: center;
        }
    }
</style>
