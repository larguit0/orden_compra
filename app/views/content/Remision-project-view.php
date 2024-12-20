<?php
// Verificar si la sesión ya está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Incluir la clase server.php para usar la conexión
require_once __DIR__ . '/../../../config/server.php'; // Ajusta la ruta según la estructura de tu proyecto

// Establecer la conexión
$conn = Database::connect();



?>

<div class="main-container">
    <div class="main content">
        <form class="box" id="registroForm" method="POST" action="<?php echo APP_URL; ?>app/controller/remision_selectController.php" autocomplete="off" enctype="multipart/form-data">
            <div class="columns">
                <div class="column">
                    <h5>Hola <?php echo $_SESSION['nombre']?></h5>
                </div>
                <div class="column">
                    <h5>Seleccione proyecto para hacer la remison:</h5>
                    <div class="select">
                        <select class="select-marca" id="id_proyecto" name="id_proyecto" required>
                            <option>Seleccione proyecto</option>
                            <?php
                            
                                $sqlmodelo = "SELECT p.id, p.nombre 
                                FROM proyecto p 
                                ";
                  
                                // Preparar el statement
                                $stmt = $conn->prepare($sqlmodelo);

                                // Ejecutar la consulta
                                $stmt->execute();

                                // Obtener los resultados
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    echo '<option value="' . $row['id'] . '">' . $row['nombre'] . '</option>';
                                }
                            
                            // Preparar la consulta

                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="columns">
                <div class="column">
                    <button type="submit" class="button is-info is-rounded">Remision</button>
                </div>
            </div>
        </form>
    </div>
</div>
<style>
    /* General Styles */
.main-container {
    padding: 20px;
    display: flex;
    justify-content: center;
}

.main.content {
    width: 100%;
    max-width: 800px;
    background: #fff;
    padding: 20px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
}

/* Form and Columns */
.box {
    display: flex;
    flex-direction: column;
}

.columns {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    margin-bottom: 20px;
}

.column {
    flex: 1;
    min-width: 200px;
}

/* Button */
.button {
    width: 100%;
    padding: 10px;
    font-size: 1rem;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .columns {
        flex-direction: column;
        gap: 10px;
    }

    .column {
        width: 100%;
    }
}

@media (max-width: 480px) {
    .main-container {
        padding: 10px;
    }

    .main.content {
        padding: 15px;
    }

    h5 {
        font-size: 1.1rem;
    }

    .button {
        font-size: 0.9rem;
        padding: 8px;
    }
}
</style>
