<?php
// Verificar si la sesión ya está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Conexión a la base de datos
// Conexión a la base de datos
require_once __DIR__ . '/../../config/server.php'; // Ruta a la clase server.php
$conn = Database::connect();

if (isset($_POST['id_proyecto']) && !empty($_POST['id_proyecto'])) {
    $id_proyecto = $_POST['id_proyecto'];
} else {
    die("Proyecto no seleccionado");
}
require_once __DIR__ . '/../../config/app.php';// Verificar si la sesión está iniciada


// Parámetros de paginación
$itemsPorPagina = 15;
$page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
$offset = ($page - 1) * $itemsPorPagina;

// Calcular el número total de ítems
$sqlCount = "SELECT COUNT(*) as total FROM inventario i 
             INNER JOIN compra_item ci ON i.id_compra_item = ci.id
             INNER JOIN compra c ON c.id = ci.id_compra
             WHERE c.proyecto = :id_proyecto";

$stmtCount = $conn->prepare($sqlCount);
$stmtCount->bindParam(':id_proyecto', $id_proyecto);
$stmtCount->execute();
$totalItems = $stmtCount->fetch(PDO::FETCH_ASSOC)['total'];
$totalPaginas = ceil($totalItems / $itemsPorPagina);

// Consulta para obtener los resultados paginados
$sql = "SELECT ci.codigo_item, ci.item, i.cantidad, u.ubicacion 
        FROM inventario i 
        INNER JOIN compra_item ci ON i.id_compra_item = ci.id 
        INNER JOIN compra c ON c.id = ci.id_compra 
        INNER JOIN ubicacion u ON u.id = i.ubicacion 
        WHERE c.proyecto = :id_proyecto 
        ORDER BY ci.codigo_item ASC 
        LIMIT :offset, :itemsPorPagina";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':id_proyecto', $id_proyecto, PDO::PARAM_INT);
$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
$stmt->bindParam(':itemsPorPagina', $itemsPorPagina, PDO::PARAM_INT);
$stmt->execute();
?>

<div class="main-content">
    <div class="space"></div>

    <section class="result-container">
        <div id="results" class="container">
            <table class="table is-striped">
                <?php if ($totalItems > 0): ?>
                    <thead>
                        <tr>
                            <th>Codigo</th>
                            <th>Item</th>
                            <th>Cantidad</th>
                            <th>Ubicación</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                            <tr>
                                <td data-label="Codigo"><?php echo htmlspecialchars($row['codigo_item']); ?></td>
                                <td data-label="Item"><?php echo htmlspecialchars($row['item']); ?></td>
                                <td data-label="Cantidad"><?php echo htmlspecialchars($row['cantidad']); ?></td>
                                <td data-label="Ubicación"><?php echo htmlspecialchars($row['ubicacion']); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                <?php else: ?>
                    <div class="main-container">
                        <section class="hero-body">
                            <div class="hero-body">
                                <p class="title">Sin Registros</p>
                                <p class="subtitle">No hay ítems de inventario para este proyecto</p>
                            </div>
                        </section>
                    </div>
                <?php endif; ?>
            </table>

            <!-- Paginación -->
            <nav class="pagination">
                <ul>
                    <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                        <li class="<?php echo ($i == $page) ? 'active' : ''; ?>"><a href="#" onclick="loadForm(<?php echo $i; ?>)"><?php echo $i; ?></a></li>
                    <?php endfor; ?>
                </ul>
            </nav>
        </div>
    </section>
</div>

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

    .pagination ul {
    list-style: none;
    padding: 0;
    display: flex;
    justify-content: center;
    margin-top: 20px;
    flex-wrap: nowrap; /* Asegura que los elementos no se envuelvan */
    overflow-x: auto;  /* Habilita el desplazamiento horizontal si es necesario */
    white-space: nowrap; /* Evita saltos de línea dentro del contenedor */
}

.pagination ul li {
    margin: 0 5px;
}

.pagination ul li a {
    text-decoration: none;
    padding: 8px 12px;
    background-color: #f4f4f4;
    color: #333;
    border: 1px solid #ddd;
    border-radius: 5px;
    transition: background-color 0.3s ease, color 0.3s ease, box-shadow 0.3s ease;
}

.pagination ul li a:hover {
    background-color: #007bff;
    color: #fff;
    box-shadow: 0px 4px 8px rgba(0, 123, 255, 0.2);
}

.pagination ul li.active a {
    background-color: #007bff;
    color: #fff;
    box-shadow: 0px 4px 8px rgba(0, 123, 255, 0.2);
}

    /* Responsive */
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
