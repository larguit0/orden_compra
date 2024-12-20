<?php
// Verificar si la sesión ya está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Incluir la clase server.php para usar la conexión
require_once __DIR__ . '/../../../config/server.php'; // Ajusta la ruta según la estructura de tu proyecto

// Establecer la conexión
$conn = Database::connect();


// Obtener el ID del proyecto desde la URL
$idpro = isset($_GET['id']) ? $_GET['id'] : null;

// Inicializar variables para evitar errores de 'Undefined array key'
$empresa = isset($_POST['empresa']) ? $_POST['empresa'] : '';
$nit = isset($_POST['nit']) ? $_POST['nit'] : '';
$direccion = isset($_POST['direccion']) ? $_POST['direccion'] : '';
$contacto = isset($_POST['contacto']) ? $_POST['contacto'] : '';
$correo = isset($_POST['correo']) ? $_POST['correo'] : '';
$telefono = isset($_POST['telefono']) ? $_POST['telefono'] : '';
$ciudad = isset($_POST['ciudad']) ? $_POST['ciudad'] : '';

?>

<div class="remision-form-container">
    <h2>Crear Remisión</h2>
    <form action="<?php echo APP_URL;?>app/controller/crearRemisionController.php" method="POST">
        <div class="form-container">
            <div class="form-column">
                <div class="form-row">
                    <label for="empresa" class="form-label">Empresa</label>
                    <input type="text" id="empresa" name="empresa" value="<?php echo htmlspecialchars($empresa); ?>"/>
                </div>

                <div class="form-row">
                    <label for="nit" class="form-label">NIT</label>
                    <input type="text" id="nit" name="nit" value="<?php echo htmlspecialchars($nit); ?>"/>
                </div>

                <div class="form-row">
                    <label for="direccion" class="form-label">Dirección</label>
                    <input type="text" id="direccion" name="direccion" value="<?php echo htmlspecialchars($direccion); ?>"/>
                </div>
                <div class="form-row">
                    <label for="direccion" class="form-label">Ciudad</label>
                    <input type="text" id="direccion" name="ciudad" value="<?php echo htmlspecialchars($direccion); ?>"/>
                </div>
            </div>

            <div class="form-column">
                <div class="form-row">
                    <label for="contacto" class="form-label">Contacto</label>
                    <input type="text" id="contacto" name="contacto" value="<?php echo htmlspecialchars($contacto); ?>"/>
                </div>

                <div class="form-row">
                    <label for="correo" class="form-label">Correo</label>
                    <input type="text" id="correo" name="correo" value="<?php echo htmlspecialchars($correo); ?>"/>
                </div>

                <div class="form-row">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <input type="text" id="telefono" name="telefono" value="<?php echo htmlspecialchars($telefono); ?>"/>
        
                    <input type="hidden" name="id_remision" value="<?php echo $idpro; ?>">
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
    <button type="submit" class="mb-2 button is-info is-rounded ">Regresar</button>'
    </a>


</div>




<style>
.remision-form-container {
    max-width: 800px;
    margin: 20px auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 10px;
    background-color: #f9f9f9;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

h2 {
    text-align: center;
    color: #333;
}

.form-container {
    display: flex;
    justify-content: space-between;
}

.form-column {
    flex: 1;
    margin-right: 20px;
}

.form-column:last-child {
    margin-right: 0;
}

.form-row {
    margin-bottom: 15px;
}

.form-label {
    font-weight: bold;
}

input[type="text"],
input[type="number"] {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.button {
    display: inline-block;
    margin-top: 10px;
}

.inventory-container {
    margin-top: 30px;
}

#search {
    width: 100%;
    padding: 8px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
}

th, td {
    padding: 10px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

th {
    background-color: #f2f2f2;
}
.button {
    padding: 10px 20px;
    border-radius: 4px;
    border: none;
    cursor: pointer;
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

</style>