<?php

//Importamos el UsuarioController para usarlo en los isset

require './Controllers/UsuarioController.php';
require './Controllers/AdminController.php';

// Retorna las vistas de cada ruta.

$routes = [];

// Vista Home.

route('/login/index.php/home', function () {
    $vista = new UsuarioController();
    $vista->Index();
});

// Vista Login.

route('/login/index.php/login', function () {
    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'loguearse') {
            // Recibe el correo y contraseña del usuario y lo envia a VerificarLogin.
            $instancia_controlador = new UsuarioController();
            if (
                $instancia_controlador->VerificarLogin(
                    $_POST['email'],
                    $_POST['contrasena']
                )
            ) {
                header('Location: /login/index.php/home');
            } else {
                header('Location: /login/index.php/login');
            }
        }
    }
    $vista = new UsuarioController();
    $vista->LoginVista();
});

// Vista Registro.

route('/login/index.php/register', function () {
    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'insert') {
            // Recepciona datos de registro del usuario y los envia el metodo GuardarInformacionEnModelo
            $instancia_controlador = new UsuarioController();
            if (
                $instancia_controlador->GuardarInformacionEnModelo(
                    $_POST['nombre'],
                    $_POST['email'],
                    $_POST['documento'],
                    $_POST['rol'],
                    $_POST['contrasena']
                )
            ) {
                header('Location: /login/index.php/login');
            } else {
                header('Location:/login/index.php/register');
            }
        }
    }
    $vista = new UsuarioController();
    $vista->RegistrarVista();
});

// Vista en caso de que no encuentre la URL

route('/404', function () {
    echo 'Page not found 404';
});

/**
 * ---------------------------- Rutas Admin -------------------------------------------------->
 */

/**
 * Retorna la vista principal de Admin.
 */
route('/login/index.php/admin', function () {
    $vista = new AdminController();
    $vista->AdminIndex();
});

/**
 * Metodo POST que permite eliminar un usuario. Retorna la vista Lista de Usuarios.
 */
route('/login/index.php/lista_usuarios', function () {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'borrar_usuario':
                $instancia_controlador = new AdminController();
                if ($instancia_controlador->GuardarIDEliminar($_POST['id'])) {
                    header('Location: /login/index.php/lista_usuarios');
                } else {
                    echo 'No se pudo eliminar el usuario.';
                }
                break;
        }
    }
    $vista = new AdminController();
    $vista->ListaVista();
});
/**
 * Metodo POST que permite aditar un usuario. Y retorna la vista editar usuario.
 */
if (isset($_GET['action']) and $_GET['action'] == 'editar_usuario') {
    // Se toma de la url el id que se desea editar.
    route(
        '/login/index.php/lista_usuarios?action=editar_usuario&id=' .
            $_GET['id'],
        function () {
            $vista = new AdminController();
            $vista->EditarVista();
        }
    );

    /**
     * Metodo POST que permite enviar los parametros para actualizar los datos del usuario.
     */
    if (
        isset($_POST['action']) and
        $_POST['action'] == 'guardar_edicion_usuarios'
    ) {
        session_start();
        if ($_SESSION['rol'] == 'Administrador') {
            route(
                '/login/index.php/lista_usuarios?action=editar_usuario&id=' .
                    $_GET['id'],
                function () {
                    $instancia_controlador = new AdminController();
                    $resultado = $instancia_controlador->EnviarDatosActualizar(
                        $_GET['id'],
                        $_POST['nombre'],
                        $_POST['documento'],
                        $_POST['email'],
                        $_POST['rol']
                    );

                    if ($resultado == 1) {
                        header('Location: /login/index.php/lista_usuarios');
                    } else {
                        if ($resultado = 'email_existente') {
                            $mensaje =
                                'El correo o documento que ingresaste ya existe.';
                            include './Views/Admin/editar_usuarios.php';
                        }
                    }
                }
            );
        }
    }
}

// Cierra la sesion del usuario.
if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'cerrar_sesion':
            $instancia_controlador = new UsuarioController();
            $instancia_controlador->CerrarSession();
            break;
    }
}

/**
 * Guarda la ruta y la funcion que esta ejecuta.
 *
 * @param  mixed $ruta
 * @param  mixed $funcion_llamada
 * @return void
 */
function route(string $ruta, callable $funcion_llamada)
{
    global $routes;
    // Array asociativo que guarda una funcion.
    $routes[$ruta] = $funcion_llamada;
}

run();

/**
 * Evalua si la ruta enviada como parametro es igual a la ruta del navegador.
 * Si es asi ejecuta la funcion llamada. Si no asigna la ruta /404
 *
 * @return void
 */
function run()
{
    global $routes;
    $uri = $_SERVER['REQUEST_URI'];
    $found = false;
    //var_dump($routes);
    // Busca en el array la posicion donde se encuentre la funcion que se requiere.
    foreach ($routes as $ruta => $funcion_llamada) {
        if ($ruta !== $uri) {
            continue;
        }

        $found = true;
        $funcion_llamada();
    }

    if (!$found) {
        // Asigna la ruta por default cuando esta no se encuentra en el array ruta.
        $no_funciona_llamada = $routes['/404'];
        $no_funciona_llamada();
    }
}

?>
