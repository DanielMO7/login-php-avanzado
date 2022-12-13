<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
//Importamos el UsuarioController para usarlo en los isset

require './Controllers/UsuarioController.php';
require './Controllers/AdminController.php';

// Retorna las vistas de cada ruta.

$routes = [];

// Vista Login.

route('/index.php/login', function () {
    $vista = new UsuarioController();
    $vista->LoginVista();
});

// Vista Registro.

route('/index.php/register', function () {
    $vista = new UsuarioController();
    $vista->RegistrarVista();
});

/**
 * Envia los parametros y segun lo que se retorne evalua y muestra un mensaje
 * especificando lo sucedido.
 *
 */
route('/index.php/login/loguearse', function () {
    $instancia_controlador = new UsuarioController();
    $resultado = $instancia_controlador->VerificarLogin(
        $_POST['email'],
        $_POST['contrasena']
    );

    if ($resultado == 1) {
        echo 1;
    } elseif ($resultado = 'credenciales_incorrectas') {
        echo 2;
    }
});

/**
 * Insert, envia los parametros y segun lo que se retorne evalua si las credenciales son
 * correctas o no.
 *
 */
route('/index.php/register/insertar', function () {
    $instancia_controlador = new UsuarioController();
    $resultado = $instancia_controlador->GuardarInformacionEnModelo(
        $_POST['nombre'],
        $_POST['email'],
        $_POST['documento'],
        $_POST['rol'],
        $_POST['contrasena']
    );
    if ($resultado == 1) {
        echo 1;
    } elseif ($resultado == 'credenciales_existen') {
        echo 2;
    }
});
// Vista Home.
route('/index.php/home', function () {
    $vista = new UsuarioController();
    $vista->Index();
});

// Vista en caso de que no encuentre la URL
route('/404', function () {
    echo 'Page not found 404';
});

/**
 * Valida Que existe una sesion.
 * */
if (isset($_SESSION['token'])) {
    // Vista Editar Perfil
    route('/index.php/perfil', function () {
        $vista = new UsuarioController();
        $vista->PerfiUsuarios();
    });

    route('/index.php/perfil-usuario', function () {
        $usuarios = new UsuarioController();
        $resultados = $usuarios->GuardarInfoListaUsuario();
        echo json_encode($resultados);
    });

    /**
     * Datos del usuario a editar.
     */
    if (isset($_GET['id']) and $_GET['id'] == $_SESSION['Usuario']) {
        route('/index.php/perfil-usuario?id=' . $_GET['id'], function () {
            $vista = new UsuarioController();
            $vista->EditarVista();
        });
        route(
            '/index.php/perfil-usuario/editar_perfil?id=' . $_GET['id'],
            function () {
                $usuario = new UsuarioController();
                $resultados = $usuario->EditarUsuario($_GET['id']);
                echo json_encode($resultados);
            }
        );
    }

    /**
     * Cierra la sesion del usuario.
     */
    route('/index.php/cerrar_sesion', function () {
        $instancia_controlador = new UsuarioController();
        $instancia_controlador->CerrarSession();
    });

    route('/index.php/perfil-usuario/cambiar_contrasena', function () {
        $vista = new UsuarioController();
        $vista->CambiarContrasenaVista();
    });

    /**
     * METODOS POST
     */

    /**
     * Envia los datos que el usaurio desea guardar, retorna un mensaje de confirmacion o
     * en caso de error.
     */
    route(
        '/index.php/perfil-usuario/editar_perfil/guardar_edicion_perfil',
        function () {
            if ($_SESSION['Usuario'] == $_POST['id']) {
                $instancia_controlador = new UsuarioController();
                $resultado = $instancia_controlador->EnviarDatosActualizar(
                    $_POST['id'],
                    $_POST['nombre'],
                    $_POST['documento'],
                    $_POST['email']
                );
                if ($resultado == 1) {
                    echo 'datos_guardados';
                } elseif ($resultado == 'email_existente') {
                    echo 'email_existente';
                } elseif ($resultado == 'documento_existente') {
                    echo 'documento_existente';
                }
            } else {
                echo 'No estas autorizado';
            }
        }
    );

    /**
     * Envia los parametro para actulizar la contraseña segun la respuesta muestra un
     * un mensaje.
     */
    route(
        '/index.php/lista_usuario/cambiar_contrasena/guardar_contrasena',
        function () {
            if ($_SESSION['Usuario'] == $_POST['id']) {
                $instancia_controlador = new UsuarioController();
                $resultado = $instancia_controlador->EnviarContrasenas(
                    $_POST['id'],
                    $_POST['contrasena_anterior'],
                    $_POST['contrasena_nueva'],
                    $_POST['contrasena_verificar']
                );
                if ($resultado == 1) {
                    echo 'contrasena_correcta';
                } else {
                    if ($resultado == 'contrasena_incorrecta') {
                        echo 'contrasena_incorrecta';
                    } elseif ($resultado == 'id_no_coincide') {
                        echo 'no_autorizacion';
                    } elseif ($resultado == 'contasena_no_coincide') {
                        echo 'contrasena_no_coincide';
                    }
                }
            } else {
                echo 'No estas autorizado.';
            }
        }
    );

    /**
     * ---------------------------- Rutas Admin -------------------------------------------------->
     */
    if ($_SESSION['rol'] == 'Administrador') {
        /**
         * Retorna la vista principal de Admin.
         */
        route('/index.php/admin', function () {
            $vista = new AdminController();
            $vista->AdminIndex();
        });

        route('/index.php/lista_usuarios', function () {
            $vista = new AdminController();
            $vista->ListaVista();
        });

        /**
         * Muestra la lista de usuarios que hay en la base de datos.
         */
        route('/index.php/lista_usuarios/datos', function () {
            $lista_usuarios = new AdminController();
            $usuarios = $lista_usuarios->ListaUsuarios();

            echo json_encode($usuarios);
        });

        /**
         * Muestra los datos del usuario.
         */
        if (isset($_GET['id'])) {
            route(
                '/index.php/lista_usuarios/editar_usuario?id=' .
                    $_GET['id'],
                function () {
                    $vista = new AdminController();
                    $vista->EditarVista();
                }
            );

            route(
                '/index.php/lista_usuarios/editar_usuario/datos?id=' .
                    $_GET['id'],
                function () {
                    $usuario = new AdminController();
                    $resultados = $usuario->EditarUsuario($_GET['id']);

                    echo json_encode($resultados);
                }
            );
        }

        /**
         * METODOS POST ADMIN
         */

        /**
         * Permite borrar el usuario del sistema.
         */
        route('/index.php/lista_usuarios/borrar_usuario', function () {
            $instancia_controlador = new AdminController();
            if ($instancia_controlador->GuardarIDEliminar($_POST['id'])) {
                echo 'borrado_correctamente';
            } else {
                echo 'Error';
            }
        });

        /**
         * Guarda los datos al editar un usuario.
         */
        route(
            '/index.php/lista_usuarios/editar_usuario/guardar_edicion_usuarios',
            function () {
                $instancia_controlador = new AdminController();
                $resultado = $instancia_controlador->EnviarDatosActualizar(
                    $_POST['id'],
                    $_POST['nombre'],
                    $_POST['documento'],
                    $_POST['email'],
                    $_POST['rol']
                );

                if ($resultado == 1) {
                    echo 'datos_guardados';
                } else {
                    if ($resultado == 'email_existente') {
                        echo 'email_existente';
                    } elseif ($resultado == 'documento_existente') {
                        echo 'documento_existente';
                    }
                }
            }
        );
    }
} else {
    route('/index.php/login', function () {
        $vista = new UsuarioController();
        $vista->LoginVista();
    });
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
