<?php
// Incluir la clase server.php para usar la conexión
require_once __DIR__ . '/../../../config/server.php'; // Ajusta la ruta según la estructura de tu proyecto

// Establecer la conexión
$conn = Database::connect();

// Capturar la búsqueda y el proyecto desde la URL
$busqueda = isset($_GET['search']) ? $_GET['search'] : '';

?>

<div class="main content">
    <section class="buscar-container">
        <div class="buscar-bar">
            <input class="input" type="text" name="busqueda" id="buscar" placeholder="BUSQUE EQUIPO DE INTERES" value="<?php echo htmlspecialchars($busqueda); ?>">
            <button onclick="search()" class="button is-info is-rounded">Buscar</button>
        </div>
    </section>

    <section class="result-container">
        <div id="results" class="container">
            <table class="table is-striped">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Item</th>
                        <th>Cantidad</th>
                        <th>Ubicación</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Consulta para obtener los resultados de la búsqueda
                    $sql = "SELECT ci.codigo_item, ci.item, i.cantidad, u.ubicacion 
                            FROM inventario i 
                            INNER JOIN compra_item ci ON i.id_compra_item = ci.id 
                            INNER JOIN compra c ON c.id = ci.id_compra 
                            INNER JOIN ubicacion u ON u.id = i.ubicacion 
                            WHERE (ci.codigo_item LIKE :busqueda OR ci.item LIKE :busqueda OR u.ubicacion LIKE :busqueda) 
                            ";

                    $stmt = $conn->prepare($sql);
                    $searchParam = "%".$busqueda."%"; 
                    $stmt->bindParam(':busqueda', $searchParam, PDO::PARAM_STR);
                    
                    
                    if ($stmt->execute()) {
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo '<tr>';
                            echo '<td>' . htmlspecialchars($row['codigo_item']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['item']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['cantidad']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['ubicacion']) . '</td>';
                            echo '</tr>';
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>

    <section class="action-container">
        <div class="columns">
            <div class="column">
                <a href="?views=inventario-select">
                    <button type="submit" class="button is-info is-rounded">Regresar</button>
                </a>
            </div>
        </div>
    </section>
</div>

<script>
function search() {
    var searchValue = document.getElementById('buscar').value;
    if (searchValue) {
        window.location.href = "?views=busqueda&search=" + encodeURIComponent(searchValue);
    }
}
document.getElementById('buscar').addEventListener('keydown', function(event) {
    if (event.key === 'Enter') {  
        search(); 
    }
});
</script>
