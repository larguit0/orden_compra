<?php
// Verificar si la sesión ya está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$id_provedor = isset($_GET['id']) ? $_GET['id'] : null;
// Aquí puedes continuar procesando el ID del proyecto y mostrar la información necesaria
echo "Provedor: " . $id_provedor;


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
        <div class="logo">
            <img src="<?php echo APP_URL; ?>app/views/img/logoAcema.png" alt="Logo ACEMA">
        </div>
        <div class="info">
            <p>ACEMA INGENIERIA SAS</p>
            <p>NIT: 901635197</p>
            <p>facturas@acemaingenieria.com</p>
        </div>

    </div>

    <form action="<?php echo APP_URL; ?>app/controller/actualizarProv.php" method="POST"  >
        <div class="form-container">
            <div class="form-column">
                <!-- Proyecto -->
                <div class="form-row">
                    <label for="proyecto" class="form-label">Nombre </label>
                    <?php
                        $sql = "SELECT id, nombre FROM proveedor where id = :id_provedor";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(':id_provedor', $id_provedor);
                        $stmt->execute();
                        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                        $valor_placeholder1 = $resultado ? $resultado['id'] : '';
                        $valor_placeholder = $resultado ? $resultado['nombre'] : '';
                    ?>
                    <input type="hidden" id="id_proyecto" name="id_provedor" value="<?php echo htmlspecialchars($valor_placeholder1); ?>">
                    <input type="hidden" id="id_proyecto" name="nombre_ph" value="<?php echo htmlspecialchars($valor_placeholder); ?>">

                    <input type="text" id="provedor" name="nombre" class="form-input" placeholder="<?php echo htmlspecialchars($valor_placeholder); ?>">
                </div>

                    <div class="form-row">
                        <label for="codigo_orden" class="form-label">Direccion </label>
                        <?php
                            $sql = "SELECT direccion FROM proveedor WHERE id = :id_provedor";
                            $stmt = $conn->prepare($sql);
                            $stmt->bindParam(':id_provedor', $id_provedor);
                            $stmt->execute();
                            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                            $direccion = $resultado ? $resultado['direccion'] : '';

                        ?>
                        <input type="hidden" id="id_proyecto" name="direccion_ph" value="<?php echo htmlspecialchars($direccion); ?>">

                        <input type="text"  name="direccion" class="form-input" placeholder="<?php echo htmlspecialchars($direccion ); ?>">
                    </div>
                    <div class="form-row">
                        <label for="codigo_orden" class="form-label">Ciudad </label>
                        <?php
                            $sql = "SELECT ciudad FROM proveedor WHERE id = :id_provedor";
                            $stmt = $conn->prepare($sql) ;
                            $stmt->bindParam(':id_provedor', $id_provedor);
                            $stmt->execute();
                            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                            $estado = $resultado ? $resultado['ciudad'] :'';
                        ?>
                        <input type="hidden" class="form-input" name="ciudad_ph" value="<?php echo htmlspecialchars($estado); ?>">

                        <input type="text" class="form-input" name="ciudad" placeholder="<?php echo htmlspecialchars($estado); ?>">
                    </div>
                    <div class="form-row">
                        <label for="codigo_orden" class="form-label">NIT </label>
                        <?php
                            $sql = "SELECT 	nit FROM proveedor WHERE id = :id_provedor";
                            $stmt = $conn->prepare($sql);
                            $stmt->bindParam(':id_provedor', $id_provedor);
                            $stmt->execute();
                            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                            $nit = $resultado ? $resultado['nit'] : '';
                        ?>
                        <input type="hidden" class="form-input" name="nit_ph" value="<?php echo htmlspecialchars($nit); ?>">

                        <input type="text" class="form-input" name="nit" placeholder="<?php echo htmlspecialchars($nit); ?>">
                    </div>
      

                <!-- BOTONES DE MANIPULACION -->
                <div class="form-row">                    
                    <!-- Botón Aprobar -->
                    <button type="submit" name="action" value="Actualizar" class="btn-approve">Actualizar</button>
                    
                    <!-- Botón Rechazar -->
                    <button type="submit" name="action" value="Atras" class="btn-reject">Atras</button>
                </div>
 
            </div>
        </div>

    </form>
</body>
<style>

    input {
        width: 25%;
        padding: 5px;
    }

    .table-container {
        width: 80%; /* Ancho ajustable */
        margin: 20px auto; /* Centra la tabla horizontalmente */
    }

    .form-row button {
        margin-right: 10px; /* Espacio horizontal */
    }
    .form-row button.btn-approve:hover{
        background-color: green ;

    }
    .container {
    display: flex;
    align-items: center; /* Centra verticalmente el contenido */
}

.container .logo {
    flex: 0 0 auto; /* El logo permanece en su posición a la izquierda */
}

.container .info {
    flex: 1; /* Ocupa el espacio restante */
    text-align: center; /* Centra horizontalmente el contenido del texto */
}






</style>
</html>
