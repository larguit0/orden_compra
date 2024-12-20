<?php
// Verificar si la sesión ya está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


$id = isset($_GET['id']) ? $_GET['id'] : null;
$_SESSION['id_proyecto'] = $id;

// Incluir la clase server.php para usar la conexión
require_once __DIR__ . '/../../../config/server.php'; // Ajusta la ruta según la estructura de tu proyecto

// Establecer la conexión
$conn = Database::connect();


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
    <div class="logo"><img src="https://erp-acema.com/images/Logo-acema-sin%20fondo.png" alt="Logo ACEMA"></div>
    <div class="info">
      <p>ACEMA INGENIERIA SAS</p>
      <p>NIT: 901635197</p>
      <p>facturas@acemaingenieria.com</p>
    </div>
    <div class="codigo">
    <?php
            $sql = "SELECT consecutivo FROM orden_compra  ORDER BY id DESC LIMIT 1";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $ultimaOrden = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($ultimaOrden) {
                $partes =  $ultimaOrden['consecutivo'];
                $nuevoConsecutivo = $partes + 1; // Incrementar en 1
            } else {
                $nuevoConsecutivo = 1;
            }
            
            // Generar el nuevo código de la orden de compra
            $nuevoConsecutivo = $nuevoConsecutivo;
          ?>
      <p><strong>N°</strong> OC<?php echo $nuevoConsecutivo;?></p>
    </div>
  </div>

  <form action="<?php echo APP_URL; ?>app/controller/ordenCompra.php" method="POST">
    <div class="form-container">
      <div class="form-column">
        <div class="form-row">
          <label for="proveedor" class="form-label">proyecto</label>
          <?php
                    $sql = "SELECT id,nombre  FROM  proyecto WHERE id = :id";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(':id', $_SESSION['id_proyecto']);
                    $stmt->execute();
                    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                    $valor_placeholder = $resultado ? $resultado['nombre'] : '';
                    $valor_placeholder1 = $resultado ? $resultado['id'] : '';

                     // Verifica si se encontró un resultado
          ?>
          
          <input type="hidden" id="id_proyecto" name="consecutivo" value="<?php echo $nuevoConsecutivo; ?>">
          <input type="hidden" id="id_proyecto" name="id_proyecto" value="<?php echo htmlspecialchars($valor_placeholder1); ?>">
          <input type="hidden" id="id_rol" name="id_rol" value="<?php echo htmlspecialchars($_SESSION['id_rol']); ?>" >

          <input readonly type="text" id="proyecto" name="proyecto" value = "<?php echo htmlspecialchars($valor_placeholder); ?>"class="form-input" placeholder="<?php echo htmlspecialchars($valor_placeholder); ?>" >
        </div>
        <div class="form-row">

          <label for="identificacion" class="form-label">Codigo Orden</label>
          <?php
          //seleccion del ultimo dato de la orden de compra para poder generar el codigo de la orden de compra
            $sql = "SELECT codigo_orden FROM orden_compra WHERE id_proyecto = :id_proyecto ORDER BY id DESC LIMIT 1";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id_proyecto', $_SESSION['id_proyecto']);
            $stmt->execute();
            $ultimaOrden = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // Generar nuevo código de orden
            if ($ultimaOrden) {
                // Extraer el número de orden del último código
                $partes = explode("-", $ultimaOrden['codigo_orden']);
                $numeroOrden = intval(end($partes)); // Obtener la parte del número de orden
                $nuevoNumeroOrden = $numeroOrden + 1; // Incrementar en 1
            } else {
                // Si no existe orden previa, este será el primer registro
                $nuevoNumeroOrden = 1;
            }
            
            // Generar el nuevo código de la orden de compra
            $nuevoCodigoOrden = $_SESSION['id_proyecto'] . '-' . $nuevoNumeroOrden;
          ?>

          <input type="text" id="codigo_orden" name="codigo_orden" value = "<?php echo htmlspecialchars($nuevoCodigoOrden); ?>" class="form-input">
        </div>
        <div class="form-row">
          <label for="telefono" class="form-label">Responsable Orden Compra</label>
          <?php
                    $sql = "SELECT id,nombre, apellido FROM  usuario WHERE id = :id";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(':id', $_SESSION['id']);
                    $stmt->execute();
                    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                    $valor_placeholder = $resultado ? $resultado['nombre'] : '';
                    $valor_placeholderJ = $resultado ? $resultado['apellido'] : '';
                    $valor_placeholder1 = $resultado ? $resultado['id'] : '';

                     // Verifica si se encontró un resultado
          ?>
          <input type="hidden" id="person" name="compra_per" value="<?php echo htmlspecialchars($valor_placeholder1); ?>">
          <input type="text" id="telefono" name="personax" value = "<?php echo htmlspecialchars($valor_placeholder." ".$valor_placeholderJ); ?>"class="form-input">
        </div>

        <div class="form-row">
          <label for="telefono" class="form-label">Responsable tecnico</label>
          <div class="select">
                <select required class="select-marca" id="id_proyecto" name="persona" >
                    <option value="">Seleccione persona</option>
                    <?php
                    // Preparar la consulta
                    $sqlmodelo = "SELECT u.id, u.nombre, u.apellido FROM asignaciones a INNER JOIN usuario u
                    ON a.id_usuario = u.id INNER JOIN  proyecto_asignado pa ON a.id_proyecto_asignados = pa.id WHERE pa.id_proyecto = :id_pro";
                    $stmt = $conn->prepare($sqlmodelo);
                    $stmt->bindParam(':id_pro', $id);
                    $stmt->execute();
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo '<option value="' . $row['id'] . '">' . $row['nombre'].' '.$row['apellido'] . '</option>';
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="form-row">
          <label for="telefono" class="form-label">Proveedor</label>
          <div class="select">
                <select required class="form-select" id="id_proyecto" name="id_proveedor" >
                    <option  value="">Seleccione provedoor</option>
                    <?php
                    // Preparar la consulta
                    $sqlprov = "SELECT id, nombre FROM proveedor";
                    $stmt = $conn->prepare($sqlprov);
                    $stmt->execute();
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo '<option value="' . $row['id'] . '">' . $row['nombre']. '</option>';
                    }
                    ?>
                </select>
            </div>
        </div>
        
        <div class="form-row">
        
        <label for="directo" class="form-label">Director proyecto</label>
        <?php
                  $sql = "SELECT u.id,u.nombre,u.apellido  FROM  proyecto_asignado p INNER JOIN usuario u ON  u.id = p.id_lider  WHERE p.id_proyecto = :id_proyecto";
                  $stmt = $conn->prepare($sql);
                 
                  $stmt->bindParam(':id_proyecto', $_SESSION['id_proyecto']);
                  $stmt->execute();
                  $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                  $valor_placeholder = $resultado ? $resultado['nombre'] : '';
                  $valor_placeholder1 = $resultado ? $resultado['apellido'] : '';
                  $valor_placeholder2 = $resultado ? $resultado['id'] : '';
                   // Verifica si se encontró un resultado
        ?>
        <input type="hidden" id="id_tecnico" name="id_tecnico" value="<?php echo htmlspecialchars($valor_placeholder2 ); ?>">
        <input type="text" id="tecnico" name="tecnico" value = "<?php echo htmlspecialchars($valor_placeholder."". $valor_placeholder1 ); ?>"class="form-input">
     
        
      </div>
      <div class="form-row">
          <label  for="centro_costos" class="form-label">Centro de costos</label>
          <input class="form-input" type="text" name="centro_costos">

      </div>
      <div class="form-row">
          <label  for="centro_costos" class="form-label">Forma de Pago</label>
          <input class="form-input" type="text" name="forma_pago">

      </div>
      <div class="form-row">
          <label  for="centro_costos" class="form-label">Lugar Entrega</label>
          <input class="form-input" type="text" name="lugar_entrega">

      </div>
      <div class="form-row">
          <label  for="centro_costos" class="form-label">Cotizaciones</label>
          <input class="form-input" type="text" name="cotizaciones">

      </div>
      <div class="form-row">
        <label for="directo" class="form-label">Observaciones</label>
        <input  type="text" name="observacion" class="form-input">


      </div>
      <div class="form-row">
        <label for="directo" class="form-label">Porcentaje retención</label>
        <input  type="number" name="retencion" class="retention" value="0" step="0.1" id="retencion">
        <label for="directo" class="form-label">%</label>


      </div>

       
     </div>
      

      </div>
    </div>

    <div class="moneda">
      <label for="currencySelect" class="form-label">Tipo de moneda</label>
      <br>
      <select id="currencySelect" class="currency-select">
        <option value="USD">Dólar</option>
        <option value="EUR">Euro</option>
        <option value="COP" selected>Peso Colombiano</option>
      </select>
    </div>

    <div class="table-container">
      <table id="itemsTable">
        <thead>
          <tr class="table-header">
            <th></th>
            <th>Codigo</th>
            <th>Item</th>
            <th>Cantidad</th>
            <th>Precio C/u</th>
            <th>Desc %</th>
            <th>Impuesto</th>

          
            
            <th>Total</th>
          </tr>
        </thead>
        <tbody>
          <tr class="table-row">
            <td>
              <button type="button" class="remove-button">&times;</button>
            </td>
            <td>
            <?php
          //seleccion del ultimo dato de la orden de compra para poder generar el codigo de la orden de compra
          $sql = "SELECT p.codigo_item FROM item_compra p INNER JOIN orden_compra o ON p.id_orden = o.id WHERE o.codigo_orden = :codigo_orden ORDER BY p.id DESC LIMIT 1";
          $stmt = $conn->prepare($sql);
          $stmt->bindParam(':codigo_orden', $nuevoCodigoOrden);
          $stmt->execute();
          $ultimaOrden = $stmt->fetch(PDO::FETCH_ASSOC);
          
          // Generar nuevo código de ítem
          if ($ultimaOrden) {
              // Extraer el número de ítem del último código de ítem
              $partes = explode("-", $ultimaOrden['codigo_item']);
              $numeroItem = intval(end($partes)); // Obtener la última parte que representa el número de ítem
              $nuevoNumeroItem = $numeroItem + 1; // Incrementar en 1
          } else {
              // Si no hay ítems previos, este será el primer ítem
              $nuevoNumeroItem = 1;
          }
          
          // Generar el nuevo código de ítem con el formato correcto (por ejemplo: 170-1-2)
          $nuevoCodigoItem = $nuevoCodigoOrden . '-' . $nuevoNumeroItem;
          ?>
              <input type="text" name="codigo_item[]" value="<?php echo htmlspecialchars($nuevoCodigoItem); ?>" class="form-input" readonly>
            </td>
            <td>
              <input type="text" name="item[]" placeholder="Descripción">
            </td>
            <td>
              <input type="number" name="cantidad[]" class="quantity" value="1" step="1">
            </td>
            <td>
              <input type="number" name="precio[]" class="price" value="0" step="1">
            </td>
            <td>
              <input type="number" name="desc[]" class="discount" value="0" step="1.0">
            </td>
            <td>
              <select name="impuesto" class="tax">
                <option value="0">Ninguno</option>
                <option value="0.05">IVA 5%</option>
                <option value="0.10">IVA 10%</option>
                <option value="0.19">IVA 19%</option>
              </select>
            </td>
 
            
          
            
          <td>
            <input type="text" name="totalItem[]" class="total-input1" id="total-input1"value="0.0" readonly>
          </td>
          </tr>
        </tbody>
      </table>
      <div class="button-container">
        <button type="button" id="addRowButton">Agregar Items</button>
      </div>
      <div class="form-row">
        <div class="form-label">Subtotal</div>
        <div class="total-cell" id="subtotal">$0.0</div>
        <input type="hidden" id="subtotalVal" name="subtotaal" value="0">

      </div>

      <div class="form-row">
          <div class="form-label">Total IVA 5%</div>
          <div class="total-cell" id="totalIva5">$0.0</div>
          <input type="hidden" id="totIva5" name="totIva5" value="0">
      </div>
      <div class="form-row">
          <div class="form-label">Total IVA 10%</div>
          <div class="total-cell" id="totalIva10" name = "totalIva10">$0.0</div>
          <input type="hidden" id="totIva10" name="totIva10" value="0">
      </div>
      <div class="form-row">
          <div class="form-label">Total IVA 19%</div>
          <div class="total-cell" id="totalIva19" >$0.0</div>
          <input type="hidden" id="totIva19" name="totIva19" value="0">

      </div>
      <div class="form-row">
          <div class="form-label">Total</div>
          <div class="total-cell" id="grandTotal">$0.0</div>
          <input type="hidden" id="totalInput" name="totalOrden" value="0">
      </div>
      <div class="form-row" id= "subsidioRow" style = "display: none ">
        <div class="form-label">Poliza</div>
        <input type="checkbox" id="subsidioCheckbox" name= "poliza" >
      </div>
    </div>


    <div class="form-submit-container">
      <button type="submit">Guardar</button>
      <button type="button" id="generateInvoiceButton" hidden >Imprimir</button>
    </div>
  </form>

  <!-- Plantilla de la factura -->
  <div id="invoice" class="invoice-container">
    <div class="invoice-content">
      <button class="close-invoice" onclick="closeInvoice()">Cerrar</button>
      <div class="invoice-header">
        <img src="<?php echo APP_URL; ?>app/views/img/logoAcema.png" alt="Logo ACEMA">
        <div>
          <h1>Factura</h1>
          <p><strong>N°:</strong> <span id="invoiceNumero">OC101</span></p>
        </div>
      </div>

      <div class="invoice-details">
        <h2>Detalles del Proveedor:</h2>
        <p>
          <strong>Proveedor:</strong> <span id="invoiceProveedor">-</span><br>
          <strong>Identificación:</strong> <span id="invoiceIdentificacion">-</span><br>
          <strong>Teléfono:</strong> <span id="invoiceTelefono">-</span><br>
          <strong>Fecha:</strong> <span id="invoiceFecha">-</span><br>
          <strong>Fecha de Entrega:</strong> <span id="invoiceFechaEntrega">-</span><br>
        </p>
      </div>

      <table class="invoice-table">
        <thead>
          <tr>
            <th>Descripción</th>
            <th>Cantidad</th>
            <th>Precio Unitario</th>
            <th>Descuento</th>
            <th>IVA</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody id="invoiceItems">
          <!-- Items se llenarán dinámicamente -->
        </tbody>
      </table>

      <div class="invoice-totals">
        <p><strong>Subtotal:</strong> <span id="invoiceSubtotal">$0.0</span></p>
        <p><strong>Total IVA:</strong> <span id="invoiceTotalIVA">$0.0</span></p>
        <p><strong>Total:</strong> <span id="invoiceGrandTotal">$0.0</span></p>
      </div>

      <div class="invoice-footer">
        <p>Gracias por su compra!</p>
        <p>ACEMA INGENIERIA SAS | www.acemaingenieria.com | Cra 81A #48 b 60, Calasanz, Medellín,</p>
      </div>
    </div>
  </div>

  <script>
    let itemCounter = 2;
    const currencyFormats = {
      'USD': { symbol: '$', decimals: 2 },
      'EUR': { symbol: '€', decimals: 2 },
      'COP': { symbol: 'COP$', decimals: 0 }
    };

    function formatCurrency(value, currency) {
      const format = currencyFormats[currency];
      if (format) {
        // Ajustar el formato dependiendo de si se necesitan decimales
        if (format.decimals > 0) {
          return `${format.symbol}${parseFloat(value).toFixed(format.decimals).replace(/\B(?=(\d{3})+(?!\d))/g, ',')}`;
        } else {
          return `${format.symbol}${parseFloat(value).toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ',')}`;
        }
      }
      return value;
    }
    function calculateRowTotal(row, includeTax = true) {
  const price = parseFloat(row.querySelector('.price').value) || 0;
  const quantity = parseFloat(row.querySelector('.quantity').value) || 0;
  const discount = parseFloat(row.querySelector('.discount').value) || 0;
  const taxRate = parseFloat(row.querySelector('.tax').value) || 0;

  let subtotal = price * quantity;
  subtotal -= subtotal * (discount / 100);
  let total = subtotal;

  if (includeTax) {
    total += subtotal * taxRate;
  }
  
  console.log('Row calculation:', { price, quantity, discount, taxRate, subtotal, total });

  const totalInput = row.querySelector('.total-input1');
  if (totalInput) {
    totalInput.value = total.toFixed(2);
    console.log('Total input updated:', totalInput.value);
  } else {
    console.error('Total input field not found');
  }

  return { subtotal: subtotal, total: total, tax: subtotal * taxRate };
}

    

function updateTotals() {
  const rows = document.querySelectorAll('#itemsTable tbody .table-row');
  let subtotal = 0;
  let totalIVA = 0;
  let grandTotal = 0;

  rows.forEach(row => {
    const totals = calculateRowTotal(row, true); // Incluir impuestos en el total
    subtotal += totals.subtotal;
    totalIVA += totals.tax;
    grandTotal += totals.total;
  });

  const currency = document.getElementById('currencySelect').value;
  document.getElementById('subtotal').textContent = formatCurrency(subtotal, currency);
  document.getElementById('grandTotal').textContent = formatCurrency(grandTotal, currency);

  // Actualización del input de valor del total de la orden de compra
  document.getElementById('totalInput').value = grandTotal;
  document.getElementById('subtotalVal').value = subtotal;

  // Lógica para habilitar/deshabilitar el checkbox de subsidio
  const subsidioCheckbox = document.getElementById('subsidioCheckbox');
  if (grandTotal >= 10000000) {
    subsidioRow.style.display = "flex";
  } else {
    subsidioRow.style.display = "none";

  }
}



    document.getElementById('addRowButton').addEventListener('click', function() {
      const newRow = document.createElement('tr');
      newRow.className = 'table-row';
      newRow.innerHTML = `
        <td>
              <button type="button" class="remove-button">&times;</button>
            </td>
            <td>
            
            <?php
          //seleccion del ultimo dato de la orden de compra para poder generar el codigo de la orden de compra
          
          
          // Generar nuevo código de ítem
          $newNumeroItem = $nuevoNumeroItem+ 1; // Incrementar en 1
          
              // Si no hay ítems previos, este será el primer ítem
              
          
          // Generar el nuevo código de ítem con el formato correcto (por ejemplo: 170-1-2)
          $nuevoCodigoItem = $nuevoCodigoOrden . '-' . $newNumeroItem;
          ?>
              <input type="text" name="codigo_item[]" value="<?php echo $nuevoCodigoOrden ."-"?>${itemCounter}" class="form-input" readonly>
            </td>
            <td>
              <input type="text" name="item[]" placeholder="Descripción">
            </td>
            <td>
              <input type="number" name="cantidad[]" class="quantity" value="1" step="1">
            </td>
            <td>
              <input type="number" name="precio[]" class="price" value="0" step="1">
            </td>
            <td>
              <input type="number" name="desc[]" class="discount" value="0" step="1.0">
            </td>
            <td>
              <select name="impuesto" class="tax">
                <option value="0">Ninguno</option>
                <option value="0.05">IVA 5%</option>
                <option value="0.10">IVA 10%</option>
                <option value="0.19">IVA 19%</option>
              </select>
            </td>

            
          
            
          <td>
            <input type="text" name="totalItem[]" class="total-input1" id="total-input1" value="0.0" readonly>
          </td>
      `;
      document.querySelector('#itemsTable tbody').appendChild(newRow);
      itemCounter++;
      newRow.querySelector('.remove-button').addEventListener('click', function() {
        this.parentElement.parentElement.remove();
        itemCounter--;
        updateTotals();
      });
      newRow.querySelectorAll('input, select').forEach(input => {
        input.addEventListener('input', updateTotals);
      });
      updateTotals();
      

    });

    document.querySelectorAll('input, select').forEach(input => {
      input.addEventListener('input', updateTotals);
    });

    updateTotals();

    // Funciones para generar e imprimir la factura
    document.getElementById('generateInvoiceButton').addEventListener('click', function() {
      generateInvoice();
      openInvoice();
    });

    function generateInvoice() {
      // Obtener datos del formulario
      const proveedor = document.getElementById('proveedor').value || '-';
      const identificacion = document.getElementById('identificacion').value || '-';
      const telefono = document.getElementById('telefono').value || '-';
      const fecha = document.getElementById('fecha').value || '-';
      const fechaEntrega = document.getElementById('fecha_entrega').value || '-';
      const numeroOC = document.querySelector('.codigo p strong + text') || 'OC101'; // Ajustar si es dinámico

      // Llenar detalles del proveedor
      document.getElementById('invoiceProveedor').textContent = proveedor;
      document.getElementById('invoiceIdentificacion').textContent = identificacion;
      document.getElementById('invoiceTelefono').textContent = telefono;
      document.getElementById('invoiceFecha').textContent = fecha;
      document.getElementById('invoiceFechaEntrega').textContent = fechaEntrega;
      document.getElementById('invoiceNumero').textContent = document.querySelector('.codigo p').textContent.split('N°')[1].trim();

      // Llenar items de la factura
      const rows = document.querySelectorAll('#itemsTable tbody .table-row');
      const invoiceItems = document.getElementById('invoiceItems');
      const currency = document.getElementById('currencySelect').value;
      invoiceItems.innerHTML = '';

      let subtotal = 0;
      let totalIVA = 0;
      let grandTotal = 0;

      rows.forEach(row => {
        const concepto = row.querySelector('select[name="concepto"]').value;
        const cantidad = parseFloat(row.querySelector('input[name="cantidad"]').value) || 0;
        const precio = parseFloat(row.querySelector('input[name="precio"]').value) || 0;
        const descuento = parseFloat(row.querySelector('input[name="desc"]').value) || 0;
        const impuesto = parseFloat(row.querySelector('select[name="impuesto"]').value) || 0;

        let lineSubtotal = precio * cantidad;
        lineSubtotal -= lineSubtotal * (descuento / 100);
        let lineIVA = lineSubtotal * impuesto;
        let lineTotal = lineSubtotal + lineIVA;

        subtotal += lineSubtotal;
        totalIVA += lineIVA;
        grandTotal += lineTotal;

        const rowHTML = `
          <tr>
            <td>${concepto}</td>
            <td>${cantidad}</td>
            <td>${formatCurrency(precio, currency)}</td>
            <td>${descuento}%</td>
            <td>${(impuesto * 100).toFixed(0)}%</td>
            <td>${formatCurrency(lineTotal, currency)}</td>
          </tr>
        `;
        invoiceItems.innerHTML += rowHTML;
      });

      // Llenar totales
      document.getElementById('invoiceSubtotal').textContent = formatCurrency(subtotal, currency);
      document.getElementById('invoiceTotalIVA').textContent = formatCurrency(totalIVA, currency);
      document.getElementById('invoiceGrandTotal').textContent = formatCurrency(grandTotal, currency);
    }

    function openInvoice() {
      const invoice = document.getElementById('invoice');
      invoice.style.display = 'block';
      setTimeout(() => {
        window.print();
      }, 500);
    }

    function closeInvoice() {
      const invoice = document.getElementById('invoice');
      invoice.style.display = 'none';
    }
  

    function calculateTotals() {
    let subtotal = 0;
    let totalIva5 = 0;
    let totalIva10 = 0;
    let totalIva19 = 0;

    // Recorrer las filas de la tabla para calcular los valores.
    const rows = document.querySelectorAll('#itemsTable tbody tr');
    rows.forEach(row => {
      const quantity = parseFloat(row.querySelector('.quantity').value) || 0;
      const price = parseFloat(row.querySelector('.price').value) || 0;
      const discount = parseFloat(row.querySelector('.discount').value) || 0;
      const tax = parseFloat(row.querySelector('.tax').value) || 0;

      // Calcular el precio con el descuento aplicado.
      const priceAfterDiscount = price - (price * (discount / 100));
      const totalItem = quantity * priceAfterDiscount;

      // Acumular el subtotal general.
      subtotal += totalItem;

      // Calcular el IVA para el ítem específico y acumularlo en su tipo correspondiente.
      const iva = totalItem * tax;
      if (tax === 0.05) {
        totalIva5 += iva;
      } else if (tax === 0.10) {
        totalIva10 += iva;
      } else if (tax === 0.19) {
        totalIva19 += iva;
      }
    });

    // Actualizar los elementos con los totales calculados.
    document.getElementById('subtotal').textContent = `$${subtotal.toFixed(2)}`;
    document.getElementById('totalIva5').textContent = `$${totalIva5.toFixed(2)}`;
    document.getElementById('totalIva10').textContent = `$${totalIva10.toFixed(2)}`;
    document.getElementById('totalIva19').textContent = `$${totalIva19.toFixed(2)}`;
    //set values to hidden inputs :p
    document.getElementById('totIva5').value = totalIva5;
    document.getElementById('totIva10').value = totalIva10;
    document.getElementById('totIva19').value = totalIva19; 
    document.getElementById('subtotalVal').value = subtotal;

    



    // Calcular el total general sumando el subtotal y todos los IVAs.
    const grandTotal = subtotal + totalIva5 + totalIva10 + totalIva19;
    document.getElementById('grandTotal').textContent = `$${grandTotal.toFixed(2)}`;
    document.getElementById('totalInput').value = grandTotal.toFixed(2);
  }

  // Asignar el evento de cálculo cuando los valores de los ítems cambien.
  document.getElementById('itemsTable').addEventListener('input', calculateTotals);

  // Llamar a la función al cargar la página para calcular los totales iniciales.
  window.onload = calculateTotals;
  </script>
</body>
<style>
    /* Estilos para la factura */
    .invoice-container {
      display: none; /* Oculto por defecto */
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgba(0,0,0,0.5);
      padding: 20px;
      box-sizing: border-box;
      z-index: 1000;
    }

    .invoice-content {
      background-color: #fff;
      margin: auto;
      padding: 20px;
      border-radius: 5px;
      max-width: 800px;
      box-shadow: 0 0 10px rgba(0,0,0,0.25);
      font-family: 'Arial', sans-serif;
      color: #333;
    }

    .invoice-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-bottom: 2px solid #333;
      padding-bottom: 10px;
      margin-bottom: 20px;
    }

    .invoice-header img {
      max-width: 150px;
    }

    .invoice-details {
      margin-bottom: 20px;
    }

    .invoice-details p {
      margin: 5px 0;
    }

    .invoice-table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }

    .invoice-table th, .invoice-table td {
      border: 1px solid #333;
      padding: 8px;
      text-align: left;
    }

    .invoice-table th {
      background-color: #f2f2f2;
    }

    .invoice-totals {
      text-align: right;
      margin-bottom: 20px;
    }

    .invoice-footer {
      text-align: center;
      font-size: 12px;
      color: #777;
    }


    /* Botón para cerrar la factura */
    .close-invoice {
      position: absolute;
      top: 10px;
      right: 20px;
      background: #ff5c5c;
      color: #fff;
      border: none;
      padding: 5px 10px;
      cursor: pointer;
      border-radius: 3px;
    }

/* Flex and responsive styles */
@media (min-width: 768px) {
  .header {
    flex-direction: row;
    justify-content: space-between;
    text-align: left;
  }

  .form-container {
    grid-template-columns: 1fr 1fr;
  }
}

@media (min-width: 1024px) {
  .form-container {
    grid-template-columns: repeat(3, 1fr);
  }
}

/* Responsive input fields */




.form-input, .select-marca, .currency-select, .quantity, .price, .discount, .tax, .total-input1 {
  width: 100%;
  padding: 8px;
  margin-bottom: 5px;
  font-size: 1em;
}

.table-container {
  overflow-x: auto;
}

#itemsTable {
  width: 100%;
  border-collapse: collapse;
}

#itemsTable th, #itemsTable td {
  padding: 10px;
  text-align: left;
  border-bottom: 1px solid #ddd;
}
  </style>
</html>