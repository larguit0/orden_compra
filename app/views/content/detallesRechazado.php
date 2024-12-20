<?php
// Verificar si la sesión ya está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$id_orden = isset($_GET['id']) ? $_GET['id'] : null;
$proyecto = isset($_GET['proyecto']) ? $_GET['proyecto'] : null;


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
        <?php
            $sql = "SELECT consecutivo FROM orden_compra_rechazada 
                WHERE id = :id_compra";
                $stmt = $conn->prepare($sql);
                        $stmt->bindParam(':id_compra', $id_orden);
                        $stmt->execute();
                        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                        $valor_placeholderCons = $resultado ? $resultado['consecutivo'] : '';
            ?>
        <div class="codigo">
            <p><strong>N°</strong> OC<?php echo $valor_placeholderCons;?></p>
        </div>
    </div>

    <form action="<?php echo APP_URL; ?>app/controller/detallesRechazarController.php" method="POST">
        <!-- DATOS OCULTOS DEL FORMULARIO PARA HACER EL PASO DE INFORMACION EN TABLAS (EN HIDDEN TODO ESTOS)  -->
        <div class="form-container">
            <div class="form-column"  >
                <!-- Proyecto -->
                <div class="form-row">
                <label for="proyecto" class="form-label">Proyecto</label>

                    <?php
                        $sql = "SELECT p.nombre FROM orden_compra_rechazada r INNER JOIN 
                        proyecto p ON  r.id_proyecto = p.id  WHERE r.id = :id_compra ";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(':id_compra', $id_orden);
                        $stmt->execute();
                        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                        $valor_placeholder = $resultado ? $resultado['nombre'] : '';
                    ?>
                
                    <!-- orden -->
                    <input class="form-input"  type="text" id="proyecto_nombre" name="proyecto_nombre" value="<?php echo $valor_placeholder; ?>">

                </div>

                <!-- Código Orden -->
                <div class="form-row">
                    <label for="proyecto" class="form-label">Codigo Orden</label>

                    <?php
                        $sql = "SELECT id_codigo_orden FROM orden_compra_rechazada WHERE id= :id_compra";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(':id_compra', $id_orden);
                        $stmt->execute();
                        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                        $valorCodigo = $resultado ? $resultado['id_codigo_orden'] : '';
                    ?>
                    <!-- numero de la orden que ha sido rechazada -->                    
                    <input type="text" id="codigo_orden" name="codigo_orden" value="<?php echo htmlspecialchars($valorCodigo); ?>" class="form-input">
                </div>

                <!-- Responsable Técnico -->
                <div class="form-row">
                    <label for="proyecto" class="form-label">Proveedor</label>

                    <?php
                        $sql = "SELECT p.nombre FROM orden_compra_rechazada r INNER JOIN 
                        proveedor p ON r.id_proveedor = p.id WHERE r.id = :id_compra";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(':id_compra', $id_orden);
                        $stmt->execute();
                        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                        $nombre = $resultado ? $resultado['nombre'] : '';

                    ?>
                    <!-- IID PERSONA QUE HIZO EL REQUERIMIENTO DE LA OC -->
                    <input type="text" id="telefono" name="provedor" value="<?php echo htmlspecialchars($nombre); ?>" class="form-input">
                </div>
                <!-- Persona que hizo la OC -->
                <div class="form-row">
                    <label for="proyecto" class="form-label">Valor</label>

                    <?php
                        $sql = "SELECT valor 
                        FROM orden_compra_rechazada 
                        WHERE id = :id_compra";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(':id_compra', $id_orden);
                        $stmt->execute();
                        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                        $valor = $resultado ? $resultado['valor'] : '';
                    ?>
                    <!-- Persona encargada de hacer las ordenes de compra  -->
                    <input type="text" id="person" name="valor" value="<?php echo htmlspecialchars($valor); ?>" class="form-input">
                </div>

                <!-- Director Proyecto -->
                <div class="form-row">
                    <label for="proyecto" class="form-label">Descripción </label>

                    <?php
                        $sql = "SELECT descripcion FROM orden_compra_rechazada WHERE  id = :id_compra";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(':id_compra', $id_orden);
                        $stmt->execute();
                        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                        $valor_placeholder = $resultado ? $resultado['descripcion'] : '';

                    ?>
                    <!-- ID del Director Proyecto -->
                    <input type="text" id="id_tecnico" name="id_tecnico" value="<?php echo htmlspecialchars($valor_placeholder); ?>"class="form-input">
                </div>
                
                <!--proveedor-->
                <div class="form-row">
                    <?php
                        $sql = "SELECT p.nombre,p.id  FROM orden_compra o
                                INNER JOIN proveedor p ON o.id_proveedor = p.id
                                WHERE o.id = :id_compra";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(':id_compra', $id_orden);
                        $stmt->execute();
                        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                        $valor_placeholder = $resultado ? $resultado['nombre'] : '';
                        $valor_placeholder1 = $resultado ? $resultado['id'] : '';


                    ?>
                    <!--id proveedor para la bd-->
                    <input type="hidden" name="id_provedor" value="<?php echo $valor_placeholder1; ?>" class="form-input">



                </div>

                <!-- Valor Total -->
                <div class="form-row">
                    <?php
                        $sql = "SELECT oc.valor FROM orden_compra oc 
                                INNER JOIN aprobaciones ap ON oc.id = ap.id_orden_compra
                                INNER JOIN usuario u ON u.id = oc.id_tecnico 
                                WHERE ap.id_orden_compra = :id_compra";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(':id_compra', $id_orden);
                        $stmt->execute();
                        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                        $valor_placeholder = $resultado ? $resultado['valor'] : '';
                    ?>
                    <!--id del Valor Total -->
                    <input type="hidden" name="valor" value="<?php echo $valor_placeholder; ?>" class="form-input">

                </div>




                <!-- Tabla de Items -->
                <div  class="form-row" >
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
                                    $sql = "SELECT r.codigo_item,r.item,r.cantidad,r.descuento,r.valor 
                                            FROM rechazada_item r 
                                            INNER JOIN orden_compra_rechazada oc ON r.id_orden_compra_rechazada  = oc.id 
                                            WHERE oc.id = :id";
                                    
                                    $stmt = $conn->prepare($sql);
                                    $stmt->bindParam(':id', $id_orden);
                                    $stmt->execute();

                                    // Generar las filas de la tabla
                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                        echo '<tr>';
                                        echo '<td> ' . $row['codigo_item'] . '</td>';
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
            </div>
        </div>
        <div class="form-row" >
                    <input type="hidden" name="id_orden" value="<?php echo htmlspecialchars($id_orden); ?>">
                    <input type="hidden" name="id_rol" value="<?php echo htmlspecialchars($_SESSION['id_rol']); ?>">
                            
                    <!-- Botón Rechazar-->
                    <button type="submit" name="action" value="aprobar" class="btn-approve">Atras</button>
                            
    
         </div>


        <!-- FIN DE DATOS INTERACTIVOS -->








                
                
            </div>
        </div>

    </form>
</body>
<style>
/* Estilos Generales */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

.container, .form-container {
    width: 90%;
    margin: 0 auto;
    padding: 10px;
    max-width: 1200px;
}

.logo img {
    width: 100px;
    height: auto;
}

.info p {
    margin: 2px;
    text-align: center;
    font-size: 14px;
}

.codigo {
    text-align: center;
    font-size: 18px;
    margin-top: 10px;
}

.form-container {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.form-row {
    display: flex;
    margin: 10px 0;
}
button.btn-approve {

    text-align: center;
}



/* Tabla de Items */
.result-container {
    width: 100%;
    overflow-x: auto;
    margin-top: 15px;
}

.table {
    width: 100%;
    border-collapse: collapse;
}

.table-header {
    background-color: #f2f2f2;
}

th, td {
    padding: 10px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

.btn-approve {
    width: 100%;
    padding: 10px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    text-align: center;
}

/* Estilos Responsivos */
@media (max-width: 768px) {
    .info p {
        font-size: 12px;
    }

    .form-container, .table-container {
        width: 100%;
    }

    .form-row {
        flex-direction: column;
    }

    .form-input {
        width: 80%;
    }

    .btn-approve {
        font-size: 14px;
    }
}

@media (max-width: 480px) {
    .logo img {
        width: 80px;
    }

    .info p, .codigo {
        font-size: 12px;
    }

    th, td {
        padding: 8px;
        font-size: 12px;
    }
}

</style>
</html>
