<?php
require_once __DIR__ . '/correoFormat.php';


require_once __DIR__ . '/../../config/app.php';// Verificar si la sesión está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Conexión a la base de datos
require_once __DIR__ . '/../../config/server.php'; // Ruta a la clase server.php
$conn = Database::connect();



// Obtener el rol y la acción del formulario
$id_proyecto = isset($_POST['id_proyecto']) ? $_POST['id_proyecto'] : null;
$id_rol = isset($_POST['id_rol']) ? $_POST['id_rol'] : null;
$action = isset($_POST['action']) ? $_POST['action'] : null;
$id_orden = isset($_POST['id_orden']) ? $_POST['id_orden'] : null;
$valor = isset($_POST['valor']) ? $_POST['valor'] : null;
$id_rolDir = 3;
$id_rolGere = 4;
$estado = 1;
$status=3;
$id_gerenteProyectos = 11;
$id_patron=1;
//datos para el correo del responsable de la OC 
$correoRespo =isset($_POST['correoRes']) ? $_POST['correoRes'] : 'yuliana.david@acemaingenieria.com';
$nombreRespo =isset($_POST['personax']) ? $_POST['personax'] : 'yuliana ';


//consulta para tener los datos del director



// Control de las acciones según el rol
switch ($action) {
    case 'aprobar':
        // rol técnico de proyecto
        if ($id_rol == 7) {
            // Lógica de aprobación para Director
            $sql = "UPDATE aprobaciones SET id_estado = 2 WHERE id_orden_compra = :id_orden";  // 2 es el estado aprobado
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id_orden', $id_orden);
            if ($stmt->execute()) {
                // Consulta para obtener el id_lider del proyecto asignado
                $sql = "SELECT pa.id_lider, u.correo, u.nombre FROM proyecto_asignado pa 
                        INNER JOIN usuario u ON pa.id_lider = u.id
                        WHERE pa.id_proyecto = :id_proyecto AND u.id_rol = :id_rol";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':id_proyecto', $id_proyecto);
                $stmt->bindParam(':id_rol', $id_rolDir);
                $stmt->execute();
                $lider_aprobador = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($lider_aprobador && isset($lider_aprobador['id_lider'])) {
                    // Aquí obtenemos el valor correcto de id_lider
                    $id_lider = $lider_aprobador['id_lider'];
                    $nombre = $lider_aprobador['nombre'];
                    $correo = $lider_aprobador['correo'];

                    // Insertar la aprobación en la tabla aprobaciones
                    $sqlApro = "INSERT INTO aprobaciones (id_orden_compra, id_aprobador, id_estado)
                                VALUES (:id_orden_compra, :id_aprobador_oc, :id_estado)";
                    $stmt = $conn->prepare($sqlApro);
                    $stmt->bindParam(':id_orden_compra', $id_orden);
                    $stmt->bindParam(':id_aprobador_oc', $id_lider);
                    $stmt->bindParam(':id_estado', $estado);

                    if (!$stmt->execute()) {
                        throw new Exception("Error al insertar la aprobación");
                    } else {
                        //enviar correo a director
                        enviarCorreo($correo,$nombre);
                        echo "<script>
                        alert('aprobacion exitosa');
                        window.location.href = '".APP_URL."?views=aprobaciones/';
                        </script>";
                    }
                } else {
                    echo "No se encontró un líder para el proyecto.";
                }
            }
        // rol director
        } elseif ($id_rol == 3) {
            // Lógica de aprobación para el DIRECTOR DE PROYECTO
            $sql = "UPDATE aprobaciones SET id_estado = 2 WHERE id_orden_compra = :id_orden";  // 2 es el estado aprobado
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id_orden', $id_orden);
            if ($stmt->execute()) {
        // Lógica de aprobación para el DIRECTOR DE PROYECTO
        $sql = "UPDATE aprobaciones SET id_estado = 2 WHERE id_orden_compra = :id_orden";  // 2 es el estado aprobado
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_orden', $id_orden);
    
        if ($stmt->execute()) {
            // Lista de aprobadores para insertar
            $aprobadores = [$id_gerenteProyectos];
    
            // Insertar aprobaciones en un bucle
            foreach ($aprobadores as $id_aprobador_oc) {
                $sqlApro = "INSERT INTO aprobaciones (id_orden_compra, id_aprobador, id_estado)
                            VALUES (:id_orden_compra, :id_aprobador_oc, :id_estado)";
                $stmt = $conn->prepare($sqlApro);
                $stmt->bindParam(':id_orden_compra', $id_orden);
                $stmt->bindParam(':id_aprobador_oc', $id_aprobador_oc);
                $stmt->bindParam(':id_estado', $estado);
    
                if (!$stmt->execute()) {
                    throw new Exception("Error al insertar la aprobación");
                }
            }
    
            // Si todo sale bien
            //dato quemado de gerencia mariana.agudelo@acemaingenieria.com
            enviarCorreo('mariana.agudelo@acemaingenieria.com','mariana');
            echo "<script>
                alert('Aprobación exitosa');
                window.location.href = '".APP_URL."?views=aprobaciones/';
            </script>";
        }        
            }
        //gerente de proyecto
        } elseif ($id_rol == 4) {
            //verificacion; gerencia sin aprobar la orden de compra

            $sqlApro = "INSERT INTO aprobaciones (id_orden_compra, id_aprobador, id_estado)
                    VALUES (:id_orden_compra, :id_aprobador_oc, :id_estado)";
            
            $sql = "UPDATE aprobaciones SET id_estado = 2 WHERE id_orden_compra = :id_orden";  // 2 es el estado aprobado
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id_orden', $id_orden);
            if ($stmt->execute()) {
                if ($valor < 5000000) {

                    $sql_veri = "INSERT INTO aprobaciones (id_orden_compra, id_aprobador, id_estado)
                                VALUES (:id_orden_compra, :id_aprobador_oc, :id_estado)";
                    $stmt_veri= $conn->prepare($sql_veri);
                    $stmt_veri ->bindParam(':id_orden_compra', $id_orden);
                    $stmt_veri ->bindParam(':id_aprobador_oc',$id_patron);
                    $stmt_veri->bindParam(':id_estado', $status);
                    if(!($stmt_veri -> execute())){
                        echo "<script>
                                 alert('error');
                                 window.location.href = '".APP_URL."?views=aprobaciones/';
                            </script>";
                    }


                    $sql = "SELECT id,codigo_orden,id_proyecto,persona,id_tecnico,valor,compra_per,consecutivo,fecha,id_proveedor,retencion,centro_costos,observacion,subtotal,
                    forma_pago,lugar_entrega,cotizacion,id_poliza
                    FROM orden_compra  
                    WHERE id = :id_orden";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(':id_orden', $id_orden);
                    $stmt->execute();
                    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                    $codigo_oc = $resultado ? $resultado['codigo_orden'] : null;
                    $codigo_orden = $resultado ? $resultado['id'] : null;
                    $id_proyectos = $resultado ? $resultado['id_proyecto'] : null;
                    $persona = $resultado ? $resultado['persona'] : null;
                    $id_tecnico = $resultado ? $resultado['id_tecnico'] : null;
                    $valor = $resultado ? $resultado['valor'] : null;
                    $compra_per = $resultado ? $resultado['compra_per'] : null;
                    $consecutivo= $resultado ? $resultado['consecutivo'] : null;
                    $fecha= $resultado ? $resultado['fecha'] : null;
                    $proveedor= $resultado ? $resultado['id_proveedor'] : null;
                    $retencion= $resultado ? $resultado['retencion'] : null;
                    $centro_costos= $resultado ? $resultado['centro_costos'] : null;
                    $observacion= $resultado ? $resultado['observacion'] : null;
                    $subtotal= $resultado ? $resultado['subtotal'] : null;
                    $forma_pago= $resultado ? $resultado['forma_pago'] : null;
                    $lugar_entrega= $resultado ? $resultado['lugar_entrega'] : null;
                    $cotizacion= $resultado ? $resultado['cotizacion'] : null;
                    $id_poliza= $resultado ? $resultado['id_poliza'] : null;

                    if ($resultado && $codigo_orden && $id_proyectos && $persona && $id_tecnico && $valor) {
                        $sql1 = "INSERT INTO compra(codigo_ordenCompra, persona,tecnico,valor,id_estado_compra,proyecto,codigo_oc,compra_per,consecutivo,fecha,id_proveedor,retencion,centro_costos,observacion, subtotal,
                        forma_pago,lugar_entrega,cotizacion,id_poliza)
                         VALUES (:codigo_ordenCompra,:persona,:tecnico,:valor,:id_estado_compra,:proyecto,:codigo_oc,:compra_per,:consecutivo,:fecha,:id_proveedor,:retencion,:centro_costos,:observacion, :subtotal,
                         :forma_pago,:lugar_entrega,:cotizacion,:id_poliza)";
    
                        $stmt1 = $conn->prepare($sql1);
                        $stmt1->bindParam(':codigo_ordenCompra', $codigo_orden);
                        $stmt1->bindParam(':persona', $persona);
                        $stmt1->bindParam(':tecnico', $id_tecnico);
                        $stmt1->bindParam(':valor', $valor);
                        $stmt1->bindParam(':id_estado_compra', $estado);
                        $stmt1->bindParam(':proyecto', $id_proyectos);
                        $stmt1->bindParam(':codigo_oc', $codigo_oc);
                        $stmt1->bindParam(':compra_per', $compra_per);
                        $stmt1->bindParam(':consecutivo', $consecutivo);
                        $stmt1->bindParam(':fecha', $fecha);
                        $stmt1->bindParam(':id_proveedor', $proveedor);
                        $stmt1->bindParam(':retencion', $retencion);
                        $stmt1->bindParam(':centro_costos', $centro_costos);
                        $stmt1->bindParam(':observacion', $observacion);
                        $stmt1->bindParam(':subtotal', $subtotal);
                        $stmt1->bindParam(':forma_pago', $forma_pago);
                        $stmt1->bindParam(':lugar_entrega', $lugar_entrega );
                        $stmt1->bindParam(':cotizacion', $cotizacion);
                        $stmt1->bindParam(':id_poliza', $id_poliza);

                        if ($stmt1->execute()) {
                            // Obtener el último ID de la compra insertada
                            $id_compra = $conn->lastInsertId();
    
                            $sql_rete = "SELECT retencion FROM  retencion_ordencompra WHERE id_ordenCompra = :id_orden";
                            $stmt_rete = $conn->prepare($sql_rete);
                            $stmt_rete->bindParam(':id_orden', $id_orden);
                            $stmt_rete->execute();
                            $resultado = $stmt_rete->fetch(PDO::FETCH_ASSOC);
                            $retencion = $resultado ? $resultado['retencion'] : null;
                            if($resultado && $retencion){
                                    $sql_rc = "INSERT INTO retencion_compra(id_Compra,retencion) 
                                            VALUES (:id_Compra,:retencion)";
                                    $stmt_rc = $conn->prepare($sql_rc);
                                    $stmt_rc->bindParam(':id_Compra', $id_compra);
                                    $stmt_rc->bindParam(':retencion', $retencion);
                                    if($stmt_rc->execute()){
                                        // Ahora copiamos los ítems desde 'item_compra' hacia 'compra_item'
                                $sql_items = "SELECT item, cantidad, codigo_item, valor, descuento, valor_uni 
                                            FROM item_compra 
                                            WHERE id_orden = :id_orden";
                                $stmt_items = $conn->prepare($sql_items);
                                $stmt_items->bindParam(':id_orden', $id_orden);
                                $stmt_items->execute();
                                $items = $stmt_items->fetchAll(PDO::FETCH_ASSOC);
    
                                if ($items) {
                                    foreach ($items as $item) {
                                        $sql_insert_item = "INSERT INTO compra_item (id_compra, item, cantidad, codigo_item, valor, descuento,valor_uni) 
                                                            VALUES (:id_compra, :item, :cantidad, :codigo_item, :valor, :descuento,:valor_uni)";
                                        $stmt_insert_item = $conn->prepare($sql_insert_item);
                                        $stmt_insert_item->bindParam(':id_compra', $id_compra);
                                        $stmt_insert_item->bindParam(':item', $item['item']);
                                        $stmt_insert_item->bindParam(':cantidad', $item['cantidad']);
                                        $stmt_insert_item->bindParam(':codigo_item', $item['codigo_item']);
                                        $stmt_insert_item->bindParam(':valor', $item['valor']);
                                        $stmt_insert_item->bindParam(':descuento', $item['descuento']);
                                        $stmt_insert_item->bindParam(':valor_uni', $item['valor_uni']);
                                        $stmt_insert_item->execute();
                                    }
                                        $sqlIva= "SELECT iva,valor FROM valor_iva WHERE id_orden = :id_orden";
                                        $stmtIva = $conn->prepare($sqlIva);
                                        $stmtIva->bindParam(':id_orden', $id_orden);
                                        $stmtIva->execute();
                                        $iva = $stmtIva->fetchAll(PDO::FETCH_ASSOC);
                                        if($iva){
                                            foreach($iva as $iva){
                                                $sqlIvaInsert = "INSERT INTO valor_iva_compra(id_compra, iva, valor) 
                                                VALUES (:id_compra, :iva, :valor)";
                                                $stmr_ivaIn = $conn->prepare($sqlIvaInsert);
                                                $stmr_ivaIn -> bindParam(':id_compra', $id_compra);
                                                $stmr_ivaIn -> bindParam(':iva', $iva['iva']);
                                                $stmr_ivaIn -> bindParam(':valor', $iva['valor']);
                                                if($stmr_ivaIn ->execute()){
                                                    //envio de correo a Alejandro
                                                    enviarCorreo('gerencia@acemaingenieria.com','gerencia');
                                                    echo "<script>
                                                    alert('aprobacion exitosa');
                                                    window.location.href = '".APP_URL."?views=aprobaciones/';
                                                    </script>";
                                                } else {
                                                    echo "<script>
                                                    alert('No se encontraron ítems para esta orden.');
                                                    window.location.href = '".APP_URL."?views=aprobaciones/';
                                                    </script>";
                                                    
                                                }
        
                                            }
    
    
                                    }else{
                                        //envio de correo a Alejandro
                                        enviarCorreo('gerencia@acemaingenieria.com','gerencia');
                                        echo "<script>
                                        alert('aprobacion exitosa');
                                        window.location.href = '".APP_URL."?views=aprobaciones/';
                                        </script>";
                                    }
                                }
                                    }
                            }
                        }
                
                    }

                } else {
                    $sqlApro = "INSERT INTO aprobaciones (id_orden_compra, id_aprobador, id_estado)
                    VALUES (:id_orden_compra, :id_aprobador_oc, :id_estado)";
                    $stmt = $conn->prepare($sqlApro);
                    $stmt->bindParam(':id_orden_compra', $id_orden);
                    $stmt->bindParam(':id_aprobador_oc', $id_patron);
                    $stmt->bindParam(':id_estado', $estado);

                    if (!$stmt->execute()) {
                        throw new Exception("Error al insertar la aprobación");
                    } else {
                        //envio de correo a Alejandro
                        enviarCorreo('gerencia@acemaingenieria.com','gerencia');
                        echo "<script>
                        alert('aprobacion exitosa');
                        window.location.href = '".APP_URL."?views=aprobaciones/';
                        </script>";
                    }
                }
            }
        }else if($id_rol == 1){
            


            $sql = "UPDATE aprobaciones SET id_estado = 2 WHERE id_orden_compra = :id_orden";  // 2 es el estado aprobado
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id_orden', $id_orden);
            if(!($stmt -> execute())){
                echo "<script>
                         alert('error');
                         window.location.href = '".APP_URL."?views=aprobaciones/';
                    </script>";
            }
            
            $sql_veri = "UPDATE aprobaciones SET id_estado = 3 WHERE id_orden_compra = :id_orden AND id_aprobador = :id_gerente";
            $stmt_veri= $conn->prepare($sql_veri);
            $stmt_veri ->bindParam(':id_orden', $id_orden);
            $stmt_veri ->bindParam(':id_gerente',$id_gerenteProyectos);
            if ($stmt_veri->execute()) {
                $sql = "SELECT id,codigo_orden,id_proyecto,persona,id_tecnico,valor,compra_per,consecutivo,fecha,id_proveedor,retencion,centro_costos,observacion,subtotal,
                forma_pago,lugar_entrega,cotizacion,id_poliza
                FROM orden_compra  
                WHERE id = :id_orden";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':id_orden', $id_orden);
                $stmt->execute();
                $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                $codigo_oc = $resultado ? $resultado['codigo_orden'] : null;
                $codigo_orden = $resultado ? $resultado['id'] : null;
                $id_proyectos = $resultado ? $resultado['id_proyecto'] : null;
                $persona = $resultado ? $resultado['persona'] : null;
                $id_tecnico = $resultado ? $resultado['id_tecnico'] : null;
                $valor = $resultado ? $resultado['valor'] : null;
                $compra_per = $resultado ? $resultado['compra_per'] : null;
                $consecutivo= $resultado ? $resultado['consecutivo'] : null;
                $fecha= $resultado ? $resultado['fecha'] : null;
                $proveedor= $resultado ? $resultado['id_proveedor'] : null;
                $retencion= $resultado ? $resultado['retencion'] : null;
                $centro_costos= $resultado ? $resultado['centro_costos'] : null;
                $observacion= $resultado ? $resultado['observacion'] : null;
                $subtotal= $resultado ? $resultado['subtotal'] : null;
                $forma_pago= $resultado ? $resultado['forma_pago'] : null;
                $lugar_entrega= $resultado ? $resultado['lugar_entrega'] : null;
                $cotizacion= $resultado ? $resultado['cotizacion'] : null;
                $id_poliza= $resultado ? $resultado['id_poliza'] : null;

                if ($resultado && $codigo_orden && $id_proyectos && $persona && $id_tecnico && $valor) {
                    $sql1 = "INSERT INTO compra(codigo_ordenCompra, persona,tecnico,valor,id_estado_compra,proyecto,codigo_oc,compra_per,consecutivo,fecha,id_proveedor,retencion,centro_costos,observacion, subtotal,
                    forma_pago,lugar_entrega,cotizacion,id_poliza)
                     VALUES (:codigo_ordenCompra,:persona,:tecnico,:valor,:id_estado_compra,:proyecto,:codigo_oc,:compra_per,:consecutivo,:fecha,:id_proveedor,:retencion,:centro_costos,:observacion, :subtotal,
                     :forma_pago,:lugar_entrega,:cotizacion,:id_poliza)";

                    $stmt1 = $conn->prepare($sql1);
                    $stmt1->bindParam(':codigo_ordenCompra', $codigo_orden);
                    $stmt1->bindParam(':persona', $persona);
                    $stmt1->bindParam(':tecnico', $id_tecnico);
                    $stmt1->bindParam(':valor', $valor);
                    $stmt1->bindParam(':id_estado_compra', $estado);
                    $stmt1->bindParam(':proyecto', $id_proyectos);
                    $stmt1->bindParam(':codigo_oc', $codigo_oc);
                    $stmt1->bindParam(':compra_per', $compra_per);
                    $stmt1->bindParam(':consecutivo', $consecutivo);
                    $stmt1->bindParam(':fecha', $fecha);
                    $stmt1->bindParam(':id_proveedor', $proveedor);
                    $stmt1->bindParam(':retencion', $retencion);
                    $stmt1->bindParam(':centro_costos', $centro_costos);
                    $stmt1->bindParam(':observacion', $observacion);
                    $stmt1->bindParam(':subtotal', $subtotal);
                    $stmt1->bindParam(':forma_pago', $forma_pago);
                    $stmt1->bindParam(':lugar_entrega', $lugar_entrega);
                    $stmt1->bindParam(':cotizacion', $cotizacion);
                    $stmt1->bindParam(':id_poliza', $id_poliza);


                    if ($stmt1->execute()) {
                        // Obtener el último ID de la compra insertada
                        $id_compra = $conn->lastInsertId();

                        $sql_rete = "SELECT retencion FROM  retencion_ordencompra WHERE id_ordenCompra = :id_orden";
                        $stmt_rete = $conn->prepare($sql_rete);
                        $stmt_rete->bindParam(':id_orden', $id_orden);
                        $stmt_rete->execute();
                        $resultado = $stmt_rete->fetch(PDO::FETCH_ASSOC);
                        $retencion = $resultado ? $resultado['retencion'] : null;
                        if($resultado && $retencion){
                                $sql_rc = "INSERT INTO retencion_compra(id_Compra,retencion) 
                                        VALUES (:id_Compra,:retencion)";
                                $stmt_rc = $conn->prepare($sql_rc);
                                $stmt_rc->bindParam(':id_Compra', $id_compra);
                                $stmt_rc->bindParam(':retencion', $retencion);
                                if($stmt_rc->execute()){
                                    // Ahora copiamos los ítems desde 'item_compra' hacia 'compra_item'
                            $sql_items = "SELECT item, cantidad, codigo_item, valor, descuento,valor_uni
                                        FROM item_compra 
                                        WHERE id_orden = :id_orden";
                            $stmt_items = $conn->prepare($sql_items);
                            $stmt_items->bindParam(':id_orden', $id_orden);
                            $stmt_items->execute();
                            $items = $stmt_items->fetchAll(PDO::FETCH_ASSOC);

                            if ($items) {
                                foreach ($items as $item) {
                                    $sql_insert_item = "INSERT INTO compra_item (id_compra, item, cantidad, codigo_item, valor, descuento,valor_uni) 
                                                        VALUES (:id_compra, :item, :cantidad, :codigo_item, :valor, :descuento,:valor_uni)";
                                    $stmt_insert_item = $conn->prepare($sql_insert_item);
                                    $stmt_insert_item->bindParam(':id_compra', $id_compra);
                                    $stmt_insert_item->bindParam(':item', $item['item']);
                                    $stmt_insert_item->bindParam(':cantidad', $item['cantidad']);
                                    $stmt_insert_item->bindParam(':codigo_item', $item['codigo_item']);
                                    $stmt_insert_item->bindParam(':valor', $item['valor']);
                                    $stmt_insert_item->bindParam(':descuento', $item['descuento']);
                                    $stmt_insert_item->bindParam(':valor_uni', $item['valor_uni']);

                                    $stmt_insert_item->execute();
                                }
                                $sqlIva= "SELECT iva,valor FROM valor_iva WHERE id_orden = :id_orden";
                                $stmtIva = $conn->prepare($sqlIva);
                                $stmtIva->bindParam(':id_orden', $id_orden);
                                $stmtIva->execute();
                                $iva = $stmtIva->fetchAll(PDO::FETCH_ASSOC);
                                if($iva){
                                    foreach($iva as $iva){
                                        $sqlIvaInsert = "INSERT INTO valor_iva_compra(id_compra, iva, valor) 
                                        VALUES (:id_compra, :iva, :valor)";
                                        $stmr_ivaIn = $conn->prepare($sqlIvaInsert);
                                        $stmr_ivaIn -> bindParam(':id_compra', $id_compra);
                                        $stmr_ivaIn -> bindParam(':iva', $iva['iva']);
                                        $stmr_ivaIn -> bindParam(':valor', $iva['valor']);
                                        if($stmr_ivaIn ->execute()){
                                            enviarCorreo($correoRespo,$nombreRespo);
                                            echo "<script>
                                            alert('aprobacion exitosa');
                                            window.location.href = '".APP_URL."?views=aprobaciones/';
                                            </script>";
                                        } else {
                                            echo "<script>
                                            alert('No se encontraron ítems para esta orden.');
                                            window.location.href = '".APP_URL."?views=aprobaciones/';
                                            </script>";
                                            
                                        }

                                    }


                                }else{
                                    enviarCorreo($correoRespo,$nombreRespo);
                                    echo "<script>
                                    alert('aprobacion exitosa');
                                    window.location.href = '".APP_URL."?views=aprobaciones/';
                                    </script>";
                                }
                            }
                                }
                        }
                    }
            
                }
            }

        }
        break;
    case 'rechazar':
                echo "<script>
                window.location.href = '".APP_URL."?views=rechazar&id=$id_orden';
                </script>";
        break;
}

?>