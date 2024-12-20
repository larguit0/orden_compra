<?php
// Verificar si la sesión ya está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$id_orden = isset($_GET['id']) ? $_GET['id'] : null;
$proyecto = isset($_GET['proyecto']) ? $_GET['proyecto'] : null;
// Aquí puedes continuar procesando el ID del proyecto y mostrar la información necesaria


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
            <img src="<?php echo APP_URL; ?>app/views/img/logoAcema.png" alt="Logo ACEMA">
        </div>
        <div class="info">
            <p>ACEMA INGENIERIA SAS</p>
            <p>NIT: 901635197</p>
            <p>facturas@acemaingenieria.com</p>
        </div>
        <?php
            $sql = "SELECT consecutivo FROM orden_compra 
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

    <form action="<?php echo APP_URL; ?>app/controller/rechazarController.php" method="POST">
        <!-- DATOS OCULTOS DEL FORMULARIO PARA HACER EL PASO DE INFORMACION EN TABLAS (EN HIDDEN TODO ESTOS)  -->
        <div class="form-container" style="display:none">
            <div class="form-column"  >
                <!-- Proyecto -->
                <div class="form-row">
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
                
                    <!-- orden -->
                    <input type="text" id="orden" name="id_orden" value="<?php echo $id_orden; ?>">

                    <!-- Consecutivo -->
                    <input type="hidden" id="consecutivo" name="consecutivo" value="<?php echo $valor_placeholderCons; ?>">
                    <!-- id_Proyecto -->
                    <input type="hidden" id="id_proyecto" name="id_proyecto" value="<?php echo htmlspecialchars($valor_placeholder1); ?>">
                    <input type="hidden" id="proyecto" name="proyecto" value="<?php echo htmlspecialchars($valor_placeholder); ?>" class="form-input" placeholder="<?php echo htmlspecialchars($valor_placeholder); ?>">
                </div>

                <!-- Código Orden -->
                <div class="form-row">
                    <?php
                        $sql = "SELECT oc.codigo_orden FROM aprobaciones ap 
                                INNER JOIN orden_compra oc ON ap.id_orden_compra = oc.id 
                                INNER JOIN proyecto p ON oc.id_proyecto = p.id 
                                INNER JOIN usuario u ON oc.persona = u.id 
                                INNER JOIN estado e ON ap.id_estado = e.id 
                                WHERE ap.id_orden_compra = :id_compra";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(':id_compra', $id_orden);
                        $stmt->execute();
                        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                        $valorCodigo = $resultado ? $resultado['codigo_orden'] : '';
                    ?>
                    <!-- id  de la orden compra(no se usa en la bd) -->
                    <input type="hidden"  name="id_ordenCompra" value="<?php echo htmlspecialchars($id_orden); ?>">
                    
                    <!-- numero  de la orden compra(SI se usa en la bd) -->
                    <input type="hidden" id="codigo_orden" name="codigo_orden" value="<?php echo htmlspecialchars($valorCodigo); ?>" class="form-input">
                </div>

                <!-- Responsable Técnico -->
                <div class="form-row">
                    <?php
                        $sql = "SELECT u.nombre, u.apellido, u.id 
                        FROM orden_compra oc
                        INNER JOIN usuario u ON oc.persona = u.id 
                        INNER JOIN aprobaciones ap ON ap.id_orden_compra = oc.id
                        INNER JOIN proyecto p ON oc.id_proyecto = p.id 
                        INNER JOIN estado e ON ap.id_estado = e.id
                        WHERE oc.id = :id_compra";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(':id_compra', $id_orden);
                        $stmt->execute();
                        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                        $valor_placeholder = $resultado ? $resultado['nombre'] : '';
                        $valor_placeholderJ = $resultado ? $resultado['apellido'] : '';
                        $valor_placeholder1 = $resultado ? $resultado['id'] : '';
                    ?>
                    <!-- IID PERSONA QUE HIZO EL REQUERIMIENTO DE LA OC -->
                    <input type="hidden" id="person" name="persona" value="<?php echo htmlspecialchars($valor_placeholder1); ?>">
                    <input type="hidden" id="telefono" name="personax" value="<?php echo htmlspecialchars($valor_placeholder . " " . $valor_placeholderJ); ?>" class="form-input">
                </div>
                <!-- Persona que hizo la OC -->
                <div class="form-row">
                    <?php
                        $sql = "SELECT u.nombre, u.apellido, u.id 
                        FROM orden_compra oc
                        INNER JOIN usuario u ON oc.compra_per = u.id 
                        WHERE oc.id = :id_compra";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(':id_compra', $id_orden);
                        $stmt->execute();
                        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                        $valor_placeholder = $resultado ? $resultado['nombre'] : '';
                        $valor_placeholderJ = $resultado ? $resultado['apellido'] : '';
                        $valor_placeholder1 = $resultado ? $resultado['id'] : '';
                    ?>
                    <!-- Persona encargada de hacer las ordenes de compra  -->
                    <input type="hidden" id="person" name="compra_per" value="<?php echo htmlspecialchars($valor_placeholder1); ?>">
                </div>

                <!-- Director Proyecto -->
                <div class="form-row">
                    <?php
                        $sql = "SELECT u.nombre, u.apellido, u.id FROM orden_compra oc 
                                INNER JOIN aprobaciones ap ON oc.id = ap.id_orden_compra
                                INNER JOIN usuario u ON u.id = oc.id_tecnico 
                                WHERE ap.id_orden_compra = :id_compra";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(':id_compra', $id_orden);
                        $stmt->execute();
                        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                        $valor_placeholder = $resultado ? $resultado['nombre'] : '';
                        $valor_placeholder1 = $resultado ? $resultado['apellido'] : '';
                        $valor_placeholder2 = $resultado ? $resultado['id'] : '';
                    ?>
                    <!-- ID del Director Proyecto -->
                    <input type="hidden" id="id_tecnico" name="id_tecnico" value="<?php echo htmlspecialchars($valor_placeholder2); ?>">
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
                        $valor_placeholder1 = $resultado ? $resultado['id'] : '2';


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
                <div  class="form-row" style = "display: none">
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


        <!-- FIN DE DATOS INTERACTIVOS -->


        <!-- VISTA INTERACTIVA DE LA INTERFAZ -->
        <div class="form-container">
            <div class="form-column">
                <h1><strong>RECHAZAR ORDEN COMPRA</strong></h1>
                
                <!-- Proyecto -->


                <div class="form-row">
                <label for="proyecto" class="form-label">Número de orden</label>
                    <?php
                        $sql = "SELECT oc.codigo_orden FROM aprobaciones ap 
                                INNER JOIN orden_compra oc ON ap.id_orden_compra = oc.id 
                                INNER JOIN proyecto p ON oc.id_proyecto = p.id 
                                INNER JOIN usuario u ON oc.persona = u.id 
                                INNER JOIN estado e ON ap.id_estado = e.id 
                                WHERE ap.id_orden_compra = :id_compra";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(':id_compra', $id_orden);
                        $stmt->execute();
                        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                        $valorCodigo = $resultado ? $resultado['codigo_orden'] : '';
                    ?>
                    <!-- id  de la orden compra(no se usa en la bd) -->
                    <input type="hidden"  name="id_ordenCompra" value="<?php echo htmlspecialchars($id_orden); ?>">
                    
                    <!-- numero  de la orden compra(SI se usa en la bd) -->
                    <input type="text" id="codigo_ordeng" name="codigo_ordeng" value="<?php echo htmlspecialchars($valorCodigo); ?>" class="form-input" require>
                </div>


                <!-- Descripción -->
                <div class="form-row">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea id="descripcion" name="descripcion" class="form-input" rows="4" placeholder="Descripcion del rechazo de la Orden"></textarea>
                </div>

                <div class="form-row">
                    <input type="hidden" name="id_orden" value="<?php echo htmlspecialchars($id_orden); ?>">
                    <input type="hidden" name="id_rol" value="<?php echo htmlspecialchars($_SESSION['id_rol']); ?>">
                            
                    <!-- Botón Rechazar-->
                    <button type="submit" name="action" value="aprobar" class="btn-approve">rechazar</button>
                            
    
                </div>

                
                
            </div>
        </div>

    </form>
</body>
<style>
    h1{
        text-align: center;
        margin:2px;
    }
    input, textarea {
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
