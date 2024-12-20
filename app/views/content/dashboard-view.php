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
        <form class="box" id="registroForm" method="POST" action="<?php echo APP_URL; ?>app/controller/ordenController.php" autocomplete="off" enctype="multipart/form-data">
            <div class="columns">
                <div class="column">
                    <h5>Bienvenido <?php echo $_SESSION['nombre']?></h5>
                </div>
                <div class="column">
                    <h5>Seleccione proyecto para hacer la orden de compra:</h5>
                    <div class="select">
                        <select class="select-marca" id="id_proyecto" name="id_proyecto" required>
                            <option>Seleccione proyecto</option>
                            <?php
                            if ($_SESSION['id_rol']==7){
                                $sqlmodelo = "SELECT p.id, p.nombre 
                                FROM proyecto p 
                                INNER JOIN proyecto_asignado pa ON p.id = pa.id_proyecto 
                                INNER JOIN asignaciones a ON pa.id = a.id_proyecto_asignados 
                                WHERE a.id_usuario = :id";
                  
                                // Preparar el statement
                                $stmt = $conn->prepare($sqlmodelo);

                                // Asignar el valor de id del usuario a la consulta
                                $stmt->bindParam(':id', $_SESSION['id'], PDO::PARAM_INT);

                                // Ejecutar la consulta
                                $stmt->execute();

                                // Obtener los resultados
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    echo '<option value="' . $row['id'] . '">' . $row['nombre'] . '</option>';
                                }
                            }else if ($_SESSION['id_rol']==2 || $_SESSION['id_rol']==3){
                                $sqlmodelo = "SELECT p.id, p.nombre 
                                FROM proyecto p 
                                INNER JOIN proyecto_asignado pa ON p.id = pa.id_proyecto 
                                WHERE pa.id_lider = :id";
                  
                                // Preparar el statement
                                $stmt = $conn->prepare($sqlmodelo);

                                // Asignar el valor de id del usuario a la consulta
                                $stmt->bindParam(':id', $_SESSION['id'], PDO::PARAM_INT);

                                // Ejecutar la consulta
                                $stmt->execute();

                                // Obtener los resultados
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    echo '<option value="' . $row['id'] . '">' . $row['nombre'] . '</option>';
                                }
                            }else{
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
                            }
                            // Preparar la consulta

                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="columns">
                <div class="column">
                    <button type="submit" class="button is-info is-rounded">Orden Compra</button>
                </div>
            </div>
        </form>
    </div>
</div>
<style>
    .main-container {
        background-color: #f5f5f5;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px;
        min-height: 100vh;
    }

    .main.content {
        width: 100%;
        max-width: 700px;
        background-color: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    .box {
        border-radius: 10px;
        padding: 20px;
        background-color: white;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    .columns {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .column {
        flex: 1;
        min-width: 200px;
    }

    .select {
        width: 100%;
    }

    .button.is-info.is-rounded {
        width: 100%;
    }

    /* Media Queries */
    @media (max-width: 768px) {
        .main.content {
            max-width: 90%;
            padding: 15px;
        }

        .column {
            min-width: 100%;
        }
    }

    @media (max-width: 480px) {
        .main.content {
            max-width: 95%;
            padding: 10px;
        }

        .box h5 {
            font-size: 1rem;
        }

        .button {
            font-size: 0.9rem;
            padding: 10px;
        }
    }
</style>
