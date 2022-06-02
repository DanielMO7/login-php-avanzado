<?php 

require('Conexion.php');
require './Controllers/IniciadorContoller.php';

// Inicia el session_star

$ics = new IniciadorContoller();

class Usuario {
    protected $id;
    protected $nombre;
    protected $documento;
    protected $email;
    protected $contrasena;
    protected $rol;
    private $conexion;
    
    /**
     * Crea la conexión con la base de datos.
     *
     * @return void
     */
    public function __construct(){
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->ConexionRetornada();

    }
    
    /**
     * Función que inserta el usuario en la base de datos.
     *
     * @return void
     */
    protected function InsertarUsuario()
    { 
        $sql = "INSERT INTO usuarios (nombre_usuario,email,documento,contrasena,rol) 
        VALUES (:nombre_usuario,:email,:documento,:contrasena,:rol)";
        
        $sentencia = $this->conexion->prepare($sql);

        $sentencia->bindParam(':nombre_usuario', $this->nombre); 
        $sentencia->bindParam(':email', $this->email); 
        $sentencia->bindParam(':documento', $this->documento);
        $sentencia->bindParam(':contrasena', $this->contrasena);
        $sentencia->bindParam(':rol', $this->rol);
        $sentencia->execute();
        
        echo "Usuario guardado Correctamente";

    }    
    /**
     * Función que valida el email y constraseña del usuario.
     *
     * @return true|false retorna true si la contraseña y el correo son correctos, false si no lo son
     */
    protected function ValidarUsuario(){
        $sql ="SELECT * FROM usuarios WHERE email = '$this->email'";
        $consulta = $this->conexion->prepare($sql);
        $consulta->execute();
        $objeto_consulta = $consulta->fetchAll(PDO::FETCH_OBJ);
        foreach($objeto_consulta as $usuario) {
            if(password_verify($this->contrasena, $usuario->contrasena)){                
                $_SESSION['Usuario']= $usuario->id;
                $_SESSION['rol']= $usuario->rol;
                return true;
            }
            else{
                return false;
            }

    }
}


}

?>