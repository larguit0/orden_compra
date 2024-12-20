<?php
require_once __DIR__ . '/../../config/app.php';// Verificar si la sesión está iniciada
require_once __DIR__ . '/../../config/server.php'; // Ruta a la clase server.php
$conn = Database::connect();

// Verificar si la sesión está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Conexión a la base de datos


$proyecto = $_POST['id_remi'];
$remi = $_POST['id_remision'];
$sql_items = "SELECT id_inventario, cantidad FROM temp_remision_item";
$stmt_items = $conn->prepare($sql_items);
$stmt_items->execute();
$items = $stmt_items->fetchAll(PDO::FETCH_ASSOC);

if ($items) {
    foreach ($items as $item) {
        $sql_reInsert_item = "UPDATE inventario SET cantidad = cantidad + :quantity WHERE id = :id";
        $stmt_reInsert_item = $conn->prepare($sql_reInsert_item);
        $stmt_reInsert_item->bindParam(':quantity', $item['cantidad']);
        $stmt_reInsert_item->bindParam(':id', $item['id_inventario']);
        $stmt_reInsert_item->execute();
    }

    // Limpiar la tabla temporal después de actualizar el inventario
    $sql_clear_temp = "DELETE FROM temp_remision_item";
    $stmt_clear_temp = $conn->prepare($sql_clear_temp);
    $stmt_clear_temp->execute();

    header("Location: ".APP_URL."?views=Remmision&id=" . $proyecto."&idRe=".$remi);
    exit();
}else{
    header("Location: ".APP_URL."?views=Remmision&id=" . $proyecto."&idRe=".$remi);

}
