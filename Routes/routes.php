<?php

//Importamos el UsuarioController para usarlo en los isset

require './Controllers/UsuarioController.php';

// Recepciona Información por el metodo GET.

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        // Retorna la vista del login.
        case 'login':
            $instancia_controlador = new UsuarioController();
            $instancia_controlador->LoginVista();
            break;

        // Retorna la vista del formulario de registro.
        case 'insert':
            $instancia_controlador = new UsuarioController();
            $instancia_controlador->RegistrarVista();
            break;
        
        // Retorna la vista del Home
        case 'home':
            $instancia_controlador = new UsuarioController();
            $instancia_controlador->Index();
    }
}

// Recepciona y Envia Información por el metodo POST.

if (isset($_POST['action'])) {
    switch ($_POST['action']) {

        // Recepciona datos de registro del usuario y los envia el metodo GuardarInformacionEnModelo
        case 'insert':
            $instancia_controlador = new UsuarioController();
            $password = password_hash($_POST['contrasena'], PASSWORD_BCRYPT);
            $instancia_controlador->GuardarInformacionEnModelo(
                $_POST['nombre'],
                $_POST['email'],
                $_POST['documento'],
                $_POST['rol'],
                $password
            );
            break;
            
        // Recibe el correo y contraseña del usuario y lo envia a VerificarLogin.
        case 'loguearse':            
            $instancia_controlador = new UsuarioController();
            $instancia_controlador->VerificarLogin($_POST['email'], $_POST['contrasena']);
            break;
    }
}

?>
