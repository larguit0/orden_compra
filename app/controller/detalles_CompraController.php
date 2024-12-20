<?php
require_once __DIR__ . '/../../config/app.php';// Verificar si la sesión está iniciada

// Verificar si la sesión está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
use Dompdf\Dompdf;
require_once('C:/xampp/htdocs/orden_compra/vendor/autoload.php');

// Conexión a la base de datos
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


//validamos que no hayan datos duplicados
$sql = "SELECT id_compra, COUNT(*) FROM compra_llegada WHERE id_compra = :id_compra";
$stmt =  $conn->prepare($sql);
$stmt->bindParam(':id_compra', $id_compra);
$stmt -> execute();
$compraExists = $stmt->fetchColumn();
if($compraExists != 0){
    echo "<script>
        alert('inserccion en inventario exitosa');
        window.location.href = '".APP_URL."?views=compras/';
    </script>";
    exit;

}



//seleccion datos del proveedor para la muestra del pdf
$sql = "SELECT p.nombre,p.direccion,p.ciudad,p.nit FROM compra c 
        INNER JOIN proveedor p ON c.id_proveedor = P.id WHERE c.id = :id_compra";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id_compra', $id_compra);
$stmt -> execute();
$resultado = $stmt -> fetch(PDO::FETCH_ASSOC);
$nombre_prov = $resultado?$resultado['nombre']:null;
$direccion_prov = $resultado?$resultado['direccion']:null;
$ciudad_prov = $resultado?$resultado['ciudad']:null;
$nit_prov = $resultado?$resultado['nit']:null;



switch ($action) {
    case 'aprobar':
        $sql = "UPDATE compra SET id_estado_compra = 2 WHERE id = :id_compra";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_compra', $id_compra);

        if ($stmt->execute()) {
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
                $sql_items = "SELECT  ci.id,ci.item,ci.descuento ,ci.codigo_item, ci.cantidad, ci.valor 
                              FROM compra_item ci 
                              WHERE ci.id_compra = :id";
                $stmt_items = $conn->prepare($sql_items);
                $stmt_items->bindParam(':id', $id_compra);
                $stmt_items->execute();
                $items = $stmt_items->fetchAll(PDO::FETCH_ASSOC);

                if ($items) {
                    foreach($items as $item){
                        $sql_insert_inventario = "INSERT INTO inventario(id_compra_item,cantidad,ubicacion)
                                                    VALUES (:id_compra_item,:cantidad,:ubicacion)";
                        $stmt_insert_inventario = $conn->prepare($sql_insert_inventario);
                        $stmt_insert_inventario->bindParam(':id_compra_item', $item['id']);
                        $stmt_insert_inventario->bindParam(':cantidad', $item['cantidad']);
                        $stmt_insert_inventario->bindParam(':ubicacion', $id_ubicacion);
                        if( $stmt_insert_inventario->execute()){
                            $html = '
                            <html lang="es">
                            <head>
                                <meta charset="UTF-8">
                                <meta name="viewport" content="width=device-width, initial-scale=1">
                                <style>
                                    body {
                                        font-family: sans-serif;
                                        margin: 0;
                                        padding: 0;
                                        background-color: #f4f4f4;
                                    }
                                    .header {
                                        display: flex;
                                        justify-content: space-between;
                                        align-items: center;
                                        padding: 20px;
                                        background-color: #ffffff;
                                        border-bottom: 1px solid #ccc;
                                    }
                                    .logo {
                                        flex: 1;
                                    }
                                    .logo img {
                                        width: 170px;
                                        height: 60px;
                                    }
                                    .info {
                                        flex: 2;
                                        text-align: center;
                                        margin: 0;
                                    }
                                    .info p {
                                        margin: 2px 0;
                                    }
                                    .codigo {
                                        flex: 1;
                                        text-align: right;
                                    }
                                    .info_proveedor {
                                        margin-top: 10px;
                                        padding: 10px;
                                        border-top: 1px solid #ccc;
                                    }
                                    .info_proveedor div {
                                        margin-bottom: 5px;
                                    }
                                    table {
                                        width: 100%;
                                        border-collapse: collapse;
                                        margin-top: 20px;
                                        background-color: #ffffff;
                                        border: 1px solid #ccc;
                                        border-radius: 8px;
                                        padding: 10px;
                                    }
                                    th, td {
                                        border: 1px solid #ccc;
                                        padding: 8px;
                                        text-align: center;
                                    }
                                    th {
                                        background-color: #cbe7fa82;
                                    }
                                    .totals {
                                        text-align: right;
                                        margin-top: 20px;
                                    }
                                    .totals p {
                                        margin: 5px 0;
                                    }
                                    .description {
                                        padding: 10px;
                                        background-color: #ffffff;
                                    }
                                </style>
                            </head>
                            <body>
                                <div class="header">
                                    <div class="logo">
                                        <img src="'.APP_URL.'/app/views/img/logoAcema.png" alt="Logo ACEMA">
                                    </div>
                                    <div class="info">
                                        <p>ACEMA INGENIERÍA SAS</p>
                                        <p>NIT: 901635197</p>
                                        <p>+57 3103604259</p>
                                        <p>facturas@acemaingenieria.com</p>
                                    </div>
                                    <div class="codigo">
                                        <p><strong>OC N° ' . $consecutivo . '</strong></p>
                                        <p>Fecha: ' . $fechaHoy . '</p>
                                    </div>
                                </div>
                                
                                <div class="info_proveedor">
                                    <div><strong>Proyecto:</strong> ' . $pryNombre . '</div>
                                    <div><strong>Señor(es):</strong> ' . $nombre_prov . '</div>
                                    <div><strong>Ciudad:</strong> ' . $ciudad_prov . '</div>
                                    <div><strong>Dirección:</strong> ' . $direccion_prov . '</div>
                                    <div><strong>NIT:</strong> ' . $nit_prov . '</div>
                                </div>
                            
                                
                                
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Referencia</th>
                                            <th>Código</th>
                                            <th>Descuento</th>
                                            <th>Cantidad</th>
                                            <th>Valor</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                    
                                    foreach ($items as $item) {
                                        $html .= '
                                        <tr>
                                            <td>' . htmlspecialchars($item['item']) . '</td>
                                            <td>' . htmlspecialchars($item['codigo_item']) . '</td>
                                            <td>' . htmlspecialchars($item['descuento']) . '</td>
                                            <td>' . htmlspecialchars($item['cantidad']) . '</td>
                                            <td>' . number_format($item['valor'], 2, ',', '.') . '</td>
                                        </tr>';
                                    }
                            
                            $html .= '
                                    </tbody>
                                </table>
                            
                                <div class="totals">
                                    <p><strong>IVA 5%:</strong> ' .$iva5 . '</p>
                                    <p><strong>IVA 10%:</strong> ' . $iva10 . '</p>
                                    <p><strong>IVA 19%:</strong> ' . $iva19 . '</p>
                                    <p><strong>Retencion ('.$rete.'%):</strong> ' . $retencion . '</p>
                                    <p><strong>Total:</strong> ' . $valor . '</p>
                                </div>
                            
                                <div class="description">
                                    <p><strong>Descripción:</strong></p>
                                    <p>_</p>
                                </div>
                            </body>
                            </html>';
        
                            // Crear y generar el PDF
                            $dompdf = new Dompdf();
                            $dompdf->loadHtml($html);
                            $dompdf->render();
                            $dompdf->stream("OrdenCompra_" . $id_compra . ".pdf", array('Attachment' => 1));
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
