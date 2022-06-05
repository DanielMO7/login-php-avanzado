<?php

require 'Conexion.php';
require './Controllers/IniciadorContoller.php';

// Inicia el session_star

$ics = new IniciadorContoller();

class Usuario
{
    public $id;
    public $nombre;
    public $documento;
    public $email;
    public $contrasena;
    public $rol;
    public $conexion;

    /**
     * Crea la conexión con la base de datos.
     *
     * @return void
     */
    public function __construct()
    {
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->ConexionRetornada();
    }

    /**
     * Función que inserta el usuario en la base de datos.
     *
     * @return true|false retorna true si el correo y el documento no existen en la base de datos
     * retorna false si alguno de los dos existe.
     */
    public function InsertarUsuario()
    {
        //Valida que el email del usuario no este en la base de datos.

        $stmt = $this->conexion->prepare(
            'SELECT COUNT(*) FROM usuarios WHERE email= ?'
        );
        $stmt->execute([$this->email]);

        $emailExistencia = $stmt->fetchColumn();

        // Valida la existencia del documento
        $consulta_documento = $this->conexion->prepare(
            'SELECT COUNT(*) FROM usuarios WHERE documento= ?'
        );
        $consulta_documento->execute([$this->documento]);

        $documento_existencia = $consulta_documento->fetchColumn();

        if ($emailExistencia != 0 or $documento_existencia != 0) {
            return false;
        } else {
            $sql = "INSERT INTO usuarios (nombre_usuario,email,documento,contrasena,rol)
            VALUES (:nombre_usuario,:email,:documento,:contrasena,:rol)";

            $sentencia = $this->conexion->prepare($sql);

            $contrasena_has = password_hash($this->contrasena, PASSWORD_BCRYPT);
            $sentencia->bindParam(':nombre_usuario', $this->nombre);
            $sentencia->bindParam(':email', $this->email);
            $sentencia->bindParam(':documento', $this->documento);
            $sentencia->bindParam(':contrasena', $contrasena_has);
            $sentencia->bindParam(':rol', $this->rol);
            $sentencia->execute();

            return true;
        }
    }
    /**
     * Función que valida el email y constraseña del usuario.
     *
     * @return true|false retorna true si la contraseña y el correo son correctos, false si no lo son
     */
    public function ValidarUsuario()
    {
        // Consulta email.
        $sql = "SELECT * FROM usuarios WHERE email = '$this->email'";
        $consulta = $this->conexion->prepare($sql);
        $consulta->execute();
        $objeto_consulta = $consulta->fetchAll(PDO::FETCH_OBJ);

        foreach ($objeto_consulta as $usuario) {
            if (password_verify($this->contrasena, $usuario->contrasena)) {
                $_SESSION['Usuario'] = $usuario->id;
                $_SESSION['rol'] = $usuario->rol;
                $token = bin2hex(random_bytes((20 - (20 % 2)) / 2));
                $_SESSION['token'] = $token;
                return true;
            } else {
                return false;
            }
        }
    }
}

?>
