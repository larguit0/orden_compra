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

<div class="main-content">
    <section class="buscar-container">
        <!-- Buscador -->
        <div class="buscar-bar">
            <input class="input" type="text" name="busqueda" id="buscar" placeholder="BUSQUE EQUIPO DE INTERES">
            <button onclick="search()" class="button is-info is-rounded">Buscar</button>
        </div>

</div>
<div class="space"></div>
<section class="action-container">
    <div class="columns">
        <div class="column">
            <a href="?views=inventario-select">
                    <button type="submit" class="button is-info is-rounded ">regresar</button>
            </a>
        </div>
    </div>
</section>


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
<style>
   body {
    font-family: 'Arial', sans-serif;
    background-color: #f5f5f5; 
    margin: 0;
    padding: 0;
}

.main-content {
    padding: 20px;
    background-color: white;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    max-width: 800px;
    margin: 20px auto;
}

/* Buscador */
.buscar-container {
    display: flex;
    justify-content: center;
    margin-bottom: 20px;
}

.buscar-bar {
    display: flex;
    align-items: center;
    width: 100%;
    max-width: 600px;
}

.input.is-rounded {
    width: 100%;
    padding: 10px;
    border: 2px solid #ccc;
    border-radius: 30px;
    margin-right: 10px;
    font-size: 1rem;
    box-shadow: none;
}

.button.is-info.is-rounded {
    background-color: #209cee;
    border-color: transparent;
    color: white;
    border-radius: 30px;
    padding: 10px 20px;
    transition: background-color 0.3s ease;
}

.button.is-info.is-rounded:hover {
    background-color: #3273dc;
}

/* Espaciado */
.space {
    padding: 10px 0;
}

/* Botón de regresar */
.action-container .button {
    font-weight: bold;
    font-size: 1rem;
    width: 100%;
    max-width: 200px;
}

/* Columnas */
.columns {
    display: flex;
    justify-content: flex-start;
}

.column {
    flex: 1;
    display: flex;
    justify-content: center;
}

/* Responsive */
@media (max-width: 768px) {
    .buscar-bar {
        flex-direction: column;
    }

    .input.is-rounded {
        margin-bottom: 10px;
    }

    .columns {
        flex-direction: column;
        align-items: center;
    }

    .column {
        width: 100%;
        max-width: 200px;
    }
}
</style>