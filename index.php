<?php
    require_once "./config/app.php";
    require_once "./autoload.php";

    /*---------- Iniciando sesión ----------*/
    require_once "./app/views/inc/session_start.php";

    if (isset($_GET['views'])) {
        $url = explode("/", $_GET['views']);
        $vista = $url[0]; // Obtenemos la vista que se debe cargar
    } else {
        $vista = "login"; // Vista por defecto si no hay nada en la URL
    }

    $id = isset($_GET['id']) ? $_GET['id'] : null;
    $cedula = isset($_GET['cedula']) ? $_GET['cedula'] : null;
    
    $rutasVistas = [
        "login" => "./app/views/content/login-view.php",
        "logOut" => "./app/views/content/login-view.php",
        "dashboard" => "./app/views/content/dashboard-view.php",
        "orden" => "./app/views/content/orden-view.php",
        "404" => "./app/views/content/404-view.php",
        "aprobaciones" => "./app/views/content/aprobaciones-view.php",
        "detalles" => "./app/views/content/detalles-view.php",
        "compras" =>"app/views/content/compra-llegada.php",
        "detalles_compra" => "app/views/content/detalles_compra-view.php",
        "estado" => "app/views/content/estadoOrden-view.php",
        "esColaboradorOC"=>"app/views/content/estadoOrdenColab.php",
        "historial"=>"app/views/content/historial-resgistro-view.php",
        "historialGerente"=>"app/views/content/historialGerente-view.php",
        "historialDire" => "app/views/content/historial-tecnDir.php",
        "inventario" => "app/views/content/Inventario-view.php",
        "busqueda" => "app/views/content/bucar-view.php",
        "inventario-select" => "app/views/content/inventario-select-view.php",
        "Remision1"=>"app/views/content/Remision-project-view.php",
        "Remision"=>"app/views/content/remision-view.php",
        "Remmision"=>"app/views/content/remisionItem-view.php",
        "detalles_ordenCompra"=>"app/views/content/detallesOC-view.php",
        "rechazar"=>"app/views/content/rechazaroc-view.php",
        "Rechazados"=>"app/views/content/listRechazados-view.php",
        "detallesRechazo"=>"app/views/content/detallesRechazado.php",
        "rechazar"=>"app/views/content/rechazaroc-view.php",
        "Inicio"=>"app/views/content/inicio-view.php",
        "comprasllegada"=>"app/views/content/comprasllegada-view.php",
        "provedor"=>"app/views/content/proveedores-view.php",
        "ActualizarProv"=>"app/views/content/actualizarProvedor-view.php"


        // Agrega aquí todas las vistas que quieras gestionar
    ];

    // Verificar si la vista existe en las rutas configuradas
    if (array_key_exists($vista, $rutasVistas)) {
        $vistaPath = $rutasVistas[$vista];
    } else {
        $vistaPath = $rutasVistas["404"]; // Si la vista no existe, mostrar el error 404
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <?php require_once "./app/views/inc/head.php"; ?>
    <?php if ($vista != "login" && $vista != "logOut") { require_once "./app/views/inc/nav-bar.php"; } ?>
</head>
<body>
    <?php
        
        use app\controller\loginController;

        $insLogin = new loginController();

        if($insLogin){
            require $vistaPath;
        }
        
        
    ?>
</body>
</html>
