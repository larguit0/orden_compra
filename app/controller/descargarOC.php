<?php
// Verificar si la sesión ya está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Conexión a la base de datos
require_once __DIR__ . '/../../config/server.php'; // Ruta a la clase server.php
$conn = Database::connect();
require_once __DIR__ . '/../../fpdf/fpdf.php';


require_once __DIR__ . '/../../config/app.php'; // Verificar si la sesión está iniciada

$id_compra = $_POST['id_compra'];
//DATOS CONSECUTIVO
$sqlDta = "SELECT consecutivo,retencion,valor,centro_costos,forma_pago, cotizacion,lugar_entrega,id_poliza FROM compra WHERE id= :id_compra";
$stmtData= $conn->prepare($sqlDta);
$stmtData->bindParam(':id_compra', $id_compra);
$stmtData->execute();
$resultadoCon = $stmtData->fetch(PDO::FETCH_ASSOC);
$consecutivo = $resultadoCon ? $resultadoCon['consecutivo']:null;
$rete = $resultadoCon ? $resultadoCon['retencion']:00;
$valor = $resultadoCon ? $resultadoCon['valor']:00;
$centro_costos = $resultadoCon ? $resultadoCon['centro_costos']:null;
$forma_pago = $resultadoCon ? $resultadoCon['forma_pago']:null;
$cotizacion = $resultadoCon ? $resultadoCon['cotizacion']:null;
$lugar_entrega = $resultadoCon ? $resultadoCon['lugar_entrega']:null;
$id_poliza = $resultadoCon ? $resultadoCon['id_poliza']:null;


$retencion = $valor * ($rete/100);


//DATOS IVA


$sqlIva5 = "SELECT valor FROM valor_iva_compra WHERE id_compra = :id_compra AND iva = 5";
$stmtIva5 = $conn->prepare($sqlIva5);
$stmtIva5 -> bindParam(':id_compra', $id_compra);
$stmtIva5->execute();
$resultadoIva5 = $stmtIva5->fetch(PDO::FETCH_ASSOC);
$iva5 = $resultadoIva5 ? $resultadoIva5['valor']:00;

$sqlIva10 = "SELECT valor FROM valor_iva_compra WHERE id_compra = :id_compra AND iva = 10.00";
$stmtIva10 = $conn->prepare($sqlIva10);
$stmtIva10 -> bindParam(':id_compra', $id_compra);
$stmtIva10->execute();
$resultadoIva10 = $stmtIva10->fetch(PDO::FETCH_ASSOC);
$iva10 = $resultadoIva10 ? $resultadoIva10['valor']:00;

$sqlIva19 = "SELECT valor FROM valor_iva_compra WHERE id_compra = :id_compra AND iva = 19.00";
$stmtIva19 = $conn->prepare($sqlIva19);
$stmtIva19 -> bindParam(':id_compra', $id_compra);
$stmtIva19->execute();
$resultadoIva19 = $stmtIva19->fetch(PDO::FETCH_ASSOC);
$iva19 = $resultadoIva19 ? $resultadoIva19['valor']:00;

//DATOS NOMBRE PROYECTO
$sqlNom = "SELECT p.nombre FROM compra c INNER JOIN proyecto p ON p.id = c.proyecto WHERE c.id= :id_compra";
$stmtNom= $conn->prepare($sqlNom);
$stmtNom->bindParam(':id_compra', $id_compra);
$stmtNom->execute();
$resultadoNom = $stmtNom->fetch(PDO::FETCH_ASSOC);
$pryNombre = $resultadoNom ? $resultadoNom['nombre']:null;

//DATOS DEL PROVEEDOR 
$sql = "SELECT p.nombre, p.direccion, p.ciudad, p.nit,c.subtotal,c.observacion FROM compra c 
        INNER JOIN proveedor p ON c.id_proveedor = p.id WHERE c.id = :id_compra";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id_compra', $id_compra);
$stmt->execute();
$resultado = $stmt->fetch(PDO::FETCH_ASSOC);
$nombre_prov = $resultado ? $resultado['nombre'] : null;
$direccion_prov = $resultado ? $resultado['direccion'] : null;
$ciudad_prov = $resultado ? $resultado['ciudad'] : null;
$nit_prov = $resultado ? $resultado['nit'] : null;
$subtotal = $resultado ? $resultado['subtotal'] : null;
$observacion = $resultado ? $resultado['observacion'] : null;

$sql_items = "SELECT ci.id, ci.item, ci.descuento, ci.codigo_item, ci.cantidad, ci.valor ,ci.valor_uni
              FROM compra_item ci 
              WHERE ci.id_compra = :id";
$stmt_items = $conn->prepare($sql_items);
$stmt_items->bindParam(':id', $id_compra);
$stmt_items->execute();
$items = $stmt_items->fetchAll(PDO::FETCH_ASSOC);
if ($items) {
    if($id_poliza == 1){
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 14);
    
        // Encabezado
        $pdf->Image('https://erp-acema.com/images/Logo-acema-sin%20fondo.png', 10, 10, 50);
    
        // Nombres y N OC en la misma línea con ajuste
        $pdf->SetX(70); // Mover la posición horizontal después del logo
        $pdf->Cell(100, 10, 'ACEMA INGENIERIA SAS', 0, 0, 'C'); // Texto central
        $pdf->SetX(-50); // Mover a la derecha para colocar el N OC
        $pdf->Cell(40, 10, "N OC $consecutivo", 0, 1, 'R'); // N OC a la derecha
    
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 10, 'NIT: 901635197', 0, 1, 'C');
        $pdf->Cell(0, 10, '+57 3196633929', 0, 1, 'C');
        $pdf->Cell(0, 10, 'facturas@acemaingenieria.com', 0, 1, 'C');
        $pdf->Ln(10);
    
        // Información del proveedor
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(0, 10, "Proyecto: $pryNombre", 0, 1);
        $pdf->Cell(0, 10, "Senor(es): $nombre_prov", 0, 1);
        $pdf->Cell(0, 10, "Ciudad: $ciudad_prov", 0, 1);
        $pdf->Cell(0, 10, "Direccion: $direccion_prov", 0, 1);
        $pdf->Cell(0, 10, "Centro Costos: $centro_costos", 0, 1);
        $pdf->Cell(0, 10, "NIT: $nit_prov", 0, 1);
    
        $pdf->Cell(30, 10, "Forma de Pago: ", 0, 0);
        $pdf->MultiCell(0, 10, utf8_decode( $forma_pago), 0, 'L');
    
        $pdf->Cell(30, 10, "Lugar de Entrega:", 0, 0);
        $pdf->MultiCell(0, 10, utf8_decode( $lugar_entrega), 0, 'L');
    
        $pdf->Cell(30, 10, "Cotizacion: ", 0, 0);
        $pdf->MultiCell(0, 10, utf8_decode($cotizacion), 0, 'L');
    
        $pdf->Cell(30, 10, 'Observaciones:', 0, 0); 
        $pdf->MultiCell(0, 10, utf8_decode($observacion), 0, 'L');    $pdf->Ln(5);
    
        // Tabla de ítems
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(40, 10, 'Referencia', 1);
        $pdf->Cell(40, 10, 'Precio', 1);
        $pdf->Cell(30, 10, 'Descuento', 1);
        $pdf->Cell(30, 10, 'Cantidad', 1);
        $pdf->Cell(40, 10, 'Valor', 1);
        $pdf->Ln();
    
        $pdf->SetFont('Arial', '', 10);
        foreach ($items as $item) {
            // Determinar el ancho de cada columna
            $widths = [40, 40, 30, 30, 40]; // Ajusta los anchos según las columnas restantes
            $rowHeight = 10; // Altura base de una línea
        
            // Calcular altura de la fila según la celda más alta
            $pdf->SetFont('Arial', '', 10);
            $nbLines = $pdf->NbLines($widths[0], utf8_decode($item['item'])); // Calcular cuántas líneas ocupa el nombre del ítem
            $height = $rowHeight * $nbLines;
        
            $x = $pdf->GetX();
            $y = $pdf->GetY();
        
            // Columna 1: Nombre del ítem (con MultiCell)
            $pdf->MultiCell($widths[0], $rowHeight, utf8_decode($item['item']), 1, 'L');
            $pdf->SetXY($x + $widths[0], $y);
        
            // Columna 2: Precio
            $pdf->Cell($widths[1], $height, number_format($item['valor_uni'], 2, ',', '.'), 1, 0, 'C');
        
            // Columna 3: Descuento
            $pdf->Cell($widths[2], $height, $item['descuento'], 1, 0, 'C');
        
            // Columna 4: Cantidad
            $pdf->Cell($widths[3], $height, $item['cantidad'], 1, 0, 'C');
        
            // Columna 5: Valor
            $pdf->Cell($widths[4], $height, number_format($item['valor'], 2, ',', '.'), 1, 0, 'C');
        
            // Nueva línea
            $pdf->Ln();
        }
    
        // Totales
        $pdf->Ln(5);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(0, 10, "Subtotal: ".number_format($subtotal, 2, ',', '.'), 0, 1, 'R');
        $pdf->Cell(0, 10, "IVA 5%:" .number_format($iva5, 2, ',', '.'), 0, 1, 'R');
        $pdf->Cell(0, 10, "IVA 10%:".number_format($iva10, 2, ',', '.') , 0, 1, 'R');
        $pdf->Cell(0, 10, "IVA 19%: ".number_format($iva19, 2, ',', '.') , 0, 1, 'R');
        $pdf->Cell(0, 10, "Retencion ({$rete}%): " .number_format($retencion, 2, ',', '.'), 0, 1, 'R');
        $pdf->Cell(0, 10, "Total: ". number_format($valor, 2, ',', '.'), 0, 1, 'R');

    
                                // Texto de los Términos y Condiciones
                                $pdf->AddPage();
                                $pdf->SetFont('Arial', 'B', 14);
                                $pdf->Cell(0, 10, 'TERMINOS Y CONDICIONES', 0, 1, 'C');
                                $pdf->Ln(5);
                                
                                // Objeto
                                $pdf->SetFont('Arial', 'B', 12);
                                $pdf->Cell(0, 10, '1. Objeto:', 0, 1);
                                $pdf->SetFont('Arial', '', 12);
                                $pdf->MultiCell(0, 10, utf8_decode("Regulan la relación entre ACEMA INGENIERÍA SAS (EL VENDEDOR) y el cliente (EL COMPRADOR) según el Art. 1602 del Código Civil."));
                                $pdf->Ln(5);
                                
                                // Formación
                                $pdf->SetFont('Arial', 'B', 12);
                                $pdf->Cell(0, 10, '2. Formacion:', 0, 1);
                                $pdf->SetFont('Arial', '', 12);
                                $pdf->MultiCell(0, 10, utf8_decode("El contrato se perfecciona tras aceptación escrita de la oferta y orden de compra. Modificaciones solo por acuerdo escrito."));
                                $pdf->Ln(5);
                                
                                // Precios y Pagos
                                $pdf->SetFont('Arial', 'B', 12);
                                $pdf->Cell(0, 10, '3. Precios y Pagos:', 0, 1);
                                $pdf->SetFont('Arial', '', 12);
                                $pdf->MultiCell(0, 10, utf8_decode("Precios en pesos colombianos (COP), ajustables por incrementos en costos. La mora genera intereses al doble de la tasa bancaria corriente."));
                                $pdf->Ln(5);
                                
                                // Obligaciones del Comprador
                                $pdf->SetFont('Arial', 'B', 12);
                                $pdf->Cell(0, 10, '4. Obligaciones del Comprador:', 0, 1);
                                $pdf->SetFont('Arial', '', 12);
                                $pdf->MultiCell(0, 10, utf8_decode("Proveer información y recursos necesarios; asumir costos por retrasos atribuibles a él, conforme al principio de buena fe."));
                                $pdf->Ln(5);
                                
                                // Garantías
                                $pdf->SetFont('Arial', 'B', 12);
                                $pdf->Cell(0, 10, '5. Garantias:', 0, 1);
                                $pdf->SetFont('Arial', '', 12);
                                $pdf->MultiCell(0, 10, utf8_decode("Bienes y servicios garantizados contra defectos por 5 días hábiles tras su detección."));
                                $pdf->Ln(5);
                                
                                // Exclusiones
                                $pdf->SetFont('Arial', 'B', 12);
                                $pdf->Cell(0, 10, '6. Exclusiones:', 0, 1);
                                $pdf->SetFont('Arial', '', 12);
                                $pdf->MultiCell(0, 10, utf8_decode("EL VENDEDOR no responde por daños indirectos, fuerza mayor o caso fortuito."));
                                $pdf->Ln(5);
                                
                                // Penalidades
                                $pdf->SetFont('Arial', 'B', 12);
                                $pdf->Cell(0, 10, '7. Penalidades:', 0, 1);
                                $pdf->SetFont('Arial', '', 12);
                                $pdf->MultiCell(0, 10, utf8_decode("Incumplimientos del comprador generan suspensión, resolución del contrato o penalidades del 2% del valor del contrato diario, hasta un máximo del 20%."));
                                $pdf->Ln(5);
                                
                                // Propiedad y Riesgo
                                $pdf->SetFont('Arial', 'B', 12);
                                $pdf->Cell(0, 10, '8. Propiedad y Riesgo:', 0, 1);
                                $pdf->SetFont('Arial', '', 12);
                                $pdf->MultiCell(0, 10, utf8_decode("La propiedad se transfiere tras el pago total; el riesgo, al momento de la entrega."));
                                $pdf->Ln(5);
                                
                                // Mérito Ejecutivo
                                $pdf->SetFont('Arial', 'B', 12);
                                $pdf->Cell(0, 10, '9. Merito Ejecutivo:', 0, 1);
                                $pdf->SetFont('Arial', '', 12);
                                $pdf->MultiCell(0, 10, utf8_decode("El presente contrato presta mérito ejecutivo (Art. 422 del Código General del Proceso)."));
                                $pdf->Ln(5);
                                
                                // Firma
                                $pdf->SetFont('Arial', '', 12);
                                $pdf->MultiCell(0, 10, utf8_decode("
                                Firmado en [Ciudad], el [Fecha].
                                
                                EL COMPRADOR:
                                [Firma y datos]
                                
                                EL VENDEDOR:
                                [Firma y datos]
                                "));
    
        $pdf->Output('D', "OrdenCompra_$id_compra.pdf");
    
        // Redirección opcional si lo deseas después de la descarga
        echo "<script>
            alert('Orden de compra aprobada y PDF generado.');
            window.location.href = '" . APP_URL . "?views=comprasllegada/';
        </script>";

    }else{
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 14);
    
        // Encabezado
        $pdf->Image('https://erp-acema.com/images/Logo-acema-sin%20fondo.png', 10, 10, 50);
    
        // Nombres y N OC en la misma línea con ajuste
        $pdf->SetX(70); // Mover la posición horizontal después del logo
        $pdf->Cell(100, 10, 'ACEMA INGENIERIA SAS', 0, 0, 'C'); // Texto central
        $pdf->SetX(-50); // Mover a la derecha para colocar el N OC
        $pdf->Cell(40, 10, "N OC $consecutivo", 0, 1, 'R'); // N OC a la derecha
    
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 10, 'NIT: 901635197', 0, 1, 'C');
        $pdf->Cell(0, 10, '+57 3103604259', 0, 1, 'C');
        $pdf->Cell(0, 10, 'facturas@acemaingenieria.com', 0, 1, 'C');
        $pdf->Ln(10);
    
        // Información del proveedor
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(0, 10, "Proyecto: $pryNombre", 0, 1);
        $pdf->Cell(0, 10, "Senor(es): $nombre_prov", 0, 1);
        $pdf->Cell(0, 10, "Ciudad: $ciudad_prov", 0, 1);
        $pdf->Cell(0, 10, "Direccion: $direccion_prov", 0, 1);
        $pdf->Cell(0, 10, "Centro Costos: $centro_costos", 0, 1);
        $pdf->Cell(0, 10, "NIT: $nit_prov", 0, 1);
    
        $pdf->Cell(30, 10, "Forma de Pago: ", 0, 0);
        $pdf->MultiCell(0, 10, utf8_decode( $forma_pago), 0, 'L');
    
        $pdf->Cell(30, 10, "Lugar de Entrega:", 0, 0);
        $pdf->MultiCell(0, 10, utf8_decode( $lugar_entrega), 0, 'L');
    
        $pdf->Cell(30, 10, "Cotizacion: ", 0, 0);
        $pdf->MultiCell(0, 10, utf8_decode($cotizacion), 0, 'L');
    
        $pdf->Cell(30, 10, 'Observaciones:', 0, 0); 
        $pdf->MultiCell(0, 10, utf8_decode($observacion), 0, 'L');    $pdf->Ln(5);
    
        // Tabla de ítems
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(40, 10, 'Referencia', 1);
        $pdf->Cell(40, 10, 'Precio', 1);
        $pdf->Cell(30, 10, 'Descuento', 1);
        $pdf->Cell(30, 10, 'Cantidad', 1);
        $pdf->Cell(40, 10, 'Valor', 1);
        $pdf->Ln();
    
        $pdf->SetFont('Arial', '', 10);
        foreach ($items as $item) {
            // Determinar el ancho de cada columna
            $widths = [40, 40, 30, 30, 40]; // Ajusta los anchos según las columnas restantes
            $rowHeight = 10; // Altura base de una línea
        
            // Calcular altura de la fila según la celda más alta
            $pdf->SetFont('Arial', '', 10);
            $nbLines = $pdf->NbLines($widths[0], utf8_decode($item['item'])); // Calcular cuántas líneas ocupa el nombre del ítem
            $height = $rowHeight * $nbLines;
        
            $x = $pdf->GetX();
            $y = $pdf->GetY();
        
            // Columna 1: Nombre del ítem (con MultiCell)
            $pdf->MultiCell($widths[0], $rowHeight, utf8_decode($item['item']), 1, 'L');
            $pdf->SetXY($x + $widths[0], $y);
        
            // Columna 2: Precio
            $pdf->Cell($widths[1], $height, number_format($item['valor_uni'], 2, ',', '.'), 1, 0, 'C');
        
            // Columna 3: Descuento
            $pdf->Cell($widths[2], $height, $item['descuento'], 1, 0, 'C');
        
            // Columna 4: Cantidad
            $pdf->Cell($widths[3], $height, $item['cantidad'], 1, 0, 'C');
        
            // Columna 5: Valor
            $pdf->Cell($widths[4], $height, number_format($item['valor'], 2, ',', '.'), 1, 0, 'C');
        
            // Nueva línea
            $pdf->Ln();
        }
    
        // Totales
        $pdf->Ln(5);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(0, 10, "Subtotal: ".number_format($subtotal, 2, ',', '.'), 0, 1, 'R');
        $pdf->Cell(0, 10, "IVA 5%:" .number_format($iva5, 2, ',', '.'), 0, 1, 'R');
        $pdf->Cell(0, 10, "IVA 10%:".number_format($iva10, 2, ',', '.') , 0, 1, 'R');
        $pdf->Cell(0, 10, "IVA 19%: ".number_format($iva19, 2, ',', '.') , 0, 1, 'R');
        $pdf->Cell(0, 10, "Retencion ({$rete}%): " .number_format($retencion, 2, ',', '.'), 0, 1, 'R');
        $pdf->Cell(0, 10, "Total: ". number_format($valor, 2, ',', '.'), 0, 1, 'R');
    
        $pdf->Output('D', "OrdenCompra_$id_compra.pdf");
    
        // Redirección opcional si lo deseas después de la descarga
        echo "<script>
            alert('Orden de compra aprobada y PDF generado.');
            window.location.href = '" . APP_URL . "?views=comprasllegada/';
        </script>";

    }

}
