<?php

namespace app\controller;
use app\model\mainModel;
use \PDO;

class loginController extends mainModel {

    /*----------  Controlador iniciar sesión  ----------*/
    public function iniciarSesionControlador() {

        $usuario = $this->limpiarCadena($_POST['login_usuario']);
        $clave = $this->limpiarCadena($_POST['login_clave']);

        # Verificando campos obligatorios #
        if ($usuario == "" || $clave == "") {
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Ocurrió un error inesperado',
                    text: 'No has llenado todos los campos que son obligatorios'
                });
            </script>";
        } else {

            try {
                # Obtener conexión a la base de datos #
                $conn = $this->conectar();

                # Realizando la consulta segura #
                $sql = "SELECT id,nombre,apellido,cargo,correo,password,id_rol FROM usuario WHERE correo = :correo";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':correo', $usuario);
                $stmt->execute();
                
                # Verificando si el usuario existe #
                $usuarioData = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($usuarioData && $usuarioData['password'] == $clave) {
                    // Sesiones iniciadas si las credenciales son correctas
                    $_SESSION['id'] = $usuarioData['id'];
                    $_SESSION['nombre'] = $usuarioData['nombre'];
                    $_SESSION['apellido'] = $usuarioData['apellido'];
                    $_SESSION['cargo'] = $usuarioData['cargo'];
                    $_SESSION['correo'] = $usuarioData['correo'];
                    $_SESSION['id_rol'] = $usuarioData['id_rol'];
                    
                    if($_SESSION['id_rol'] == 5){
                        echo "<script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Ingreso Exitoso',
                                text: 'Bienvenido al sistema de gestión de equipos',
                                timer: 1000,
                                showConfirmButton: false
                            }).then(function() {
                                window.location.href = '" . APP_URL . "?views=dashboard';
                            });
                        </script>";
                    }else{
                        echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Ingreso Exitoso',
                            text: 'Bienvenido al sistema de gestión de equipos',
                            timer: 1000,
                            showConfirmButton: false
                        }).then(function() {
                            window.location.href = '" . APP_URL . "?views=Inicio';
                        });
                    </script>";
                    }
                        


                } else {
                    echo "<script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Ocurrió un error inesperado',
                            text: 'Usuario o clave incorrectos'
                        });
                    </script>";
                }
            } catch (Exception $e) {
                echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Hubo un problema al conectarse a la base de datos.'
                    });
                </script>";
            }
        }
    }

    /*----------  Controlador cerrar sesión  ----------*/
    public function cerrarSesionControlador() {

        session_destroy();

        if (headers_sent()) {
            echo "<script> window.location.href='" . APP_URL . "?views=login/'; </script>";
        } else {
            header("Location: " . APP_URL . "?views=login");
        }
    }
}
