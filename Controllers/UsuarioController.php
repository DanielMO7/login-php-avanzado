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
    public function PerfiUsuarios()
    {
        require './Views/Usuario/perfil_usuario.php';
    }

    public function EditarVista()
    {
        require './Views/Usuario/editar_perfil_usuario.php';
    }

    public function CambiarContrasenaVista()
    {
        require './Views/Usuario/cambiar_contrasena.php';
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
    /**
     * Trae todos los datos que tiene el usuario, que hace la peticion, en la base de datos.
     *
     * @return array Tabla de datos del usuario.
     */
    public function GuardarInfoListaUsuario(){
        $usuario = new Usuario();
        $resultado = $usuario->ListaUsuario();
        return $resultado;

    }

    /**
     * Envia el id del usuario a editar y trae los datos del usuario para actualizar.
     *
     * @param int $id
     * @return array Tabla de datos del usuario a editar.
     */
    public function EditarUsuario($id)
    {
        $usuario = new Usuario();
        return $usuario->EditarLista($id);
    }

    /**
     * Recepciona los parametros del usuario que se va a actualizar y los envia al modelo para
     * procesarlos. 
     *
     * @param int $id
     * @param string $nombre
     * @param string $email
     * @param int $documento
     * @return true|false Retorna true si se actualizar correctamente la tabla y false si ocurrio 
     * algun inconveniente.
     */
    public function EnviarDatosActualizar(
        $id,
        $nombre,
        $email,
        $documento
    ) {
        $usuario = new Usuario();
        return $usuario->ActualizarTabla(
            $id,
            $nombre,
            $email,
            $documento
        );
    }

    /**
     * Envia los parametros para actualizar y verificar, valida que la contraseña anterior sea
     * correcta y que la contraseña nueva sea igual a la enterior.
     *
     * @param int $id
     * @param string $contrasena_anterior
     * @param string $contrasena_nueva
     * @param string $contrasena_verificar
     * @return true|false Retorna true si se pudo actualizar correctamente la contraseña y false si
     * ocurrio algun error.
     */
    public function EnviarContrasenas($id, $contrasena_anterior, $contrasena_nueva,$contrasena_verificar){
        $usuario = new Usuario();
        return $usuario->VerficiarCambiarContrasena($id, $contrasena_anterior, $contrasena_nueva,$contrasena_verificar);
    }
}
?>
