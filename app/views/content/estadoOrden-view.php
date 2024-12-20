<?php
// Verificar si la sesión ya está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Incluir la clase server.php para usar la conexión
require_once __DIR__ . '/../../../config/server.php'; // Ajusta la ruta según la estructura de tu proyecto

// Establecer la conexión
$conn = Database::connect();

$id_estado = 1;
$id_aprobador = $_SESSION['id'];
?>

<div class="main content">
    <section class="buscar-container">
        <!-- Buscador -->
        <div class="buscar-bar">
            <input class="input" type="text" name="busqueda" id="buscar" placeholder="BUSQUE APROBACIONES">
            <button onclick="search()" class="button is-info is-rounded">Buscar</button>
        </div>
    </section>

    <section class="result-container">
        <div id="results" class="container">
            <table class="table is-striped">
                <thead>
                    <tr>
                        <th>ID Orden</th>
                        <th>Persona</th>
                        <th>Proyecto</th>
                        <th>Valor</th>
                        <th>Tecnico</th>
                        <th>Director</th>
                        <th>Gerente Proyectos</th>
                        <th>Gerente</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Consulta para obtener las aprobaciones
                    $sql = "SELECT 
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
                                       WHERE u.id_rol = 1) AS gerente ON gerente.id_orden_compra = oc.id";

                    $stmt = $conn->prepare($sql);
                    $stmt->execute();

                    // Generar las filas de la tabla
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo '<tr>';
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
                    ?>
                </tbody>
            </table>
        </div>
    </section>
</div>
