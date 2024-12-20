<?php
// Verificar si la sesión ya está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Incluir la clase server.php para usar la conexión
require_once __DIR__ . '/../../../config/server.php'; // Ajusta la ruta según la estructura de tu proyecto

// Establecer la conexión
$conn = Database::connect();



$persona = $_SESSION['id'];
// Obtener el ID del proyecto desde la URL
$idRe = isset($_GET['idRe']) ? $_GET['idRe'] : null;
$idpro = isset($_GET['id']) ? $_GET['id'] : null;

// Inicializar variables para evitar errores de 'Undefined array key'
$empresa = isset($_POST['empresa']) ? $_POST['empresa'] : '';
$nit = isset($_POST['nit']) ? $_POST['nit'] : '';
$direccion = isset($_POST['direccion']) ? $_POST['direccion'] : '';
$contacto = isset($_POST['contacto']) ? $_POST['contacto'] : '';
$correo = isset($_POST['correo']) ? $_POST['correo'] : '';
$telefono = isset($_POST['telefono']) ? $_POST['telefono'] : '';
?>

<div class="remision-form-container">
    <h2>Crear Remisión</h2>
    <form action="<?php echo APP_URL;?>app/controller/RemisionController.php" method="POST">
        <div class="form-container">
            <div class="form-column">
                <div class="form-row">
                    <label for="empresa" class="form-label">Empresa</label>
                    <?php
                        $sql = "SELECT empresa FROM remision WHERE id = :id";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(':id', $idRe);
                        $stmt->execute();
                        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                        $valor_input = $resultado ? $resultado['empresa'] : ''; // Verifica si se encontró un resultado


                    ?>
                    <input type="hidden"  name="id_remision" value="<?php echo $idRe; ?>"/>
                    <input type="hidden"  name="persona" value="<?php echo $persona; ?>"/>

                    <input type="text" id="empresa" name="empresa" value="<?php echo htmlspecialchars($valor_input); ?>"/>
                </div>

                <div class="form-row">
                    <label for="nit" class="form-label">NIT</label>
                    <?php
                        $sql = "SELECT nit FROM remision WHERE id = :id";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(':id', $idRe);
                        $stmt->execute();
                        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                        $valor_input = $resultado ? $resultado['nit'] : ''; // Verifica si se encontró un resultado


                    ?>
                    <input type="text" id="nit" name="nit" value="<?php echo htmlspecialchars($valor_input); ?>"/>
                </div>

                <div class="form-row">
                    <label for="direccion" class="form-label">Dirección</label>
                    <?php
                        $sql = "SELECT direccion FROM remision WHERE id = :id";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(':id', $idRe);
                        $stmt->execute();
                        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                        $valor_input = $resultado ? $resultado['direccion'] : ''; // Verifica si se encontró un resultado


                    ?>
                    <input type="text" id="direccion" name="direccion" value="<?php echo htmlspecialchars($valor_input); ?>"/>
                </div>
                <div class="form-row">
                    <label for="direccion" class="form-label">Ciudad</label>
                    <?php
                        $sql = "SELECT ciudad FROM remision WHERE id = :id";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(':id', $idRe);
                        $stmt->execute();
                        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                        $valor_input = $resultado ? $resultado['ciudad'] : ''; // Verifica si se encontró un resultado


                    ?>
                    <input type="text" id="direccion" name="ciudad" value="<?php echo htmlspecialchars($valor_input); ?>"/>
                </div>
            </div>

            <div class="form-column">
                <div class="form-row">
                    <label for="contacto" class="form-label">Contacto</label>
                    <?php
                        $sql = "SELECT contacto FROM remision WHERE id = :id";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(':id', $idRe);
                        $stmt->execute();
                        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                        $valor_input = $resultado ? $resultado['contacto'] : ''; // Verifica si se encontró un resultado


                    ?>
                    <input type="text" id="contacto" name="contacto" value="<?php echo htmlspecialchars($valor_input); ?>"/>
                </div>

                <div class="form-row">
                    <label for="correo" class="form-label">Correo</label>
                    <?php
                        $sql = "SELECT correo FROM remision WHERE id = :id";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(':id', $idRe);
                        $stmt->execute();
                        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                        $valor_input = $resultado ? $resultado['correo'] : ''; // Verifica si se encontró un resultado


                    ?>
                    <input type="text" id="correo" name="correo" value="<?php echo htmlspecialchars($valor_input); ?>"/>
                </div>

                <div class="form-row">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <?php
                        $sql = "SELECT telefono FROM remision WHERE id = :id";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(':id', $idRe);
                        $stmt->execute();
                        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                        $valor_input = $resultado ? $resultado['telefono'] : ''; // Verifica si se encontró un resultado


                    ?>
                    <input type="text" id="telefono" name="telefono" value="<?php echo htmlspecialchars($valor_input); ?>"/>
                </div>

                <div class="form-row">
                    <label for="" class="form-label">Proyecto</label>
                    <?php
                        $sql = "SELECT nombre FROM proyecto WHERE id = :id";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(':id', $idpro);
                        $stmt->execute();
                        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                        $valor_input = $resultado ? $resultado['nombre'] : '';
                    ?>
                    <input type="text" id="proyecto" name="proyecto" value="<?php echo htmlspecialchars($valor_input); ?>"/>
                </div>
            </div>
        </div>

        <!-- Botón de Crear Remisión -->
        <button type="submit" class="button is-primary">Crear Remisión</button>
    </form>
    <a href="?views=Remision1">
    <button type="submit" class="button is-info is-rounded">Regresar</button>'
    </a>

    <form action="<?php echo APP_URL; ?>app/controller/CancelarRemision.php" method="POST">
        <input type="hidden" name="id_remi" value="<?php echo $idpro; ?>">
        <input type="hidden" name="id_remision" value="<?php echo $idRe; ?>">
        <button type="submit" class="button is-info is-rounded">Cancelar Remisión</button>
    </form>
</div>


<div class="inventory-container">
    <h2>Inventario</h2>

    <!-- Buscador -->
    <input type="text" id="search" placeholder="Buscar por código o nombre" onkeyup="searchItems()">

    <!-- Tabla de Inventario con Paginación -->
    <div id="inventory-table">
        <table>
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Item</th>
                    <th>Cantidad</th>
                    <th>Ubicación</th>
                    <th>Cantidad a enviar</th>
                    <th>Seleccionar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Paginación
                $limit = 15; // Número de objetos por página
                $page = isset($_GET['page']) ? $_GET['page'] : 1;
                $start = ($page - 1) * $limit;

                // Consulta con búsqueda y filtro por proyecto
                $search = isset($_GET['search']) ? $_GET['search'] : '';
                $sql = "SELECT i.id, ci.codigo_item, ci.item, i.cantidad, u.ubicacion 
                        FROM inventario i 
                        INNER JOIN compra_item ci ON i.id_compra_item = ci.id 
                        INNER JOIN compra c ON c.id = ci.id_compra 
                        INNER JOIN ubicacion u ON u.id = i.ubicacion 
                        WHERE (ci.codigo_item LIKE :search OR ci.item LIKE :search OR u.ubicacion LIKE :search) 
                        AND c.proyecto = :idpro AND i.cantidad >0
                        LIMIT :start, :limit";
                $stmt = $conn->prepare($sql);
                $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
                $stmt->bindValue(':idpro', $idpro, PDO::PARAM_INT);
                $stmt->bindValue(':start', $start, PDO::PARAM_INT);
                $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
                $stmt->execute();

                // Generar las filas de la tabla
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo '<tr>';
                    echo '<td>' . $row['codigo_item'] . '</td>';
                    echo '<td>' . $row['item'] . '</td>';
                    echo '<td>' . $row['cantidad'] . '</td>';
                    echo '<td>' . $row['ubicacion'] . '</td>';
                    echo '<form action="'. APP_URL.'app/controller/guardar_item_temp.php" method="POST">';
                    echo '<td><input type="number" name="cantidad" min="1" max="' . $row['cantidad'] . '" required></td>';
                    echo '<td>';
                    echo '<input type="hidden" name="item_id" value="' . $row['id'] . '">';
                    echo '<input type="hidden" name="id_remision" value="' . $idpro . '">';
                    echo '<input type="hidden" name="id_remi" value="' . $idRe . '">';
                    // Usar las variables inicializadas en lugar de $_POST
                    echo '<button type="submit" class="button is-info is-rounded">Seleccionar</button>';
                    echo '</td>';
                    echo '</form>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>

        <!-- Paginación -->
        <div class="pagination-container">
        <?php
        // Obtener el total de objetos para la paginación
        $sql = "SELECT COUNT(*) 
                FROM inventario i
                INNER JOIN compra_item ci ON i.id_compra_item = ci.id 
                INNER JOIN compra c ON c.id = ci.id 
                WHERE (ci.codigo_item LIKE :search OR ci.item LIKE :search OR i.ubicacion LIKE :search) 
                AND c.proyecto = :idpro";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
        $stmt->bindValue(':idpro', $idpro, PDO::PARAM_INT);
        $stmt->execute();
        $total_items = $stmt->fetchColumn();
        $total_pages = ceil($total_items / $limit);

        // Mostrar los enlaces de paginación
        for ($i = 1; $i <= $total_pages; $i++) {
            echo '<a href="?views=Remmision&page=' . $i . '&search=' . $search . '&id=' . $idpro . '&idRe='.$idRe.'">' . $i . '</a> ';
        }   
        ?>
        </div>
    </div>
</div>

<script>
function searchItems() {
    
    var searchValue = document.getElementById('search').value;
    var projectId = "<?php echo $idpro; ?>";  // Asegúrate de que estas líneas estén presentes
    var remisionId = "<?php echo $idRe; ?>";  // Asegúrate de que estas líneas estén presentes

    if (searchValue) {
        // Redirigir con el valor de búsqueda
        window.location.href = "?views=Remmision&search=" + encodeURIComponent(searchValue) + "&page=1&id=" + projectId + "&idRe=" + remisionId;
    } else {
        // Redirigir sin el valor de búsqueda (opcional)
        window.location.href = "?views=Remmision&page=1&id=" + projectId + "&idRe=" + remisionId;
    }
}
</script>
<style>
.remision-form-container {
    max-width: 800px; /* Ancho máximo del formulario */
    margin: 0 auto; /* Centra el contenedor horizontalmente */
    background-color: #f9f9f9; /* Fondo claro para el formulario */
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Sombra suave */
    text-align: center; /* Centra el texto de los títulos */
}

/* Título del formulario */
.remision-form-container h2 {
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 20px;
}

/* Estilos generales para los contenedores del formulario */
.form-container {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 20px;
}

/* Columnas del formulario */
.form-column {
    width: 48%; /* Hace que cada columna ocupe el 48% del ancho del contenedor */
}

/* Estilos para las filas del formulario */
.form-row {
    margin-bottom: 15px;
}

/* Etiquetas del formulario */
.form-label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
    text-align: left; /* Alinea las etiquetas a la izquierda */
}

/* Inputs del formulario */
input[type="text"],
input[type="number"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

/* Botones */
.button {
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

.button.is-primary {
    background-color: #007bff;
    color: white;
}

.button.is-info {
    background-color: #17a2b8;
    color: white;
}

.button.is-rounded {
    border-radius: 50px;
}

/* Contenedor del inventario */
.inventory-container {
    max-width: 900px;
    margin: 20px auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.inventory-container h2 {
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 20px;
    text-align: center;
}

/* Buscador */
#search {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-bottom: 20px;
    box-sizing: border-box;
}

/* Tabla de inventario */
table {
    width: 100%;
    border-collapse: collapse;
}

table th, table td {
    padding: 10px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

table th {
    background-color: #f8f8f8;
    font-weight: bold;
}

/* Paginación */
.pagination-container {
    margin-top: 20px;
    text-align: center;
}

.pagination-container a {
    margin: 0 5px;
    text-decoration: none;
    color: #007bff;
    font-weight: bold;
}

.pagination-container a:hover {
    text-decoration: underline;
}

@media (max-width: 768px) {
    .form-container {
        flex-direction: column; /* Cambiar a columnas en pantallas pequeñas */
    }

    .form-column {
        min-width: 100%; /* Ancho completo para columnas pequeñas */
    }

    table {
        font-size: 14px; /* Tamaño de fuente más pequeño para pantallas pequeñas */
    }

    th, td {
        padding: 8px; /* Ajustar padding en celdas */
    }
}

</style>