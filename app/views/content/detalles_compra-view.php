<?php
// Verificar si la sesión ya está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$id_compra = isset($_GET['id']) ? $_GET['id'] : null;

// Aquí puedes continuar procesando el ID del proyecto y mostrar la información necesaria


// Incluir la clase server.php para usar la conexión
require_once __DIR__ . '/../../../config/server.php'; // Ajusta la ruta según la estructura de tu proyecto

// Establecer la conexión
$conn = Database::connect();
$rolDir = 3;
$rolCola = 7;

$id_persona = $_SESSION['id'];
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
            $sql = "SELECT consecutivo FROM compra 
                WHERE id = :id_compra";
                $stmt = $conn->prepare($sql);
                        $stmt->bindParam(':id_compra', $id_compra);
                        $stmt->execute();
                        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                        $valor_placeholderCons = $resultado ? $resultado['consecutivo'] : 'opa';
            ?>
        <div class="codigo">
            <p><strong>N°</strong> OC<?php echo $valor_placeholderCons;?></p>
        </div>
    </div>
    
    <form action="<?php echo APP_URL; ?>app/controller/detalles_compraController1.php" method="POST">
        <div class="form-container">
            <div class="form-column">
                <!-- Proyecto -->
                <div class="form-row">
                    <label for="proyecto" class="form-label">Proyecto</label>
                    <?php
                        $sql = "SELECT 
                        p.id,  p.nombre
                        FROM compra c 
                        INNER JOIN proyecto p ON c.proyecto = p.id 
                        INNER JOIN usuario u ON c.persona = u.id 
                        INNER JOIN estado_compra e ON c.id_estado_compra = e.id 
                        WHERE c.id = :id";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(':id', $id_compra);
                        $stmt->execute();
                        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                        $valor_placeholder = $resultado ? $resultado['nombre'] : '';
                        $valor_placeholder1 = $resultado ? $resultado['id'] : '';
                    ?>
                    <input type="hidden" id="id_persona" name="id_persona" value="<?php echo $id_persona ?>">
                    <input type="hidden" id="consecutivo" name="consecutivo" value="<?php echo $valor_placeholderCons ?>">

                    <input type="hidden" id="id_compra" name="id_compra" value="<?php echo $id_compra ?>">
                    <input type="hidden" id="id_proyecto" name="id_proyecto" value="<?php echo htmlspecialchars($valor_placeholder1); ?>">
                    <input type="text" id="proyecto" name="proyecto" value="<?php echo htmlspecialchars($valor_placeholder); ?>" class="form-input" placeholder="<?php echo htmlspecialchars($valor_placeholder); ?>">
                </div>
                <div class="form-row">
                    <?php
                        $sql = "SELECT fecha FROM compra 
                        WHERE id = :id_compra";
                        $stmt = $conn->prepare($sql);
                                $stmt->bindParam(':id_compra', $id_compra);
                                $stmt->execute();
                                $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                                $valor_placeholder1 = $resultado ? $resultado['fecha'] : 'opa';
                    ?>

                    <input type="hidden" id="codigo_orden" name="fecha" value="<?php echo htmlspecialchars($valor_placeholder1); ?>" class="form-input">
                </div>

                <!-- Código Orden -->
                <div class="form-row">
                    <label for="codigo_orden" class="form-label">Código Orden</label>
                    <?php
                        $sql = "SELECT 
                        c.codigo_oc
                        FROM compra c 
                        INNER JOIN proyecto p ON c.proyecto = p.id 
                        INNER JOIN usuario u ON c.persona = u.id 
                        INNER JOIN estado_compra e ON c.id_estado_compra = e.id 
                        WHERE c.id = :id";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(':id', $id_compra);
                        $stmt->execute();
                        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                        $valorCodigo = $resultado ? $resultado['codigo_oc'] : '';
                    ?>
                    <input type="hidden"  name="id_ordenCompra" value="<?php echo htmlspecialchars($id_orden); ?>">

                    <input type="text" id="codigo_orden" name="codigo_orden" value="<?php echo htmlspecialchars($valorCodigo); ?>" class="form-input">
                </div>

                <!-- Responsable Técnico -->
                <div class="form-row">
                    <label for="telefono" class="form-label">Responsable Técnico</label>
                    <?php
                        $sql = "SELECT 
                        u.nombre,u.apellido,u.id
                        FROM compra c 
                        INNER JOIN proyecto p ON c.proyecto = p.id 
                        INNER JOIN usuario u ON c.persona = u.id 
                        INNER JOIN estado_compra e ON c.id_estado_compra = e.id 
                        WHERE c.id = :id ";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(':id', $id_compra);
                        $stmt->execute();
                        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                        $valor_placeholder = $resultado ? $resultado['nombre'] : '';
                        $valor_placeholderJ = $resultado ? $resultado['apellido'] : '';
                        $valor_placeholder1 = $resultado ? $resultado['id'] : '';
                    ?>
                    <input type="hidden" id="person" name="persona" value="<?php echo htmlspecialchars($valor_placeholder1); ?>">
                    <input type="text" id="telefono" name="personax" value="<?php echo htmlspecialchars($valor_placeholder . " " . $valor_placeholderJ); ?>" class="form-input">
                </div>
                    
                <!-- Responable de la Orden de Compra -->
                <div class="form-row">
                    <label for="telefono" class="form-label">Responsable Orden Compra</label>
                    <?php
                        $sql = "SELECT u.nombre, u.apellido, u.id 
                        FROM compra c
                        INNER JOIN usuario u ON c.compra_per = u.id 
                        WHERE c.id = :id_compra";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(':id_compra', $id_compra);
                        $stmt->execute();
                        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                        $valor_placeholder = $resultado ? $resultado['nombre'] : '';
                        $valor_placeholderJ = $resultado ? $resultado['apellido'] : '';
                        $valor_placeholder1 = $resultado ? $resultado['id'] : '';
                    ?>
                    <input type="hidden" id="person" name="personaoc" value="<?php echo htmlspecialchars($valor_placeholder1); ?>">
                    <input type="text" id="telefono" name="personax" value="<?php echo htmlspecialchars($valor_placeholder . " " . $valor_placeholderJ); ?>" class="form-input">
                </div>


                <!-- Director Proyecto -->
                <div class="form-row">
                    <label for="tecnico" class="form-label">Director Proyecto</label>
                    <?php
                        $sql = "SELECT 
                        u.nombre,u.apellido,u.id
                        FROM compra c 
                        INNER JOIN proyecto p ON c.proyecto = p.id 
                        INNER JOIN usuario u ON c.tecnico = u.id 
                        INNER JOIN estado_compra e ON c.id_estado_compra = e.id 
                        WHERE c.id = :id ";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(':id', $id_compra);
                        $stmt->execute();
                        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                        $valor_placeholder = $resultado ? $resultado['nombre'] : '';
                        $valor_placeholder1 = $resultado ? $resultado['apellido'] : '';
                        $valor_placeholder2 = $resultado ? $resultado['id'] : '';
                    ?>
                    <input type="hidden" id="id_tecnico" name="id_tecnico" value="<?php echo htmlspecialchars($valor_placeholder2); ?>">
                    <input type="text" id="tecnico" name="tecnico" value="<?php echo htmlspecialchars($valor_placeholder . " " . $valor_placeholder1); ?>" class="form-input">
                </div>
                
                <!-- Centro de costos -->
                <div class="form-row">
                    <label for="tecnico" class="form-label">Centro Costos </label>
                    <?php
                        $sql = "SELECT 
                        centro_costos
                        FROM compra c  
                        WHERE id = :id ";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(':id', $id_compra);
                        $stmt->execute();
                        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                        $valor_placeholder = $resultado ? $resultado['centro_costos'] : '';
                    ?>
                    <input type="text" id="tecnico" name="centro_costos" value="<?php echo htmlspecialchars($valor_placeholder); ?>" class="form-input">
                </div>

                <!-- Forma de Pago -->
                <div class="form-row">
                    <label for="tecnico" class="form-label">Forma de pago  </label>
                    <?php
                        $sql = "SELECT 
                        forma_pago
                        FROM compra c  
                        WHERE id = :id ";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(':id', $id_compra);
                        $stmt->execute();
                        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                        $valor_placeholder = $resultado ? $resultado['forma_pago'] : '';
                    ?>
                    <input type="text" id="tecnico" name="forma_pago" value="<?php echo htmlspecialchars($valor_placeholder); ?>" class="form-input">
                </div>
                <!-- cotizacion -->
                <div class="form-row">
                    <label for="tecnico" class="form-label"> Cotizacion   </label>
                    <?php
                        $sql = "SELECT 
                        cotizacion
                        FROM compra c  
                        WHERE id = :id ";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(':id', $id_compra);
                        $stmt->execute();
                        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                        $valor_placeholder = $resultado ? $resultado['cotizacion'] : '';
                    ?>
                    <input type="text" id="tecnico" name="cotizacion" value="<?php echo htmlspecialchars($valor_placeholder); ?>" class="form-input">
                </div>

                <!--poliza-->

                <?php
                    $sql = "SELECT id_poliza  FROM compra 
                    WHERE id = :id_compra AND id_poliza = 1";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(':id_compra', $id_compra);
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

                <!--poliza oculta-->
                <div class="form-row">
                <?php
                    $sql = "SELECT id_poliza  FROM compra 
                    WHERE id = :id_compra ";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(':id_compra', $id_compra);
                    $stmt->execute();
                    $result =$stmt->fetch(PDO::FETCH_ASSOC);
                    $valor_placeholder = $result ? $result['id_poliza'] : 2;


                ?>
                    <input type="hidden" name="polizaStatus" value="<?php echo htmlspecialchars($valor_placeholder); ?>" class="form-input">   
                </div>

                <!-- Lugar Entrega -->
                <div class="form-row">
                    <label for="tecnico" class="form-label">Lugar Entrega  </label>
                    <?php
                        $sql = "SELECT 
                        lugar_entrega
                        FROM compra c  
                        WHERE id = :id ";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(':id', $id_compra);
                        $stmt->execute();
                        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                        $valor_placeholder = $resultado ? $resultado['lugar_entrega'] : '';
                    ?>
                    <input type="text" id="tecnico" name="lugar_entrega" value="<?php echo htmlspecialchars($valor_placeholder); ?>" class="form-input">
                </div>
                
                <div class="form-row">
                <label for="telefono" class="form-label">Proveedor</label>

                    <?php
                        $sql = "SELECT p.nombre  FROM compra c
                                INNER JOIN proveedor p ON c.id_proveedor = p.id
                                WHERE c.id = :id_compra";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(':id_compra', $id_compra);
                        $stmt->execute();
                        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                        $valor_placeholder = $resultado ? $resultado['nombre'] : '';

                    ?>
                    <input type="text" name="id_provedor" value="<?php echo $valor_placeholder; ?>" class="form-input">


                </div>

                <!-- Valor Total -->
                <div class="form-row">
                    <label for="tecnico" class="form-label">Valor Total</label>
                    <?php
                        $sql = "SELECT 
                        c.valor
                        FROM compra c 
                        INNER JOIN proyecto p ON c.proyecto = p.id 
                        INNER JOIN usuario u ON c.tecnico = u.id 
                        INNER JOIN estado_compra e ON c.id_estado_compra = e.id 
                        WHERE c.id = :id ";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(':id', $id_compra);
                        $stmt->execute();
                        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                        $valor_placeholder = $resultado ? $resultado['valor'] : '';
                    ?>
                    
                    <input type="text" name="valor" value="<?php echo number_format(htmlspecialchars($valor_placeholder),2, ',', '.'); ?>" class="form-input">
                </div>

                <div class="form-row">
                   <div class="buscar-bar">
                        <label class="form-label">Seleccione Ubicacion de donde llego la compra:</label>
                        <div class="select">
                            <select class="select-marca" id="id_ubicacion" name="id_ubicacion" required onchange="loadForm()">
                                <option value="">Seleccione ubicacíon</option>
                                <?php
                                // Preparar la consulta
                                $sqlmodelo = "SELECT id, ubicacion FROM ubicacion";
                                $stmt = $conn->prepare($sqlmodelo);
                                $stmt->execute();
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    echo '<option value="' . $row['id'] . '">' . $row['ubicacion'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <!-- Contenedor donde se muestra el formulario dinámico -->
                        <div id="formulario-container"></div>
                    </div>
                </div>
                <!--subtotal-->
                <div class="form-row">
                    <label class="form-label">Subtotal</label>

                    <?php
                        $sql = "SELECT subtotal  FROM compra
                                WHERE id = :id_compra";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(':id_compra', $id_compra);
                        $stmt->execute();
                        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                        $valor_placeholder = $resultado ? $resultado['subtotal'] : '';
                        $valor_iva_formateado = is_numeric($valor_placeholder) ? number_format($valor_placeholder, 2, ',', '.') : '0,00';

                    ?>
                    <input type="text" name="subtotal" value="<?php echo $valor_iva_formateado;?>" class="form-input">

                </div>
                <!--iva 5%-->
                <div class="form-row">
                    <label class="form-label">Valor iva 5%</label>

                    <?php
                        $sql = "SELECT valor  FROM valor_iva_compra
                                WHERE id_compra = :id_compra AND iva = 5";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(':id_compra', $id_compra);
                        $stmt->execute();
                        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                        $valor_placeholder = $resultado ? $resultado['valor'] : '';
                        $valor_iva_formateado = is_numeric($valor_placeholder) ? number_format($valor_placeholder, 2, ',', '.') : '0,00';

                    ?>
                    <input type="text" name="iva5" value="<?php echo $valor_iva_formateado;?>" class="form-input">

                </div>
                  <!--iva 10%-->
                <div class="form-row">
                    <label class="form-label">Valor iva 10%</label>

                    <?php
                        $sql = "SELECT valor  FROM valor_iva_compra
                                WHERE id_compra = :id_compra AND iva = 10";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(':id_compra', $id_compra);
                        $stmt->execute();
                        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                        $valor_placeholder = $resultado ? $resultado['valor'] : '';
                        $valor_iva_formateado = is_numeric($valor_placeholder) ? number_format($valor_placeholder, 2, ',', '.') : '0,00';

                    ?>
                    <input type="text" name="iva10" value="<?php echo $valor_iva_formateado;?>" class="form-input">

                </div>
                <!--iva 19%-->
                <div class="form-row">
                    <label class="form-label">Valor iva 19%</label>

                    <?php
                        $sql = "SELECT valor  FROM valor_iva_compra
                                WHERE id_compra = :id_compra AND iva = 19";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(':id_compra', $id_compra);
                        $stmt->execute();
                        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                        $valor_placeholder = $resultado ? $resultado['valor'] : '';
                        $valor_iva_formateado = is_numeric($valor_placeholder) ? number_format($valor_placeholder, 2, ',', '.') : '0,00';

                    ?>
                    <input type="text" name="iva19" value="<?php echo $valor_iva_formateado;?>" class="form-input">


                </div>
                <!--retencion-->
                <div class="form-row">

                    <?php
                        $sql = "SELECT c.retencion AS rete ,ro.retencion AS retencion FROM compra c INNER JOIN retencion_compra  ro
                                ON c.id = ro.id_Compra 
                                WHERE ro.id_Compra = :id_compra";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(':id_compra', $id_compra);
                        $stmt->execute();
                        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                        $valor_placeholder2 = $resultado ? $resultado['retencion'] : '';
                        $valor_placeholder1 = $resultado ? $resultado['rete'] : '';

                        $valor_iva_formateado = is_numeric($valor_placeholder2) ? number_format($valor_placeholder2, 2, ',', '.') : '0,00';

                    ?>
                    <input type="hidden" name="rete" value="<?php echo $valor_placeholder1;?>" class="form-input">
                    <input type="hidden" name="retencion" value="<?php echo $valor_iva_formateado;?>" class="form-input">


                    <label class="form-label">Retencion (<?php echo $valor_placeholder1 ?>%)</label>
                    <input type="text" name="retention" value="<?php echo $valor_iva_formateado;?>" class="form-input">


                </div>
                <!-- Observaciones -->
                <div class="form-row">
                    <label for="tecnico" class="form-label">Observaciones  </label>
                    <?php
                        $sql = "SELECT 
                        observacion
                        FROM compra   
                        WHERE id = :id ";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(':id', $id_compra);
                        $stmt->execute();
                        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                        $valor_placeholder = $resultado ? $resultado['observacion'] : '';
                    ?>
                    <input type="text" id="tecnico" name="observaciones" value="<?php echo htmlspecialchars($valor_placeholder); ?>" class="form-input">
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
                                        <th>Precio</th>
                                        <th>Cantidad</th>
                                        <th>Descuento</th>
                                        <th>Valor Item</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Consulta para obtener los ítems
                                    $sql = "SELECT i.codigo_item,i.item,i.valor_uni,i.cantidad,i.descuento,i.valor 
                                            FROM compra_item i 
                                            INNER JOIN compra c ON i.id_compra = c.id 
                                            WHERE c.id = :id";
                                    
                                    $stmt = $conn->prepare($sql);
                                    $stmt->bindParam(':id', $id_compra);
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
                    </section>
                </div>
                <!-- BOTONES DE MANIPULACION -->
                <div class="form-row">
                    <input type="hidden" name="id_orden" value="<?php echo htmlspecialchars($id_orden); ?>">
                    <input type="hidden" name="id_rol" value="<?php echo htmlspecialchars($_SESSION['id_rol']); ?>">
                    
                    <!-- Botón Aprobar, en esta interfaz nos sirve para poner la fecha del dia para llenar la tabla inventario -->
                    <button type="submit" name="action" value="aprobar" class="button is-info is-rounded ml-2">Confirmar llegada</button>
                    
                    <!-- Botón Rechazar -->
                    <a href="?views=compras" class="button is-info is-rounded ml-2">Atras</a>
       
            </div>
        </div>

    </form>
</body>
</html>
<script>
function loadForm() {
    var idCompra = "<?php echo $id_compra; ?>";
    var idProyecto = document.getElementById("id_ubicacion").value;
    
    // Si no se selecciona un proyecto, limpiamos el formulario
    if (idProyecto === "") {
        document.getElementById("formulario-container").innerHTML = "";
        return;
    }
    
    // Realizar la solicitud AJAX para cargar el formulario
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "<?php echo APP_URL; ?>app/controller/cargar_formularioPersona.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Mostrar el formulario en el contenedor
            document.getElementById("formulario-container").innerHTML = xhr.responseText;
        }
    };
    xhr.send("id_ubicacion=" + idProyecto + "&id_compra=" + idCompra);
}
</script>
<style>

/* Media Query para pantallas más pequeñas */
@media (max-width: 768px) {
    .container {
        flex-direction: column;
        align-items: center;
        text-align: center;
    }

    .logo img {
        max-width: 80px;
    }

    .info, .codigo {
        margin: 10px 0;
    }

    .form-container {
        flex-direction: column;
    }

    .form-column {
        width: 100%;
    }

    .buscar-bar {
        width: 100%;
        align-items: center;
    }

    .form-row {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }

    .form-label, .form-input, .select-marca select {
        width: 100%;
        font-size: 14px;
    }
}

/* Media Query para pantallas muy pequeñas */
@media (max-width: 480px) {
    .logo img {
        max-width: 60px;
    }

    .info, .codigo, .form-row {
        text-align: center;
        width: 100%;
    }

    .form-label {
        font-size: 13px;
    }

    .form-input, .select-marca select {
        font-size: 14px;
    }
}
</style>

