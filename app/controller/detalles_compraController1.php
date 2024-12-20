<?php
require_once __DIR__ . '/../../config/app.php';

// Verificar si la sesión está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Incluir FPDF
require_once __DIR__ . '/../../fpdf/fpdf.php';

// Conexión a la base de datos
require_once __DIR__ . '/../../config/server.php'; // Ruta a la clase server.php
$conn = Database::connect();

// Variables de entrada
$action = $_POST['action'] ?? null;
$id_persona = $_POST['id_persona'] ?? null;
$consecutivo = $_POST['consecutivo'] ?? null;
$pryNombre = $_POST['proyecto'] ?? null;
$id_compra = $_POST['id_compra'] ?? null;
$id_ubicacion = $_POST['id_ubicacion'] ?? null;
$fecha = $_POST['fecha'] ?? null;
$iva5 = $_POST['iva5'] ?? null;
$iva10 = $_POST['iva10'] ?? null;
$iva19 = $_POST['iva19'] ?? null;
$valor = $_POST['valor'] ?? null;
$id_persona_recibe = $_POST['id_persona'] ?? null;
$fechaHoy = date('Y-m-d');
$rete = $_POST['rete'];
$retencion = $_POST['retencion'];
$centro_costos = $_POST['centro_costos'];
$subtotal = $_POST['subtotal'];
$observaciones = $_POST['observaciones'] ;
$forma_pago = $_POST['forma_pago'] ;
$cotizacion = $_POST['cotizacion'] ;
$lugarEntrega = $_POST['lugar_entrega'] ;
$polizaValor = $_POST['polizaStatus'] ?? 2;


// Validar datos duplicados
$sql = "SELECT id_compra, COUNT(*) FROM compra_llegada WHERE id_compra = :id_compra";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id_compra', $id_compra);
$stmt->execute();
$compraExists = $stmt->fetchColumn();
if ($compraExists != 0) {
    echo "<script>
        alert('insercción en inventario exitosa');
        window.location.href = '" . APP_URL . "?views=compras/';
    </script>";
    exit;
}

// Obtener datos del proveedor
$sql = "SELECT p.nombre, p.direccion, p.ciudad, p.nit FROM compra c 
        INNER JOIN proveedor p ON c.id_proveedor = p.id WHERE c.id = :id_compra";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id_compra', $id_compra);
$stmt->execute();
$resultado = $stmt->fetch(PDO::FETCH_ASSOC);
$nombre_prov = $resultado ? $resultado['nombre'] : null;
$direccion_prov = $resultado ? $resultado['direccion'] : null;
$ciudad_prov = $resultado ? $resultado['ciudad'] : null;
$nit_prov = $resultado ? $resultado['nit'] : null;

switch ($action) {
    case 'aprobar':
        $sql = "UPDATE compra SET id_estado_compra = 2 WHERE id = :id_compra";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_compra', $id_compra);

        if ($stmt->execute()) {
            // Insertar en compra_llegada
            $sql = "INSERT INTO compra_llegada(id_compra, id_persona_resive, id_persona, id_ubicacion, fecha_llegada)
                    VALUES (:id_compra, :id_persona_resive, :id_persona, :id_ubicacion, :fecha_llegada)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id_compra', $id_compra);
            $stmt->bindParam(':id_persona_resive', $id_persona_recibe);
            $stmt->bindParam(':id_persona', $id_persona);
            $stmt->bindParam(':id_ubicacion', $id_ubicacion);
            $stmt->bindParam(':fecha_llegada', $fechaHoy);

            if ($stmt->execute()) {
                $id_comprallegada = $conn->lastInsertId();
                $sql_items = "SELECT ci.id, ci.item, ci.descuento, ci.codigo_item, ci.cantidad, ci.valor, ci.valor_uni
                              FROM compra_item ci 
                              WHERE ci.id_compra = :id";
                $stmt_items = $conn->prepare($sql_items);
                $stmt_items->bindParam(':id', $id_compra);
                $stmt_items->execute();
                $items = $stmt_items->fetchAll(PDO::FETCH_ASSOC);

                if ($items) {
                    foreach($items as $item){
                        // Insertar en inventario
                        $sql_insert_inventario = "INSERT INTO inventario(id_compra_item, cantidad, ubicacion)
                                                  VALUES (:id_compra_item, :cantidad, :ubicacion)";
                        $stmt_insert_inventario = $conn->prepare($sql_insert_inventario);
                        $stmt_insert_inventario->bindParam(':id_compra_item', $item['id']);
                        $stmt_insert_inventario->bindParam(':cantidad', $item['cantidad']);
                        $stmt_insert_inventario->bindParam(':ubicacion', $id_ubicacion);
                        if ($stmt_insert_inventario->execute()) {
                            if($polizaValor == 1){
                                // Si la inserción es exitosa, generar el PDF
                                $pdf = new FPDF();
                                $pdf->AddPage();
                                $pdf->SetFont('Arial', 'B', 14);
                                
                                // Encabezado
                                $pdf->Image('https://erp-acema.com/images/Logo-acema-sin%20fondo.png', 10, 10, 50);
                                $pdf->SetX(70);
                                $pdf->Cell(100, 10, 'ACEMA INGENIERIA SAS', 0, 0, 'C');
                                $pdf->SetX(-50);
                                $pdf->Cell(40, 10, "N OC $consecutivo", 0, 1, 'R');
                                
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
                                $pdf->MultiCell(0, 10, utf8_decode( $lugarEntrega), 0, 'L');

                                $pdf->Cell(30, 10, "Cotizacion: ", 0, 0);
                                $pdf->MultiCell(0, 10, utf8_decode($cotizacion), 0, 'L');

                                // Observaciones con MultiCell
                                $pdf->Cell(30, 10, 'Observaciones:', 0, 0);
                                $pdf->MultiCell(0, 10, utf8_decode($observaciones), 0, 'L');
                                $pdf->Ln(5);
                                
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
                                    $widths = [40, 40, 30, 30, 40];
                                    $rowHeight = 10;
                                
                                    // Calcular altura de la fila según el texto más largo
                                    $nbLines = $pdf->NbLines($widths[1], utf8_decode($item['item']));
                                    $height = $rowHeight * $nbLines;
                                
                                    $x = $pdf->GetX();
                                    $y = $pdf->GetY();
                                
                                    // Columna 1: Referencia (con MultiCell)
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
                                $pdf->Cell(0, 10, "Subtotal: $subtotal", 0, 1, 'R');
                                $pdf->Cell(0, 10, "IVA 5%: $iva5", 0, 1, 'R');
                                $pdf->Cell(0, 10, "IVA 10%: $iva10", 0, 1, 'R');
                                $pdf->Cell(0, 10, "IVA 19%: $iva19", 0, 1, 'R');
                                $pdf->Cell(0, 10, "Retencion ({$rete}%): $retencion", 0, 1, 'R');
                                $pdf->Cell(0, 10, "Total: $valor", 0, 1, 'R');
                                                            
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
                                
                                // Generar el PDF
                                $pdf->Output('D', "OrdenCompra_$id_compra.pdf");
                                
                                // Redirección opcional si lo deseas después de la descarga
                                echo "<script>
                                    alert('Orden de compra aprobada y PDF generado.');
                                    window.location.href = '" . APP_URL . "?views=compras/';
                                </script>";

                            }else{
                            // Si la inserción es exitosa, generar el PDF
                            $pdf = new FPDF();
                            $pdf->AddPage();
                            $pdf->SetFont('Arial', 'B', 14);
                            
                            // Encabezado
                            $pdf->Image('https://erp-acema.com/images/Logo-acema-sin%20fondo.png', 10, 10, 50);
                            $pdf->SetX(70);
                            $pdf->Cell(100, 10, 'ACEMA INGENIERIA SAS', 0, 0, 'C');
                            $pdf->SetX(-50);
                            $pdf->Cell(40, 10, "N OC $consecutivo", 0, 1, 'R');
                            
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
                            $pdf->MultiCell(0, 10, utf8_decode( $lugarEntrega), 0, 'L');

                            $pdf->Cell(30, 10, "Cotizacion: ", 0, 0);
                            $pdf->MultiCell(0, 10, utf8_decode($cotizacion), 0, 'L');

                            // Observaciones con MultiCell
                            $pdf->Cell(30, 10, 'Observaciones:', 0, 0);
                            $pdf->MultiCell(0, 10, utf8_decode($observaciones), 0, 'L');
                            $pdf->Ln(5);
                            
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
                                $widths = [40, 40, 30, 30, 40];
                                $rowHeight = 10;
                            
                                // Calcular altura de la fila según el texto más largo
                                $nbLines = $pdf->NbLines($widths[1], utf8_decode($item['item']));
                                $height = $rowHeight * $nbLines;
                            
                                $x = $pdf->GetX();
                                $y = $pdf->GetY();
                            
                                // Columna 1: Referencia (con MultiCell)
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
                            $pdf->Cell(0, 10, "Subtotal: $subtotal", 0, 1, 'R');
                            $pdf->Cell(0, 10, "IVA 5%: $iva5", 0, 1, 'R');
                            $pdf->Cell(0, 10, "IVA 10%: $iva10", 0, 1, 'R');
                            $pdf->Cell(0, 10, "IVA 19%: $iva19", 0, 1, 'R');
                            $pdf->Cell(0, 10, "Retencion ({$rete}%): $retencion", 0, 1, 'R');
                            $pdf->Cell(0, 10, "Total: $valor", 0, 1, 'R');
                            
                            // Generar el PDF
                            $pdf->Output('D', "OrdenCompra_$id_compra.pdf");
                            
                            // Redirección opcional si lo deseas después de la descarga
                            echo "<script>
                                alert('Orden de compra aprobada y PDF generado.');
                                window.location.href = '" . APP_URL . "?views=compras/';
                            </script>";
                            }
                        }
                    }
                }
            }
        }
        break;
    
    case 'rechazar':
        echo "<script>
            window.location.href = '".APP_URL."?views=compra/';
        </script>";
        break;
}
