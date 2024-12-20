<?php
require_once __DIR__ . '/../../config/app.php';// Verificar si la sesión está iniciada

// Verificar si la sesión está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Conexión a la base de datos
require_once __DIR__ . '/../../config/server.php'; // Ruta a la clase server.php
$conn = Database::connect();

$id_codigo_orden = isset($_POST['codigo_orden']) ? $_POST['codigo_orden'] : null;
$id_proyecto = isset($_POST['id_proyecto']) ? $_POST['id_proyecto'] : null;
$persona = isset($_POST['persona']) ? $_POST['persona'] : null;
$id_tecnico = isset($_POST['id_tecnico']) ? $_POST['id_tecnico'] : null;
$valor = isset($_POST['valor']) ? $_POST['valor'] : null;
$compra_per = isset($_POST['compra_per']) ? $_POST['compra_per'] : null;
$consecutivo = isset($_POST['consecutivo']) ? $_POST['consecutivo'] : null;
$fecha = date("Y-m-d");
$id_proveedor = isset($_POST['id_provedor']) ? $_POST['id_provedor'] : 2;
$descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : null;
$id_orden = isset($_POST['id_orden']) ? $_POST['id_orden'] : null;



$sql = "INSERT INTO orden_compra_rechazada(id_codigo_orden,id_proyecto,persona,id_tecnico, 
        valor,compra_per,consecutivo,fecha,id_proveedor,descripcion)
        VALUES (:id_codigo_orden,:id_proyecto,:persona,:id_tecnico, 
        :valor,:compra_per,:consecutivo,:fecha,:id_proveedor,:descripcion)";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id_codigo_orden', $id_codigo_orden);
$stmt->bindParam(':id_proyecto', $id_proyecto);
$stmt->bindParam(':persona', $persona);
$stmt->bindParam(':id_tecnico', $id_tecnico);
$stmt->bindParam(':valor', $valor);
$stmt->bindParam(':compra_per', $compra_per);
$stmt->bindParam(':consecutivo', $consecutivo);
$stmt->bindParam(':fecha', $fecha);
$stmt->bindParam(':id_proveedor', $id_proveedor);
$stmt->bindParam(':descripcion', $descripcion);


if($stmt->execute()){
    $id_orden_rechazada = $conn->lastInsertId();

    $sql_item = "SELECT item, cantidad, codigo_item, valor,descuento 
                FROM item_compra 
                WHERE id_orden = :id_orden";
    $stmt_items = $conn->prepare($sql_item);
    $stmt_items->bindParam(':id_orden', $id_orden);
    $stmt_items->execute();
    $items = $stmt_items->fetchAll(PDO::FETCH_ASSOC);

    if($items){
        foreach($items as $item){
            $sql_insert = "INSERT INTO rechazada_item(id_orden_compra_rechazada,item,cantidad,codigo_item, valor,descuento)
             VALUES (:id_orden_compra_rechazada,:item,:cantidad,:codigo_item, :valor,:descuento) ";
            $stmt_insert = $conn->prepare($sql_insert);
            $stmt_insert->bindParam(':id_orden_compra_rechazada', $id_orden_rechazada);
            $stmt_insert->bindParam(':item', $item['item']);
            $stmt_insert->bindParam(':cantidad', $item['cantidad']);
            $stmt_insert->bindParam(':codigo_item', $item['codigo_item']);
            $stmt_insert->bindParam(':valor', $item['valor']);
            $stmt_insert->bindParam(':descuento', $item['descuento']);
            if($stmt_insert->execute()){
                $sqlDelete = "DELETE FROM orden_compra WHERE id = :id_orden";
                $stmt_delete = $conn->prepare($sqlDelete);
                $stmt_delete->bindParam(':id_orden',$id_orden);
                if($stmt_delete -> execute()){
                    echo "<script>
                        alert('orden rechazada.');
                        window.location.href = '".APP_URL."?views=aprobaciones/';
                    </script>";
                }
            }
        }
    }

}


