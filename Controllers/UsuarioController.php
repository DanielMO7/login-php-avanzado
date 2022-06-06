<?php

require './Models/Usuario.php';

class UsuarioController
{
    public function LoginVista()
    {
        require './Views/Usuario/login.php';
    }
    public function RegistrarVista()
    {
        require './Views/Usuario/register.php';
    }
    public function Index()
    {
        require './Views/Usuario/home.php';
    }

    /**
     * Guarda la información recibida por el método POST y la envía al metodo InsertarUsuario.
     *
     * @return void
     */

    public function GuardarInformacionEnModelo(
        $nombre,
        $email,
        $documento,
        $rol,
        $password
    ) {
        $usuario = new Usuario();
        $usuario->nombre = $nombre;
        $usuario->email = $email;
        $usuario->documento = $documento;
        $usuario->contrasena = $password;
        $usuario->rol = $rol;
        return $usuario->InsertarUsuario();
    }

    /**
     * Verifica el email y contraseña del usuario.
     * Muestra la vista en caso de que el correo y la contraseña sean correctos o sean in correctos.
     *
     * @param  mixed $email
     * @param  mixed $contrasena
     * @return void
     */

    public function VerificarLogin($email, $contrasena)
    {
        $usuario = new Usuario();
        $usuario->email = $email;
        $usuario->contrasena = $contrasena;
        
        return $usuario->ValidarUsuario();
    }
    /**
     * Borra las cokies de la session y destruye la session.
     *
     * @return void
     */
    public function CerrarSession()
    {
        if (ini_get('session.use_cookies')) {
            $parametro = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $parametro['path'],
                $parametro['domain'],
                $parametro['secure'],
                $parametro['httponly']
            );
        }

        session_destroy();
        header('Location: /login/index.php/login');
    }
}
?>
