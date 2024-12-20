<?php
// Verificar si la sesión ya está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Conexión a la base de datos
require_once __DIR__ . '/../../../config/server.php'; // Ajusta la ruta si es necesario

try {
    $conn = Database::connect();
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
    die();
}

// Obtener el rol del usuario de la sesión
$rol = isset($_SESSION['id_rol']) ? $_SESSION['id_rol'] : null;
?>
<nav class="navbar">
    <div class="navbar-brand">
        <a class="navbar-item" >
            <img src="https://erp-acema.com/images/Logo-acema-sin%20fondo.png" alt="acema" width="112" height="30">
        </a>
        <div class="navbar-burger" data-target="navbarExampleTransparentExample">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>

    <div id="navbarExampleTransparentExample" class="navbar-menu">
        <div class="navbar-start">
            <!-- Menú Orden de Compra -->
            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link" >
                    Orden Compra
                </a>
                <div class="navbar-dropdown is-boxed">
                    
                
                <!-- Aprobaciones: solo para roles 1, 2, 3, 4 -->
                    <?php if (in_array($rol, [5])) { ?>
                        <a class="navbar-item" href="<?php echo APP_URL; ?>?views=dashboard/">
                            Orden Compra
                        </a>
                    <?php } ?>

                    <!-- Aprobaciones: solo para roles 1, 2, 3, 4 -->
                    <?php if (in_array($rol, [1, 2, 3, 4,7])) { ?>
                        <a class="navbar-item" href="<?php echo APP_URL; ?>?views=aprobaciones/">
                            Aprobaciones
                        </a>
                    <?php } ?>

                    <!-- Registro Ordenes Compra según el rol -->
                    <?php if (in_array($rol, [1, 4,5])) { ?>
                        <a class="navbar-item" href="<?php echo APP_URL; ?>?views=historial/">
                            Registro Ordenes Compra
                        </a>
                    <?php } elseif (in_array($rol, [2, 3])) { ?>
                        <a class="navbar-item" href="<?php echo APP_URL; ?>?views=historialDire/">
                            Registro Ordenes Compra
                        </a>
                    <?php } elseif (in_array($rol, [7])){ ?>
                        <a class="navbar-item" href="<?php echo APP_URL; ?>?views=esColaboradorOC/">
                            Registro Ordenes Compra
                        </a>
                    <?php } if (in_array($rol, [7, 2,5])){?>
                        <a class="navbar-item" href="<?php echo APP_URL; ?>?views=Rechazados/">
                            Ordenes Rechazadas
                        </a>
                    <?php } ?>
                    
                    
                    
                </div>
            </div>

            <!-- Menú Compra: solo para roles 1, 5, 6 -->
            <?php if (in_array($rol, [5])) { ?>
                <div class="navbar-item has-dropdown is-hoverable">
                    <a class="navbar-link" href="#">
                        Compra
                    </a>
                    <div class="navbar-dropdown is-boxed">
                        <a class="navbar-item" href="<?php echo APP_URL; ?>?views=compras/">
                            Aprobaciones
                        </a>
                        <a class="navbar-item" href="<?php echo APP_URL; ?>?views=comprasllegada/">
                            Compra llegada
                        </a>
                    </div>

                </div>
            <?php } ?>

            <!-- Menú Inventario y Remisiones: no para roles 7 y 8 -->
            <?php if (!in_array($rol, [1,7,8,3,4])) { ?>
                <div class="navbar-item has-dropdown is-hoverable">
                    <a class="navbar-link" href="#">
                        Inventario
                    </a>
                    <div class="navbar-dropdown is-boxed">
                        <a class="navbar-item" href="<?php echo APP_URL; ?>?views=inventario-select/">
                            Inventario
                        </a>
                    </div>
                </div>

                <div class="navbar-item has-dropdown is-hoverable">
                    <a class="navbar-link" href="#">
                        Remisión
                    </a>
                    <div class="navbar-dropdown is-boxed">
                        <a class="navbar-item" href="<?php echo APP_URL; ?>?views=Remision1/">
                            Remisión
                        </a>
                    </div>
                </div>
            <?php } ?>
        </div>

        <div class="navbar-end">
            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link">
                    <?php echo $_SESSION['nombre'] . " " . $_SESSION['apellido']; ?>
                </a>

                <div class="navbar-dropdown is-boxed">
                    <hr class="navbar-divider">
                    <a class="navbar-item" href="<?php echo APP_URL; ?>?views=logOut/">
                        Salir
                    </a>
                    <?php if (in_array($rol, [1])) { ?>
                    <hr class="navbar-divider">
                    <a class="navbar-item" href="<?php echo APP_URL; ?>?views=inventario/">
                        Inventario pc
                    </a>
                <?php } ?>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Estilos y script permanecen igual -->
<style>
.navbar {
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2); 
    padding: 0.5rem 1rem;
    background-color: #fff; /* Asegura que el fondo sea blanco */
}

.navbar-item, .navbar-link {
    font-weight: bold;
    color: #333; /* Color de fuente más oscuro */
    font-family: 'Arial', sans-serif; /* Asegúrate de usar una fuente clara */
    transition: color 0.3s ease;
}

.navbar-item:hover, .navbar-link:hover {
    color: #000; /* Cambia el color al pasar el mouse a un tono negro */
}

.navbar-burger {
    display: none;
    cursor: pointer;
}

.navbar-burger span {
    background-color: #333; /* Color de los íconos del menú tipo hamburguesa */
    display: block;
    height: 2px;
    width: 18px;
    margin: 3px 0;
}

.navbar-menu {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

@media screen and (max-width: 768px) {
    .navbar-burger {
        display: block;
    }

    .navbar-menu {
        display: none;
        flex-direction: column;
        background-color: #6d8ecb; 
        padding: 1rem;
    }

    .navbar-menu.is-active {
        display: flex;
    }

    .navbar-dropdown {
        background-color: transparent;
        box-shadow: none;
        transform: none;
        opacity: 1;
        position: static;
    }
}

.navbar-item img {
    max-width: 100%;
    height: auto;
}

</style>

<script>
/* Script para toggle del menú */
document.addEventListener('DOMContentLoaded', () => {
    const burger = document.querySelector('.navbar-burger');
    const menu = document.querySelector('.navbar-menu');

    burger.addEventListener('click', () => {
        burger.classList.toggle('is-active');
        menu.classList.toggle('is-active');
    });
});
</script>
