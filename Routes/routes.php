<?php

//Importamos el UsuarioController para usarlo en los isset

require './Controllers/UsuarioController.php';

// Retorna las vistas de cada ruta.

$routes = [];

// Vista Home.

route('/login/index.php/home', function () {
    $vista = new UsuarioController();
    $vista->Index();
});

// Vista Login.

route('/login/index.php/login', function () {
    $vista = new UsuarioController();
    $vista->LoginVista();
});

// Vista Registro.

route('/login/index.php/register', function () {
    $vista = new UsuarioController();
    $vista->RegistrarVista();
});

route('/404', function () {
    echo 'Page not found 404';
});

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

// Recepciona Información por el metodo GET.
if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'cerrar_sesion':
            $instancia_controlador = new UsuarioController();
            $instancia_controlador->CerrarSession();
            break;
    }
}
// Recepciona y Envia Información por el metodo POST.

if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        // Recepciona datos de registro del usuario y los envia el metodo GuardarInformacionEnModelo
        case 'insert':
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
            break;

        // Recibe el correo y contraseña del usuario y lo envia a VerificarLogin.
        case 'loguearse':
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
            break;
    }
}

?>
