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
                    <h5>Bienvenido <?php echo $_SESSION['nombre']?> Proyecto Orden Compras</h5>
                </div>
                <div class="column">
                        <?php
                            $sqlmodelo = "SELECT COUNT(*) AS cantidad FROM aprobaciones WHERE id_aprobador = :id AND id_estado = 1";

                            // Preparar el statement
                            $stmt = $conn->prepare($sqlmodelo);

                            // Asignar el valor de id del usuario a la consulta
                            $stmt->bindParam(':id', $_SESSION['id'], PDO::PARAM_INT);

                            // Ejecutar la consulta
                            $stmt->execute();
                            $temp = $stmt->fetchColumn(); // Devuelve un entero

                            $cantidadApro = $temp ? $temp : ''; // Asigna el valor directamente

                            if ($cantidadApro > 0) {
                                ?>
                                <h5><strong>TIENES <?php echo $cantidadApro; ?> APROBACIONES PENDIENTES</strong></h5>
                                <?php
                            }
                        ?>
                </div>
            </div>
        </form>
    </div>
</div>
<style>
    <style>
    /* Estructura y estilo principal */
    .main-container {
        display: flex;
        justify-content: center;
        padding: 20px;
        background-color: #f4f4f4;
    }
    
    .main.content {
        width: 100%;
        max-width: 1200px;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    
    .box {
        width: 100%;
    }

    /* Columnas para tamaños grandes */
    .columns {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .column h5 {
        margin: 0;
    }

    /* Ajustes responsivos */
    @media (max-width: 768px) {
        .columns {
            flex-direction: column;
            align-items: flex-start;
            text-align: center;
        }

        .column h5 {
            font-size: 1em;
            margin-bottom: 10px;
        }
    }

    @media (max-width: 480px) {
        .main.content {
            padding: 15px;
        }

        .column h5 {
            font-size: 0.9em;
        }
    }
</style>

</style>
