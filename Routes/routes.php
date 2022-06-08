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
    $vista = new UsuarioController();
    $vista->LoginVista();
    
});


/**
 * Valida la existencia de un meotdo POST para loguearse, envia los parametros y segun lo que se
 * retorne evalua si muestra una vista o un mensaje especificando lo sucedido.
 * 
 */
if (isset($_POST['action']) and $_POST['action'] == 'loguearse') {
    route('/login/index.php/login', function () {        
            $instancia_controlador = new UsuarioController();
            $resultado = $instancia_controlador->VerificarLogin($_POST['email'], $_POST['contrasena']);
            //var_dump($resultado);
            if ($resultado == 1) {
                header('Location: /login/index.php/home');

            }elseif($resultado = "credenciales_incorrectas");
            {
                $mensaje = "Usuario o Contraseña Incorrectos";
                include './Views/Usuario/login.php';
            }
    
        }
);
}

// Vista Registro.

route('/login/index.php/register', function () {
    $vista = new UsuarioController();
    $vista->RegistrarVista();
    
});

/**
 * Valida la existencia de un meotdo POST para insert, envia los parametros y segun lo que se
 * retorne evalua si muestra una vista o un mensaje especificando lo sucedido.
 * 
 */
if (isset($_POST['action']) and $_POST['action'] == 'insert') {
        route('/login/index.php/register', function () {
        // Recepciona datos de registro del usuario y los envia el metodo GuardarInformacionEnModelo
        $instancia_controlador = new UsuarioController();
        $resultado = $instancia_controlador->GuardarInformacionEnModelo(
            $_POST['nombre'],
            $_POST['email'],
            $_POST['documento'],
            $_POST['rol'],
            $_POST['contrasena']
        );
        if ($resultado == 1)
        {
            header('Location: /login/index.php/login');
        }elseif($resultado == "credenciales_existen") {
            $mensaje = "El documento o correo ya se encuentran registrados.";
            include './Views/Usuario/register.php';
            }
        }
    );
}


// Vista Editar Perfil 
route('/login/index.php/perfil', function (){
    $vista = new UsuarioController();
    $vista->PerfiUsuarios();
});

/**
 * Metodo get que permite editar un usuario. Y retorna la vista editar usuario.
 */
if (isset($_GET['action']) and $_GET['action'] == 'editar_perfil') {
    // Se toma de la url el id que se desea editar.
    route(
        '/login/index.php/perfil?action=editar_perfil&id=' .
            $_GET['id'],
        function () {
            $vista = new UsuarioController();
            $vista->EditarVista();
        }
    );

    /**
     * Metodo POST que permite enviar los parametros para actualizar los datos del usuario.
     */
    if (
        isset($_POST['action']) and
        $_POST['action'] == 'guardar_edicion_perfil'
    ) {
            route(
                '/login/index.php/perfil?action=editar_perfil&id=' .
                    $_GET['id'],
                function () {
                    $instancia_controlador = new UsuarioController();
                    $resultado = $instancia_controlador->EnviarDatosActualizar(
                        $_GET['id'],
                        $_POST['nombre'],
                        $_POST['documento'],
                        $_POST['email']
                    );

                    if ($resultado == 1) {
                        header('Location: /login/index.php/perfil');
                    } else {
                        if ($resultado == 'email_existente') {
                            $mensaje = 'El correo que ingresaste ya se encuentra registrado.';
                            
                            include './Views/Usuario/editar_perfil_usuario.php';

                        }elseif($resultado == 'documento_existente'){
                            $mensaje =
                                    'El documento que ingresaste ya se encuentra registrado';

                            include './Views/Usuario/editar_perfil_usuario.php';
                            }
                        }
                    }
            );
        
    }
}

// Vista Cambiar Contraseña

/**
 * Valida la existencia de un meotdo GET para cambiar_contrasena, envia los parametros y segun 
 * lo que se retorne evalua si muestra una vista o un mensaje especificando lo sucedido.
 * 
 */
if (isset($_GET['action']) and $_GET['action'] == 'cambiar_contrasena') {
    // Se toma de la url el id que se desea editar.
    route(
        '/login/index.php/perfil?action=cambiar_contrasena&id=' .
            $_GET['id'],
        function () {
            $vista = new UsuarioController();
            $vista->CambiarContrasenaVista();
        }
    );
/**
 * Envia los parametros de un Metodo POST guardar_contrasena, segun la respuesta muestra una vista 
 * un mensaje.
 */
    if (
        isset($_POST['action']) and
        $_POST['action'] == 'guardar_contrasena'
    ) {
            route(
                '/login/index.php/perfil?action=cambiar_contrasena&id=' .
            $_GET['id'],
                function () {
                
                    $instancia_controlador = new UsuarioController();
                    $resultado = $instancia_controlador->EnviarContrasenas(
                        $_GET['id'],
                        $_POST['contrasena_anterior'],
                        $_POST['contrasena_nueva'],
                        $_POST['contrasena_verificar']
                    );

                    if ($resultado == 1) {
                        header('Location: /login/index.php/lista_usuarios');
                    } else {
                        if ($resultado == 'contrasena_incorrecta') {
                            $mensaje =
                                'La contrasena que ingresaste no es correcta.';
                                include './Views/Usuario/cambiar_contrasena.php';

                        }elseif($resultado == 'id_no_coincide'){
                            $mensaje =
                                'No puedes realizar esta accion';
                                include './Views/Usuario/cambiar_contrasena.php';

                        }elseif($resultado == 'contasena_no_coincide'){
                            $mensaje = 'Las contraseñas no coinciden';
                            include './Views/Usuario/cambiar_contrasena.php';
                        }
                    }
                }
            );
        
    }
}

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
 * Metodo POST que permite editar un usuario. Y retorna la vista editar usuario.
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
                        if ($resultado == 'email_existente') {
                            $mensaje =
                                'El correo que ingresaste ya se encuentra registrado.';
                                include './Views/Admin/editar_usuarios.php';
                        }elseif($resultado == 'documento_existente'){
                            $mensaje =
                            'El documento que ingresaste ya se encuentra registrado';
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
