<?php
require_once __DIR__ . '/../../config/app.php';// Verificar si la sesión está iniciada

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../fpdf/fpdf.php';

// Conexión a la base de datos
require_once __DIR__ . '/../../config/server.php'; // Ruta a la clase server.php
$conn = Database::connect();

$persona = $_POST['persona'];
$id_remision = $_POST['id_remision'];

// Capturar el nombre de la persona que esta haciendo la remisión
$sqlPersona = "SELECT nombre, apellido FROM usuario WHERE id = :id";
$stmt = $conn->prepare($sqlPersona);
$stmt->bindParam(':id', $persona);
$stmt->execute();
$personaN = $stmt->fetch(PDO::FETCH_ASSOC);

// Obtener los datos necesarios de la base de datos
$sql_remision = "SELECT * FROM remision WHERE id = :id_remision";
$stmt_remision = $conn->prepare($sql_remision);
$stmt_remision->bindParam(':id_remision', $id_remision);
$stmt_remision->execute();
$remision = $stmt_remision->fetch(PDO::FETCH_ASSOC);

//validar que solo se genere una orden de compra 
$sqlVal = "SELECT id_remision, COUNT(*) FROM remision_item WHERE id_remision = :id_remision ";
$stmtVal = $conn -> prepare($sqlVal);
$stmtVal -> bindParam(':id_remision', $id_remision);
$stmtVal -> execute();
$remisionExits = $stmtVal->fetchColumn();
if($remisionExits != 0){
    echo "<script>
    alert('insercción en inventario exitosa');
    window.location.href = '" . APP_URL . "?views=Remision1/';
    </script>";
exit;
}


// Validación de existencia en la tabla temp_remision_item
$sql = "SELECT COUNT(*) FROM temp_remision_item";
$stmt = $conn->prepare($sql);
$stmt->execute();
$temp = $stmt->fetchColumn();

if ($temp == 0) {
    echo "<script>
    alert('No se ha seleccionado ningún item para la remisión');
    window.location.href = '".APP_URL."?views=Remision1';
    </script>";
    exit(); // Asegurarse de detener la ejecución si no hay ítems
} else {
    $sql_items = "SELECT id_inventario, item, cantidad FROM temp_remision_item";
    $stmt_items = $conn->prepare($sql_items);
    $stmt_items->execute();
    $items = $stmt_items->fetchAll(PDO::FETCH_ASSOC);

    if ($items) {
        foreach ($items as $item) {
            $sql_Insert_item = "INSERT INTO remision_item(id_inventario, id_remision, descripcion, cantidad)
                                VALUES (:id_inventario, :id_remision, :descripcion, :cantidad)";
            $stmt_Insert_item = $conn->prepare($sql_Insert_item);
            $stmt_Insert_item->bindParam(':id_inventario', $item['id_inventario']);
            $stmt_Insert_item->bindParam(':id_remision', $id_remision);
            $stmt_Insert_item->bindParam(':descripcion', $item['item']);
            $stmt_Insert_item->bindParam(':cantidad', $item['cantidad']);
            $stmt_Insert_item->execute();
        }

        // Limpiar la tabla temporal después de actualizar el inventario
        $sql_clear_temp = "DELETE FROM temp_remision_item";
        $stmt_clear_temp = $conn->prepare($sql_clear_temp);
        $stmt_clear_temp->execute();

        // Crear el PDF con FPDF
        $pdf = new FPDF();
        $pdf->AddPage();

        // Logo
        $pdf->SetFont('Arial', 'B', 12);

        // Logo
        $pdf->Image('https://erp-acema.com/images/Logo-acema-sin%20fondo.png', 10, 10, 50);
        $pdf->Cell(0, 10, 'ACEMA INGENIERIA SAS', 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 12);  // Fuente para otras celdas
        $pdf->Cell(0, 10, 'NIT: 901635197', 0, 1, 'C');
        $pdf->Cell(0, 10, '+57 3103604259', 0, 1, 'C');
        $pdf->Cell(0, 10, 'facturas@acemaingenieria.com', 0, 1, 'C');
        $pdf->Cell(0, 10, 'Remision', 0, 1, 'C');
        $pdf->Ln(5);
  

     

        // Información de la remisión
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(40, 10, 'Nombre Empresa:', 0, 0, 'L');
        $pdf->Cell(0, 10, $remision['empresa'] ?? 'N/A', 0, 1, 'L');
        $pdf->Cell(40, 10, 'Contacto:', 0, 0, 'L');
        $pdf->Cell(0, 10, $remision['contacto'] ?? 'N/A', 0, 1, 'L');
        $pdf->Cell(40, 10, 'NIT:', 0, 0, 'L');
        $pdf->Cell(0, 10, $remision['nit'] ?? 'N/A', 0, 1, 'L');
        $pdf->Cell(40, 10, 'Correo:', 0, 0, 'L');
        $pdf->Cell(0, 10, $remision['correo'] ?? 'N/A', 0, 1, 'L');
        $pdf->Cell(40, 10, 'Direccion:', 0, 0, 'L');
        $pdf->Cell(0, 10,$remision['direccion'] ?? 'N/A', 0, 1, 'L');
        $pdf->Cell(40, 10, 'Telefono:', 0, 0, 'L');
        $pdf->Cell(0, 10, $remision['telefono'] ?? 'N/A', 0, 1, 'L');
        $pdf->Cell(40, 10, 'Ciudad:', 0, 0, 'L');
        $pdf->Cell(0, 10,$remision['ciudad'] ?? 'N/A', 0, 1, 'L');
        $pdf->Cell(40, 10, 'Proyecto:', 0, 0, 'L');
        $pdf->Cell(0, 10, $remision['proyecto'] ?? 'N/A', 0, 1, 'L');
        $pdf->Ln(10);

        // Tabla de ítems
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(30, 10, 'CODIGO', 1, 0, 'C');
        $pdf->Cell(100, 10, 'DESCRIPCION', 1, 0, 'C');
        $pdf->Cell(30, 10, 'CANTIDAD', 1, 1, 'C');
        $widths = [30, 100, 30]; // Ajusta estos valores según el diseño de tu tabla
        $rowHeight = 10; // Altura de la fila
        
        $pdf->SetFont('Arial', '', 10);
        foreach ($items as $item) {
            $sql_front = "SELECT ci.codigo_item, ri.descripcion, ri.cantidad 
                          FROM remision_item ri
                          INNER JOIN inventario i ON i.id = ri.id_inventario
                          INNER JOIN compra_item ci ON ci.id = i.id_compra_item
                          WHERE ri.id_remision = :id_remision AND ri.id_inventario = :id_inventario";
            $stmt_f = $conn->prepare($sql_front);
            $stmt_f->bindParam(':id_remision', $id_remision);
            $stmt_f->bindParam(':id_inventario', $item['id_inventario']);
            $stmt_f->execute();
            $front = $stmt_f->fetch(PDO::FETCH_ASSOC);
        
            // Calcula el número de líneas necesarias para la descripción
            $nbLines = $pdf->NbLines($widths[1], utf8_decode($front['descripcion']));
            $height = $rowHeight * $nbLines;
        
            // Columna 1: Código del ítem
            $pdf->Cell($widths[0], $height, $front['codigo_item'], 1, 0, 'L');
        
            // Columna 2: Descripción (usando MultiCell para el ajuste de texto)
            $x = $pdf->GetX();
            $y = $pdf->GetY();
            $pdf->MultiCell($widths[1], $rowHeight, utf8_decode($front['descripcion']), 1, 'L');
            $pdf->SetXY($x + $widths[1], $y);
        
            // Columna 3: Cantidad
            $pdf->Cell($widths[2], $height, $front['cantidad'], 1, 1, 'C');
        }
                // Firmas
        $pdf->Ln(10);

        // "Entregado por"
        $pdf->Cell(90, 10, 'Entregado por: ' . htmlspecialchars($personaN['nombre'] ?? 'N/A') . ' ' . htmlspecialchars($personaN['apellido'] ?? 'N/A'), 0, 0, 'C');
        $pdf->Cell(90, 10, 'Recibido por: ____________________', 0, 1, 'C'); // Recibido por

        // Cédula
        $pdf->Cell(90, 10, 'Cedula: ____________________', 0, 0, 'C');
        $pdf->Cell(90, 10, 'Cedula: ____________________', 0, 1, 'C');

        // Firma
        $pdf->Cell(90, 10, 'Firma: ____________________', 0, 0, 'C');
        $pdf->Cell(90, 10, 'Fecha: ____________________', 0, 1, 'C');

        // Fecha
        $pdf->Cell(90, 10, 'Fecha: ' . date("Y-m-d"), 0, 1, 'C');
        $pdf->Ln(10);

        // Salida del PDF
        $pdf->Output('remision_' . $id_remision . '.pdf', 'D');
    }
}
?>
