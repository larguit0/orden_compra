<?php
// Verificar si la sesión ya está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$id_orden = isset($_GET['id']) ? $_GET['id'] : null;

// Aquí puedes continuar procesando el ID del proyecto y mostrar la información necesaria

// Incluir la clase server.php para usar la conexión
require_once __DIR__ . '/../../../config/server.php'; // Ajusta la ruta según la estructura de tu proyecto

// Establecer la conexión
$conn = Database::connect();
$rolDir = 3;
$rolCola = 7;
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

    <form action="<?php echo APP_URL; ?>app/controller/detallesController.php" method="POST">
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
                    <!-- Consectuvi de la oc-->

                    <input type="hidden" id="consecutivo" name="consecutivo" value="<?php echo htmlspecialchars($valor_placeholderCons); ?>">

                    <input type="hidden" id="id_proyecto" name="id_proyecto" value="<?php echo htmlspecialchars($valor_placeholder1); ?>">
                    <input readonly type="text" id="proyecto" name="proyecto" value="<?php echo htmlspecialchars($valor_placeholder); ?>" class="form-input" placeholder="<?php echo htmlspecialchars($valor_placeholder); ?>">
                </div>

                <!-- Código Orden -->
                <div class="form-row">
                    <label for="codigo_orden" class="form-label">Código Orden</label>
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
                    <input type="hidden"  name="id_ordenCompra" value="<?php echo htmlspecialchars($id_orden); ?>">

                    <input type="text" id="codigo_orden" name="codigo_orden" value="<?php echo htmlspecialchars($valorCodigo); ?>" class="form-input">
                </div>

                <!-- Responsable Técnico -->
                <div class="form-row">
                    <label for="telefono" class="form-label">Responsable Técnico</label>
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
                    <input type="hidden" id="person" name="persona" value="<?php echo htmlspecialchars($valor_placeholder1); ?>">
                    <input type="text" id="telefono" name="personax" value="<?php echo htmlspecialchars($valor_placeholder . " " . $valor_placeholderJ); ?>" class="form-input">
                </div>
                <!-- Persona que hizo la OC -->
                <div class="form-row">
                    <label for="telefono" class="form-label">Responsable Orden Compra</label>
                    <?php
                        $sql = "SELECT u.nombre,u.correo, u.apellido, u.id 
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
                        $correo = $resultado ? $resultado['correo'] : '';

                    ?>
                    <input type="hidden" id="person" name="correoRes" value="<?php echo htmlspecialchars($correo); ?>">
                    <input type="hidden" id="person" name="persona" value="<?php echo htmlspecialchars($valor_placeholder1); ?>">
                    <input type="text" id="telefono" name="personax" value="<?php echo htmlspecialchars($valor_placeholder . " " . $valor_placeholderJ); ?>" class="form-input">
                </div>

                <!-- Director Proyecto -->
                <div class="form-row">
                    <label for="tecnico" class="form-label">Director Proyecto</label>
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
                    <input type="hidden" id="id_tecnico" name="id_tecnico" value="<?php echo htmlspecialchars($valor_placeholder2); ?>">
                    <input type="text" id="tecnico" name="tecnico" value="<?php echo htmlspecialchars($valor_placeholder . " " . $valor_placeholder1); ?>" class="form-input">
                </div>

                <!-- CENTRO COSTOS  -->
                <div class="form-row">
                    <label for="centro_costos" class="form-label">Centro Costos</label>
                    <?php
                        $sql = "SELECT centro_costos FROM orden_compra 
                                WHERE id = :id_compra";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(':id_compra', $id_orden);
                        $stmt->execute();
                        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                        $valor_placeholder = $resultado ? $resultado['centro_costos'] : '';
                    ?>
                    <input type="text" id="tecnico" name="centro_costos" value="<?php echo htmlspecialchars($valor_placeholder); ?>" class="form-input">
                </div>
                
                <!--proveedor-->
                <div class="form-row">
                <label for="telefono" class="form-label">Proveedor</label>

                    <?php
                        $sql = "SELECT p.nombre  FROM orden_compra o
                                INNER JOIN proveedor p ON o.id_proveedor = p.id
                                WHERE o.id = :id_compra";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(':id_compra', $id_orden);
                        $stmt->execute();
                        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                        $valor_placeholder = $resultado ? $resultado['nombre'] : '';

                    ?>
                    <input type="text" name="id_provedor" value="<?php echo $valor_placeholder; ?>" class="form-input">


                </div>
                <!--forma de pago-->

                <div class="form-row">
                <label for="telefono" class="form-label">Forma de Pago</label>

                    <?php
                        $sql = "SELECT forma_pago  FROM orden_compra 
                                WHERE id = :id_compra";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(':id_compra', $id_orden);
                        $stmt->execute();
                        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                        $valor_placeholder = $resultado ? $resultado['forma_pago'] : '';

                    ?>
                    <input type="text" name="forma_pago" value="<?php echo $valor_placeholder; ?>" class="form-input">


                </div>
                <!--lugar de entrega-->

                <div class="form-row">
                <label for="telefono" class="form-label">Lugar de Entrega</label>

                    <?php
                        $sql = "SELECT lugar_entrega  FROM orden_compra 
                                WHERE id = :id_compra";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(':id_compra', $id_orden);
                        $stmt->execute();
                        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                        $valor_placeholder = $resultado ? $resultado['lugar_entrega'] : '';

                    ?>
                    <input type="text" name="lugar_entrega" value="<?php echo $valor_placeholder; ?>" class="form-input">


                </div>
                <!--cotizacion-->

                <div class="form-row">
                <label for="telefono" class="form-label">Cotizacion</label>

                    <?php
                        $sql = "SELECT cotizacion  FROM orden_compra 
                                WHERE id = :id_compra";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(':id_compra', $id_orden);
                        $stmt->execute();
                        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                        $valor_placeholder = $resultado ? $resultado['cotizacion'] : '';

                    ?>
                    <input type="text" name="cotizacion" value="<?php echo $valor_placeholder; ?>" class="form-input">


                </div>
                <!--poliza-->

                <?php
                    $sql = "SELECT id_poliza  FROM orden_compra 
                    WHERE id = :id_compra AND id_poliza = 1";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(':id_compra', $id_orden);
                    $stmt->execute();
                    $result =$stmt->fetch(PDO::FETCH_ASSOC);
                    if($result > 0) {
                ?>
                <div class="form-row">
                    <label for="pro" class="form-label">Poliza </label>
                    <input type="text" name="poliza" value="POLIZA DE CUMPLIMIENTO" class="form-input">   
                </div>

                <?php
                    }
                ?>

                <!--Observciones-->
                <div class="form-row">
                <label for="telefono" class="form-label">Observaciones</label>

                    <?php
                        $sql = "SELECT observacion  FROM orden_compra 
                                WHERE id = :id_compra";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(':id_compra', $id_orden);
                        $stmt->execute();
                        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                        $valor_placeholder = $resultado ? $resultado['observacion'] : '';

                    ?>
                    <input type="text" name="observacion" value="<?php echo $valor_placeholder; ?>" class="form-input">


                </div>

                <!-- Valor Total -->
                <div class="form-row">
                    <label for="tecnico" class="form-label">Valor Total</label>
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
                    
                    <input type="text" name="valorn" value="<?php echo number_format(htmlspecialchars($valor_placeholder),2, ',', '.'); ?>" class="form-input">
                    <input type="hidden" name="valor" value="<?php echo $valor_placeholder; ?>" class="form-input">

                </div>
                <!-- Valor iva 5% -->
                <div class="form-row">
                    <?php
                        $sql = "SELECT valor  FROM valor_iva
                                WHERE id_orden = :id_compra AND iva = 5";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(':id_compra', $id_orden);
                        $stmt->execute();
                        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                        $valor_placeholder = $resultado ? $resultado['valor'] : '';
                        $valor_iva_formateado = is_numeric($valor_placeholder) ? number_format($valor_placeholder, 2, ',', '.') : '0,00';

                    ?>
                    <p><strong>IVA 5%</strong> <?php echo $valor_iva_formateado;?> $</p>
            



                </div>
               <!-- Valor iva 10% -->
                <div class="form-row">
                    <?php
                        $sql = "SELECT valor  FROM valor_iva
                                WHERE id_orden = :id_compra AND iva = 10";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(':id_compra', $id_orden);
                        $stmt->execute();
                        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                        $valor_placeholder = $resultado ? $resultado['valor'] : '';
                        $valor_iva_formateado = is_numeric($valor_placeholder) ? number_format($valor_placeholder, 2, ',', '.') : '0,00';

                    ?>
                    <p><strong>IVA 10%</strong> <?php echo $valor_iva_formateado;?> $</p>
                </div>
                <!-- Valor iva 19%-->
                <div class="form-row">
                    <?php
                        $sql = "SELECT valor  FROM valor_iva
                                WHERE id_orden = :id_compra AND iva = 19";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(':id_compra', $id_orden);
                        $stmt->execute();
                        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                        $valor_placeholder = $resultado ? $resultado['valor'] : '';
                        $valor_iva_formateado = is_numeric($valor_placeholder) ? number_format($valor_placeholder, 2, ',', '.') : '0,00';

                    ?>
                    <p><strong>IVA 19%</strong> <?php echo $valor_iva_formateado;?> $</p>

                </div>
                <!-- subtotal -->
                <div class="form-row">
                <?php
                        $sql = "SELECT subtotal  FROM orden_compra
                                WHERE id = :id_compra";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(':id_compra', $id_orden);
                        $stmt->execute();
                        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                        $valor_placeholder = $resultado ? $resultado['subtotal'] : '';
                        $valor_iva_formateado = is_numeric($valor_placeholder) ? number_format($valor_placeholder, 2, ',', '.') : '0,00';

                    ?>
                    <p><strong>Subtotal: </strong> <?php echo $valor_iva_formateado;?> $</p>

                </div>
                <!-- Retención -->
                <div class="form-row">
                    <?php
                        $sql = "SELECT o.retencion AS rete ,ro.retencion AS retencion FROM orden_compra o INNER JOIN retencion_ordencompra  ro
                                ON o.id = ro.id_ordenCompra 
                                WHERE ro.id_ordenCompra = :id_compra";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(':id_compra', $id_orden);
                        $stmt->execute();
                        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                        $valor_placeholder = $resultado ? $resultado['retencion'] : '';
                        $valor_placeholder1 = $resultado ? $resultado['rete'] : '';

                        $valor_iva_formateado = is_numeric($valor_placeholder) ? number_format($valor_placeholder, 2, ',', '.') : '0,00';

                    ?>
                    <p><strong>Retencion (<?php echo $valor_placeholder1?> % )</strong> <?php echo $valor_iva_formateado;?> $</p>

                </div>


                <!-- Tabla de Items -->
                <div class="form-row">
                    <section class="result-container">
                        <div id="results" class="container">
                            <div class="table-responsive">
                                <table class="table is-striped">
                                    <thead>
                                        <tr class="table-header">
                                            <th>Código</th>
                                            <th>Item</th>
                                            <th>precio</th>
                                            <th>Cantidad</th>
                                            <th>Descuento</th>
                                            <th>Valor Item</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Consulta para obtener los ítems
                                        $sql = "SELECT i.codigo_item,i.item,i.valor_uni,i.cantidad,i.descuento,i.valor 
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
                                            echo '<td>' . number_format($row['valor_uni'], 2, ',', '.') . '</td>';
                                            echo '<td>' . $row['cantidad'] . '</td>';
                                            echo '<td>' . $row['descuento'] . '</td>';
                                            echo '<td>' . number_format($row['valor'], 2, ',', '.') . '</td>';
                                            echo '</tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>
                </div>
                <!-- BOTONES DE MANIPULACION -->
                <div class="form-row">
                    <input type="hidden" name="id_orden" value="<?php echo htmlspecialchars($id_orden); ?>">
                    <input type="hidden" name="id_rol" value="<?php echo htmlspecialchars($_SESSION['id_rol']); ?>">
                    
                    <!-- Botón Aprobar -->
                    <button type="submit" name="action" value="aprobar" class="btn-approve">Aprobar</button>
                    
                    <!-- Botón Rechazar -->
                    <button type="submit" name="action" value="rechazar" class="btn-reject">Rechazar</button>
                </div>
            </div>
        </div>

    </form>
</body>
<style>
   .main-content {
        display: flex;
        justify-content: center;
        padding: 20px;
    }
    .result-container {
        width: 150%;
        max-width: 1100px;
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


/* Estilos responsive para tablet */
@media (max-width: 768px) {
    .container, .form-container {
        padding: 10px;
    }
    
    .logo img {
        width: 80%;
        margin: auto;
        display: block;
    }

    .info, .codigo {
        text-align: center;
    }

    .form-column, .form-row {
        width: 100%;
        flex-direction: column;
        align-items: center;
    }

    .form-label, .form-input {
        width: 100%;
    }
}

/* Estilos responsive para móvil */
@media (max-width: 480px) {
    .container {
        flex-direction: column;
        align-items: center;
    }

    .form-container {
        flex-direction: column;
        align-items: center;
    }

    .form-row {
        display: flex;
        flex-direction: column;
        width: 100%;
    }

    .form-label {
        margin-bottom: 5px;
        text-align: left;
        width: 100%;
    }

    .form-input {
        width: 100%;
    }

    .info, .codigo {
        text-align: center;
    }

    /* Ajusta el tamaño de imagen del logo para pantallas pequeñas */
    .logo img {
        width: 60%;
        margin: auto;
    }
    
    /* Estilo para los textos de IVA */
    .form-row p {
        font-size: 14px;
        text-align: center;
    }
}
    /* Ajustes Responsivos */
    @media (max-width: 768px) {
        .result-container {
            padding: 15px;
        }
        .table.is-striped th,
        .table.is-striped td {
            font-size: 0.7em;
        }
    }

    @media (max-width: 480px) {
        .table.is-striped th,
        .table.is-striped td {
            font-size: 0.7em;
            padding: 6px;
        }
    }

</style>
</html>
