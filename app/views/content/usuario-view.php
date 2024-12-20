<?php
// Incluir la clase server.php para usar la conexión
require_once __DIR__ . '/../../../config/server.php'; // Ajusta la ruta según la estructura de tu proyecto

// Establecer la conexión
$conn = Database::connect();
?>
<div class="main content">
    
            <form class = "box "id="registroForm" method="POST" action="<?php echo APP_URL; ?>app/controller/usuarioController.php" method="POST" autocomplete="off" enctype="multipart/form-data">
                <h1 class="title">Usuario</h1>
                <h2 class="subtitle">Registro Usuario</h2>
                <input type="hidden" name="modulo_usuario" value="registrar">
                    <div class="columns">
                        <div class="column">
                            <h5>Nombre </h5>
                            <input class="input" placeholder="Nombre de la Persona" type="text" name="nombre" >
                        </div>
                        <div class="column">
                            <h5>Apellido </h5>
                            <input class="input" placeholder="Apellido de la Persona" type="text" name="apellido" >
                        </div>
                    </div>
                    <div class="columns">
                        <div class="column">
                            <h5>Cargo </h5>
                            <input class="input" placeholder="Cargo de la Persona" type="text" name="cargo" >
                        </div>
                        
                        <div class="column">
                        <h5>Seleccione Imagen</h5>
                            <div class="file is-small">
                                <label class="file-label">
                                    <input class="file-input" type="file" name="foto" accept=".jpg, .png, .jpeg">
                                        <span class="file-cta">
                                            <span class="file-label">Seleccionar una imagen</span>
                                        </span>
                                 </label>
                            </div>
                        </div>
                        
                    </div>
                    <div class="columns">
                        <div class="column">
                            <button type="submit" class="button is-info is-rounded">Insertar</button>
                            <a href="?views=usuario-Borrar" class="button is-info is-rounded ml-2">Gestion</a>

                        </div>

                    </div>
            </form>
            
        
    
</div>
<style>
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f4f4f4;

}

.main.content{
    max-width: 900px;
    margin: 20px auto;
    padding: 10px;
    background-color: #f4f4f4;
}

.form-container {
    background-color: white;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 20px;
}

/* Título */
.title, .subtitle {
    color: #333;
    text-align: center;
    font-weight: 700;
}

/* Inputs */
.input {
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 10px;
    width: 100%;
    transition: border-color 0.3s ease;
}

.input:focus {
    border-color: #3273dc;
    box-shadow: 0 0 5px rgba(50, 115, 220, 0.3);
    outline: none;
}

/* Select (list box) */
.select {
    position: relative;
    display: inline-block;
    width: 100%;
}

.select select {
    display: block;
    width: 100%;
    padding: 10px;
    font-size: 1rem;
    border: 1px solid #ccc;
    border-radius: 5px;
    appearance: none;
    background-size: 12px;
    cursor: pointer;
    transition: border-color 0.3s ease;
}

.select select:focus {
    border-color: #3273dc;
    box-shadow: 0 0 5px rgba(50, 115, 220, 0.3);
    outline: none;
}

/* Scroll personalizado para los select */
.select select::-webkit-scrollbar {
    width: 8px;
}

.select select::-webkit-scrollbar-thumb {
    background-color: #3273dc;
    border-radius: 5px;
}

.select select::-webkit-scrollbar-track {
    background-color: #f1f1f1;
    border-radius: 5px;
}

/* Botón de envío */
.button {
    background-color: #3273dc;
    color: white;
    border-radius: 5px;
    padding: 10px 20px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.button:hover {
    background-color: #275ba0;
}

/* Botones de archivo */
.file-label {
    border-radius: 7px;
    padding: 8px 15px;
    cursor: pointer;
}

.file-input:hover {
    background-color: #275ba0;
}

/* Columns */
.columns {
    margin-bottom: 1rem;
    padding: 5px;
}

.column {
    padding: 0 10px;
}

/* Responsivo */
@media screen and (max-width: 768px) {
    .columns {
        display: block;
    }

    .column {
        margin-bottom: 15px;
    }
}

.fecha-guardada{
    opacity: 0.2;
}
</style>