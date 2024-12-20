<?php
// Verificar si la sesión ya está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$id_orden = isset($_GET['id']) ? $_GET['id'] : null;
$proyecto = isset($_GET['proyecto']) ? $_GET['proyecto'] : null;
// Aquí puedes continuar procesando el ID del proyecto y mostrar la información necesaria
echo "Orden de compra para el proyecto ID: " . $id_orden;
echo "proyecto: " . $proyecto;
echo "Su rol es " . $_SESSION['id_rol'];

// Incluir la clase server.php para usar la conexión
require_once __DIR__ . '/../../../config/server.php'; // Ajusta la ruta según la estructura de tu proyecto

// Establecer la conexión
$conn = Database::connect();

$rolTec = 2;
$rolCola = 7;
$rolGerente = 4;
$rolDirector = 3;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo APP_URL; ?>app/views/css/form-orden.css">
    <title>ACEMA INGENIERÍA SAS</title>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="https://erp-acema.com/images/Logo-acema-sin%20fondo.png" alt="Logo ACEMA">
        </div>
        <div class="info">
            <p>ACEMA INGENIERIA SAS</p>
            <p>NIT: 901635197</p>
            <p>facturas@acemaingenieria.com</p>
        </div>
        <div class="codigo">
            <p><strong>N°</strong> OC101</p>
        </div>
    </div>

    <form >
        <div class="form-container">
            <div class="form-column">
                <!-- Proyecto -->
                <div class="form-row">
                    <label for="proyecto" class="form-label">Proyecto</label>
                    <?php
                        $sql = "SELECT p.id, p.nombre FROM aprobaciones ap 
                                INNER JOIN orden_compra oc ON ap.id_orden_compra = oc.id 
                                INNER JOIN proyecto p ON oc.id_proyecto = p.id 
                                INNER JOIN usuario u ON oc.persona = u.id 
                                INNER JOIN estado e ON ap.id_estado = e.id 
                                WHERE ap.id_orden_compra = :id_compra";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(':id_compra', $id_orden);
                        $stmt->execute();
                        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                        $valor_placeholder = $resultado ? $resultado['nombre'] : '';
                        $valor_placeholder1 = $resultado ? $resultado['id'] : '';
                    ?>
                    <input type="hidden" id="id_proyecto" name="id_proyecto" value="<?php echo htmlspecialchars($valor_placeholder1); ?>">
                    <input type="text" id="proyecto" name="proyecto" value="<?php echo htmlspecialchars($valor_placeholder); ?>" class="form-input" placeholder="<?php echo htmlspecialchars($valor_placeholder); ?>">
                </div>

                <div class="form-column">
                    <div class="form-row">
                        <label for="codigo_orden" class="form-label">Tecnico </label>
                        <?php
                            $sql = "SELECT u.nombre,u.apellido FROM proyecto_asignado pa
                                    INNER JOIN usuario u ON u.id = pa.id_lider 
                                    WHERE u.id_rol = :rol AND pa.id_proyecto = :id_proyecto";
                            $stmt = $conn->prepare($sql);
                            $stmt->bindParam(':id_proyecto', $proyecto);
                            $stmt->bindParam(':rol', $rolTec);
                            $stmt->execute();
                            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                            $nombre = $resultado ? $resultado['nombre'] : '';
                            $apellido = $resultado ? $resultado['apellido'] : '';

                        ?>
                        <input type="text"  name="id_ordenCompra" value="<?php echo htmlspecialchars($nombre.' '.$apellido); ?>">
                    </div>
                    <div class="form-row">
                        <label for="codigo_orden" class="form-label">Estado </label>
                        <?php
                            $sql = "SELECT e.estado FROM aprobaciones ap
                                    INNER JOIN estado e ON e.id = id_estado
                                    INNER JOIN usuario u ON ap.id_aprobador = u.id
                                    WHERE ap.id_orden_compra = :id AND u.id_rol = 2";
                            $stmt = $conn->prepare($sql);
                            $stmt->bindParam(':id', $id_orden);
                            $stmt->execute();
                            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                            $estado = $resultado ? $resultado['estado'] : 'pendiente';
                        ?>
                        <input type="text"  name="id_ordenCompra" value="<?php echo htmlspecialchars($estado); ?>">
                    </div>
                    <div class="form-row">
                        <label for="codigo_orden" class="form-label">Fecha </label>
                        <?php
                            $sql = "SELECT ap.fecha_aprobacion FROM aprobaciones ap
                                    INNER JOIN usuario u ON ap.id_aprobador = u.id
                                    WHERE ap.id_orden_compra = :id AND u.id_rol = 2";
                            $stmt = $conn->prepare($sql);
                            $stmt->bindParam(':id', $id_orden);
                            $stmt->execute();
                            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                            $fecha = $resultado ? $resultado['fecha_aprobacion'] : 'sin fecha';
                        ?>
                        <input type="text"  name="id_ordenCompra" value="<?php echo htmlspecialchars($fecha); ?>">
                    </div>
                </div> 

                <div class="form-column">
                    <div class="form-row">
                        <label for="codigo_orden" class="form-label">Director </label>
                        <?php
                            $sql = "SELECT u.nombre,u.apellido FROM proyecto_asignado pa
                                    INNER JOIN usuario u ON u.id = pa.id_lider 
                                    WHERE u.id_rol = :rol AND pa.id_proyecto = :id_proyecto";
                            $stmt = $conn->prepare($sql);
                            $stmt->bindParam(':id_proyecto', $proyecto);
                            $stmt->bindParam(':rol', $rolDirector);
                            $stmt->execute();
                            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                            $nombre = $resultado ? $resultado['nombre'] : '';
                            $apellido = $resultado ? $resultado['apellido'] : '';

                        ?>
                        <input type="text"  name="id_ordenCompra" value="<?php echo htmlspecialchars($nombre.' '.$apellido); ?>">
                    </div>
                    <div class="form-row">
                        <label for="codigo_orden" class="form-label">Estado </label>
                        <?php
                            $sql = "SELECT e.estado FROM aprobaciones ap
                                    INNER JOIN estado e ON e.id = id_estado
                                    INNER JOIN usuario u ON ap.id_aprobador = u.id
                                    WHERE ap.id_orden_compra = :id AND u.id_rol = 3";
                            $stmt = $conn->prepare($sql);
                            $stmt->bindParam(':id', $id_orden);
                            $stmt->execute();
                            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                            $estado = $resultado ? $resultado['estado'] : 'pendiente';
                        ?>
                        <input type="text"  name="id_ordenCompra" value="<?php echo htmlspecialchars($estado); ?>">
                    </div>
                    <div class="form-row">
                        <label for="codigo_orden" class="form-label">Fecha </label>
                        <?php
                            $sql = "SELECT ap.fecha_aprobacion FROM aprobaciones ap
                                    INNER JOIN usuario u ON ap.id_aprobador = u.id
                                    WHERE ap.id_orden_compra = :id AND u.id_rol = 3";
                            $stmt = $conn->prepare($sql);
                            $stmt->bindParam(':id', $id_orden);
                            $stmt->execute();
                            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                            $fecha = $resultado ? $resultado['fecha_aprobacion'] : 'sin Fecha';
                        ?>
                        <input type="text"  name="id_ordenCompra" value="<?php echo htmlspecialchars($fecha); ?>">
                    </div>
                </div> 
                <div class="form-column">
                    <div class="form-row">
                        <label for="codigo_orden" class="form-label">Gerente Proyecto </label>
                        <?php
                            $sql = "SELECT u.nombre,u.apellido FROM usuario u
                                    INNER JOIN aprobaciones ap ON  ap.id_aprobador = u.id
                                    INNER JOIN orden_compra oc ON oc.id = ap.id_orden_compra
                                    WHERE u.id_rol = :rol AND oc.id_proyecto = :id_proyecto";
                            $stmt = $conn->prepare($sql);
                            $stmt->bindParam(':id_proyecto', $proyecto);
                            $stmt->bindParam(':rol', $rolGerente);
                            $stmt->execute();
                            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                            $nombre = $resultado ? $resultado['nombre'] : '';
                            $apellido = $resultado ? $resultado['apellido'] : '';

                        ?>
                        <input type="text"  name="id_ordenCompra" value="<?php echo htmlspecialchars($nombre.' '.$apellido); ?>">
                    </div>
                    <div class="form-row">
                        <label for="codigo_orden" class="form-label">Estado </label>
                        <?php
                            $sql = "SELECT e.estado FROM aprobaciones ap
                                    INNER JOIN estado e ON e.id = id_estado
                                    INNER JOIN usuario u ON ap.id_aprobador = u.id
                                    WHERE ap.id_orden_compra = :id AND u.id_rol = 3";
                            $stmt = $conn->prepare($sql);
                            $stmt->bindParam(':id', $id_orden);
                            $stmt->execute();
                            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                            $estado = $resultado ? $resultado['estado'] : 'pendiente';
                        ?>
                        <input type="text"  name="id_ordenCompra" value="<?php echo htmlspecialchars($estado); ?>">
                    </div>
                    <div class="form-row">
                        <label for="codigo_orden" class="form-label">Fecha </label>
                        <?php
                            $sql = "SELECT ap.fecha_aprobacion FROM aprobaciones ap
                                    INNER JOIN usuario u ON ap.id_aprobador = u.id
                                    WHERE ap.id_orden_compra = :id AND u.id_rol = 3";
                            $stmt = $conn->prepare($sql);
                            $stmt->bindParam(':id', $id_orden);
                            $stmt->execute();
                            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                            $fecha = $resultado ? $resultado['fecha_aprobacion'] : 'sin Fecha';
                        ?>
                        <input type="text"  name="id_ordenCompra" value="<?php echo htmlspecialchars($fecha); ?>">
                    </div>
                </div> 



                <!-- Tabla de Items -->
                <div class="form-row">
                    <section class="result-container">
                        <div id="results" class="container">
                            <table class="table is-striped">
                                <thead>
                                    <tr class="table-header">
                                        <th>Código</th>
                                        <th>Item</th>
                                        <th>Cantidad</th>
                                        <th>Descuento</th>
                                        <th>Valor Item</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Consulta para obtener los ítems
                                    $sql = "SELECT i.codigo_item,i.item,i.cantidad,i.descuento,i.valor 
                                            FROM item_compra i 
                                            INNER JOIN orden_compra oc ON i.id_orden = oc.id 
                                            WHERE oc.id = :id";
                                    
                                    $stmt = $conn->prepare($sql);
                                    $stmt->bindParam(':id', $id_orden);
                                    $stmt->execute();

                                    // Generar las filas de la tabla
                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                        echo '<tr>';
                                        echo '<td>' . $row['codigo_item'] . '</td>';
                                        echo '<td>' . $row['item'] . '</td>';
                                        echo '<td>' . $row['cantidad'] . '</td>';
                                        echo '<td>' . $row['descuento'] . '</td>';
                                        echo '<td>' . number_format($row['valor'], 2, ',', '.') . '</td>';
                                        echo '</tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </section>
                </div>
                <!-- BOTONES DE MANIPULACION -->
 
            </div>
        </div>

    </form>
</body>
<style>

    input {
        width: 25%;
        padding: 5px;
    }

    .table-container {
        width: 80%; /* Ancho ajustable */
        margin: 20px auto; /* Centra la tabla horizontalmente */
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #f2f2f2;
    }
</style>
</html>
<style>
    /* Estilos básicos */
body, .container {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 0 1rem;
    margin: 0;
}

.logo img {
    width: 100px;
    height: auto;
}

.info, .codigo {
    text-align: center;
    margin: 1rem 0;
}

.form-container {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    width: 100%;
    max-width: 800px;
}

.form-column {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.form-row {
    display: flex;
    flex-direction: column;
}

.form-label {
    font-weight: bold;
    margin-bottom: 0.25rem;
}

.form-input {
    padding: 0.5rem;
    font-size: 1rem;
    width: 100%;
}

.table {
    width: 100%;
    margin-top: 1rem;
    border-collapse: collapse;
}

.table-header, .table th, .table td {
    padding: 0.5rem;
    text-align: center;
    border: 1px solid #ccc;
}

/* Estilos responsivos */
@media (min-width: 600px) {
    .form-container {
        flex-direction: row;
        flex-wrap: wrap;
    }
    
    .form-column {
        flex: 1;
        min-width: 280px;
    }
}

@media (max-width: 600px) {
    .form-container, .form-column, .form-row {
        width: 100%;
    }

    .table {
        font-size: 0.9rem;
    }
}

</style>