<?php

require './Models/Usuario.php';


class UsuarioController extends Usuario
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
        $this->nombre = $nombre;
        $this->email = $email;
        $this->documento = $documento;
        $this->contrasena = $password;
        $this->rol = $rol;
        $this->InsertarUsuario();
    }    

    /**
     * Verifica el email y contraseña del usuario 
     *
     * @param  mixed $email
     * @param  mixed $contrasena
     * @return void
     */
    public function VerificarLogin($email, $contrasena)
    {
        $this->email = $email;
        $this->contrasena = $contrasena;
        $informacion_usuario = $this->ValidarUsuario();
        if ($informacion_usuario) {
            echo "Bienvenido ". $_SESSION['rol'];
            //$this->index();
        }else{
            //$this->LoginVista();
        }

    }
}

?>
