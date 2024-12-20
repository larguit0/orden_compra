<?php
require_once __DIR__ . '/../../config/app.php';// Verificar si la sesión está iniciada

// Verificar si la sesión ya está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Conexión a la base de datos
require_once __DIR__ . '/../../config/server.php'; // Ruta a la clase server.php
$conn = Database::connect();


$remi = $_POST['id_remi'];
$item_id = $_POST['item_id'];
$cantidad = $_POST['cantidad'];
$proyecto = $_POST['id_remision'];
$empresa = $_POST['empresa'];
$nit = $_POST['nit'];
$direccion = $_POST['direccion'];
$contacto = $_POST['contacto'];
$telefono = $_POST['telefono'];
$correo = $_POST['correo'];

$sql = "SELECT ci.codigo_item FROM inventario i INNER JOIN compra_item ci ON ci.id = i.id_compra_item WHERE  i.id = :id ";
$stmt = $conn->prepare($sql);
$stmt -> bindParam(':id',$item_id);
$stmt -> execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC); // Corregido el fetch
if($result){
    $codigo_item = $result['codigo_item'];
}

$sql = "SELECT ci.item FROM inventario i INNER JOIN compra_item ci ON ci.id = i.id_compra_item WHERE  i.id = :id ";
$stmt = $conn->prepare($sql);
$stmt -> bindParam(':id',$item_id);
$stmt -> execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC); // Corregido el fetch
if($result){
    $item = $result['item'];
}

$sql1 = "INSERT INTO temp_remision_item(id_inventario, id_remsion, item, cantidad)
 VALUES (:id_inventario, :id_remsion, :item, :cantidad)";
 $stmt = $conn->prepare($sql1);
 $stmt->bindParam(':id_inventario', $item_id);
$stmt->bindParam(':id_remsion', $codigo_item);
$stmt->bindParam(':item', $item);
$stmt->bindParam(':cantidad', $cantidad);
if (!$stmt->execute()) {
     throw new Exception("Error al insertar ítem de la orden");
}else{
    $sql = "UPDATE inventario
    SET cantidad=cantidad - :valor WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':valor', $cantidad);
    $stmt->bindParam(':id', $item_id);
    if ($stmt->execute()){
       header("Location: ".APP_URL."?views=Remmision&id=" . $proyecto. "&idRe=".$remi);
       exit();
    }
}




