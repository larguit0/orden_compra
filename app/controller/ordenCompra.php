<?php
require_once __DIR__ . '/correoFormat.php';

require_once __DIR__ . '/../../config/app.php';// Verificar si la sesión está iniciada

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$id = isset($_GET['id']) ? $_GET['id'] : null;
$_SESSION['id_proyecto'] = $id;

// Conexión a la base de datos
require_once __DIR__ . '/../../config/server.php'; // Ruta a la clase server.php
$conn = Database::connect();

// DATOS PARA LA TABLA ORDEN COMPRA
$id_probedor = $_POST['id_proveedor'];
$id_rol = $_POST['id_rol'];
$codigo_orden = $_POST['codigo_orden'];
$id_proyecto = $_POST['id_proyecto'];
$persona = $_POST['persona'];
$id_tecnico = $_POST['id_tecnico']; 
$valor1 = $_POST['totalOrden'];
$consecutivo = $_POST['consecutivo'];
$compraPre= $_POST['compra_per'];
$observacion = $_POST['observacion'];
$fecha = date("Y-m-d");
$totalIva5 = $_POST['totIva5'];
$totalIva10 = $_POST['totIva10'];
$totalIva19 = $_POST['totIva19'];
$estado = 1;
$cincoIva=5;
$diezIva=10;
$nueveDiezIva=19;
$rol_tecnico = 2;

//forma_pago, lugar_entrega,cotizacion,id_poliza
$forma_pago = $_POST ['forma_pago'];
$lugar_entrega = $_POST ['lugar_entrega'];
$cotizaciones = $_POST ['cotizaciones'];
$poliza = isset($_POST['poliza'])? 1 : 2;





//capturar y calculo de datos de la retencion
$subtotal = $_POST['subtotaal'];
$retencion = $_POST['retencion'];
$centro_costos = $_POST['centro_costos'];
$retencionTotal = $subtotal *($retencion/100);

// Verificar si la orden de compra ya existe
$sql = "SELECT * FROM orden_compra WHERE codigo_orden = :codigo";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':codigo', $codigo_orden);
$stmt->execute();
$idexists = $stmt->fetchColumn();
if ($idexists > 0) {
    echo "<script>
    alert('Orden de compra ya está registrada');
    window.location.href = '".APP_URL."?views=dashboard/';
    </script>";
    exit;
}

//capturamos el id del tecnico aprovador del proyecto
$sql = "SELECT u.id FROM proyecto_asignado pa INNER JOIN usuario u ON  pa.id_lider = u.id WHERE pa.id_proyecto = :id_proyecto 
AND u.id_rol = :rol ";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id_proyecto', $id_proyecto);
$stmt->bindParam(':rol', $rol_tecnico);
$stmt->execute();
$resultado = $stmt->fetch(PDO::FETCH_ASSOC);
$tecnico_aprovador = $resultado ? $resultado['id'] : '';
// Iniciar la transacción
    try {
        $conn->beginTransaction();

        // Inserción en la tabla orden_compra
        $sql = "INSERT INTO orden_compra (codigo_orden, id_proyecto, persona, id_tecnico, valor, compra_per, consecutivo, fecha, id_proveedor, retencion, centro_costos, observacion, subtotal,
        forma_pago, lugar_entrega, cotizacion, id_poliza)
                VALUES (:codigo_orden, :id_proyecto, :persona, :id_tecnico, :valor,:compra_per,:consecutivo,:fecha,:id_proveedor,:retencion,:centro_costos, :observacion,:subtotal,
                :forma_pago, :lugar_entrega, :cotizacion, :id_poliza)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':codigo_orden', $codigo_orden);
        $stmt->bindParam(':id_proyecto', $id_proyecto);
        $stmt->bindParam(':persona', $persona);
        $stmt->bindParam(':id_tecnico', $id_tecnico);
        $stmt->bindParam(':valor', $valor1);
        $stmt->bindParam(':compra_per', $compraPre);
        $stmt->bindParam(':consecutivo', $consecutivo);
        $stmt->bindParam(':id_proveedor', $id_probedor);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->bindParam(':retencion', $retencion);
        $stmt->bindParam(':centro_costos', $centro_costos);
        $stmt->bindParam(':observacion', $observacion);
        $stmt->bindParam(':subtotal', $subtotal);
        $stmt->bindParam(':forma_pago', $forma_pago);
        $stmt->bindParam(':lugar_entrega', $lugar_entrega);
        $stmt->bindParam(':cotizacion', $cotizaciones);
        $stmt->bindParam(':id_poliza', $poliza);

        $stmt->execute();

        $id_orden = $conn->lastInsertId();

        $sqlRete = "INSERT INTO retencion_ordencompra(id_ordenCompra, retencion) 
        VALUES (:id_ordenCompra, :retencion)";
        $stmt_re = $conn->prepare($sqlRete);
        $stmt_re -> bindParam(':id_ordenCompra', $id_orden);
        $stmt_re -> bindParam(':retencion', $retencionTotal);
        if(!$stmt_re->execute()){
        throw new Exception("Error al insertar ítem de la orden");
        }

        $item = $_POST['item'];
        $cantidad = $_POST['cantidad'];
        $codigo_items = $_POST['codigo_item'];
        $valorItems = $_POST['totalItem'];
        $impuesto = $_POST['impuesto'];
        $descuentos = $_POST['desc'];
        $valor_uni = $_POST['precio'];


        // Inserción en la tabla item_compra
        foreach ($codigo_items as $index => $codigo_item) {
            $descripcion = $item[$index];
            $cantidadItem = $cantidad[$index];
            $valorItem = $valorItems[$index];
            $valor_unitario = $valor_uni[$index];
            $descuento = $descuentos[$index];


            $sqlItem = "INSERT INTO item_compra(id_orden, item, cantidad, codigo_item, valor, descuento, valor_uni)
                        VALUES (:id_orden, :item, :cantidad, :codigo_item,:valor,:descuento,:valor_uni)";
            $stmt = $conn->prepare($sqlItem);
            $stmt->bindParam(':id_orden', $id_orden);
            $stmt->bindParam(':item', $descripcion);
            $stmt->bindParam(':cantidad', $cantidadItem);
            $stmt->bindParam(':codigo_item', $codigo_item);
            $stmt->bindParam(':valor', $valorItem);
            $stmt->bindParam(':descuento', $descuento);
            $stmt->bindParam(':valor_uni', $valor_unitario);


            if (!$stmt->execute()) {
                throw new Exception("Error al insertar ítem de la orden");
            }
        }


        if(!empty($totalIva5)){
            $sql5 = "INSERT INTO valor_iva( id_orden, iva, valor)
                      VALUES (:id_orden, :iva, :valor)";
            $stmt = $conn->prepare($sql5);
            $stmt->bindParam(':id_orden', $id_orden);
            $stmt->bindParam(':iva', $cincoIva);
            $stmt->bindParam(':valor', $totalIva5);
            if (!$stmt->execute()) {
                throw new Exception("Error al insertar ítem de la orden");
            }

        }
        if(!empty($totalIva10)){
            $sql10 = "INSERT INTO valor_iva( id_orden, iva, valor)
                      VALUES (:id_orden, :iva, :valor)";
            $stmt = $conn->prepare($sql10);
            $stmt->bindParam(':id_orden', $id_orden);
            $stmt->bindParam(':iva', $diezIva);
            $stmt->bindParam(':valor', $totalIva10);
            if (!$stmt->execute()) {
                throw new Exception("Error al insertar ítem de la orden");
            }

        }
        if(!empty($totalIva19)){
            $sql19 = "INSERT INTO valor_iva( id_orden, iva, valor)
                      VALUES (:id_orden, :iva, :valor)";
            $stmt = $conn->prepare($sql19);
            $stmt->bindParam(':id_orden', $id_orden);
            $stmt->bindParam(':iva', $nueveDiezIva);
            $stmt->bindParam(':valor', $totalIva19);
            if (!$stmt->execute()) {
                throw new Exception("Error al insertar ítem de la orden");
            }

        }

        
        //-------------OBTENCION DATOS CORREO---------------------------//
        //obtencion datos del tecnico 
        
        $sql = "SELECT correo, nombre FROM  usuario where id = :id_persona";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_persona', $id_tecnico);
        $stmt->execute();
        $tecnico = $stmt->fetch(PDO::FETCH_ASSOC);
        $nombreTecnico =$tecnico['nombre'];
        $correoTecnico =$tecnico['correo'];
        
        //obtencion datos persona
        $sqlOthers = "SELECT correo, nombre FROM  usuario where id = :id_persona";
        $stmtOth = $conn->prepare($sqlOthers);
        $stmtOth->bindParam(':id_persona', $persona);
        $stmtOth->execute();
        $tecnic = $stmtOth->fetch(PDO::FETCH_ASSOC);
        $nombreCorreo =$tecnic['nombre'];
        $correoCorreo =$tecnic['correo'];


        if($id_rol ==7 || $id_rol ==5 ){
            if ($id_proyecto == 3 ){
                $sqlApro= "INSERT INTO aprobaciones (id_orden_compra, id_aprobador, id_estado)
                VALUES (:id_orden_compra,:id_aprobador_oc,:id_estado)";
                $stmt = $conn->prepare($sqlApro);
                $stmt->bindParam(':id_orden_compra', $id_orden);
                $stmt->bindParam(':id_aprobador_oc', $id_tecnico);
                $stmt->bindParam(':id_estado', $estado);
                
                if(enviarCorreo($correoTecnico,$nombreTecnico)){
                    
                }
                if (!$stmt->execute()) {
                    throw new Exception("Error al insertar ítem de la orden");
                }
            }else{
                $sqlApro= "INSERT INTO aprobaciones (id_orden_compra, id_aprobador, id_estado)
                VALUES (:id_orden_compra,:id_aprobador_oc,:id_estado)";
                $stmt = $conn->prepare($sqlApro);
                $stmt->bindParam(':id_orden_compra', $id_orden);
                $stmt->bindParam(':id_aprobador_oc', $persona);
                $stmt->bindParam(':id_estado', $estado);
                
                enviarCorreo($correoCorreo,$nombreCorreo);

                if (!$stmt->execute()) {
                    throw new Exception("Error al insertar ítem de la orden");
                }
            }
            
        }else if($id_rol == 2 ||$id_rol == 3 || $id_rol == 4 ){
            if ($id_proyecto == 3 ){
                $sqlApro= "INSERT INTO aprobaciones (id_orden_compra, id_aprobador, id_estado)
                VALUES (:id_orden_compra,:id_aprobador_oc,:id_estado)";
                $stmt = $conn->prepare($sqlApro);
                $stmt->bindParam(':id_orden_compra', $id_orden);
                $stmt->bindParam(':id_aprobador_oc', $id_tecnico);
                $stmt->bindParam(':id_estado', $estado);
                enviarCorreo($correoTecnico,$nombreTecnico);

                if (!$stmt->execute()) {
                    throw new Exception("Error al insertar ítem de la orden");
                }
            }else{
                $sqlApro= "INSERT INTO aprobaciones (id_orden_compra, id_aprobador, id_estado)
                VALUES (:id_orden_compra,:id_aprobador_oc,:id_estado)";
                $stmt = $conn->prepare($sqlApro);
                $stmt->bindParam(':id_orden_compra', $id_orden);
                $stmt ->bindParam(':id_aprobador_oc', $persona);
                $stmt->bindParam(':id_estado', $estado);
                enviarCorreo($correoCorreo,$nombreCorreo);

                if (!$stmt->execute()) {

                    throw new Exception("Error al insertar ítem de la orden");
                }
            }  
        }else if($id_rol == 1){
            $sqlApro= "INSERT INTO aprobaciones (id_orden_compra, id_aprobador, id_estado)
            VALUES (:id_orden_compra,:id_aprobador_oc,:id_estado)";
            $stmt = $conn->prepare($sqlApro);
            $stmt->bindParam(':id_orden_compra', $id_orden);
            $stmt ->bindParam(':id_aprobador_oc', $persona);
            $stmt->bindParam(':id_estado', $estado);
            enviarCorreo($correoCorreo,$nombreCorreo);

            if (!$stmt->execute()) {
                throw new Exception("Error al insertar ítem de la orden");
            }
        }



        // Confirmar la transacción si todo ha ido bien
        $conn->commit();
        echo "<script>
        alert('Datos ingresados correctamente');
        window.location.href = '".APP_URL."?views=dashboard/';
       </script>";

 
    } catch (Exception $e) {
        // Revertir los cambios en caso de error
        $conn->rollBack();
        echo "<script>
        alert('Error al ingresar datos: " . $e->getMessage() . "');
        window.location.href = '".APP_URL."?views=dashboard/';
        </script>";
    }

?>
