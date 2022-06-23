<?php

require 'Conexion.php';
require './Controllers/IniciadorContoller.php';

// Inicia el session_star


class Usuario
{
    public $id;
    public $nombre;
    public $documento;
    public $email;
    public $contrasena;
    public $rol;
    public $conexion;
    public $conexion_pdo;

    /**
     * Crea la conexión con la base de datos.
     *
     * @return void
     */
    public function __construct()
    {
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->ConexionRetornada();
        return $this->conexion;

    }
    /**
     * Función que inserta el usuario en la base de datos.
     *
     * @return true|false retorna true si el correo y el documento no existen en la base de datos
     * retorna false si alguno de los dos existe.
     */
    public function InsertarUsuario()
    {
        //Valida que el email y el documento del usuario no este en la base de datos.

        $stmt = $this->conexion->prepare(
            'SELECT COUNT(*) FROM usuarios WHERE email= :email OR documento = :documento'
        );
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':documento', $this->documento);
        $stmt->execute();

        $email_documentoExistencia = $stmt->fetchColumn();
        //return $emailExistencia;

        if ($email_documentoExistencia != 0) {
            return "credenciales_existen";
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
                $ics = new IniciadorContoller();
                
                $_SESSION['Usuario'] = $usuario->id;
                $_SESSION['rol'] = $usuario->rol;
                $_SESSION['Nombre'] = $usuario->nombre_usuario;
                $token = bin2hex(random_bytes((20 - (20 % 2)) / 2));
                $_SESSION['token'] = $token;
                return true;
            } else {
                return 'contraseña o email incorrectos';
            }
        }
    }

    /**
     * Selecciona todos los datos del usuario al que le pertenece el en la base de datos y los
     * retorna como un array.
     *
     * @return array Tabla con los datos del usuario.
     */
    public function ListaUsuario(){
        $sql = 'SELECT * FROM usuarios WHERE id = :id';
        $consulta = $this->conexion->prepare($sql);
        $consulta->bindParam(':id', $_SESSION['Usuario']);
        $consulta->execute();
        $objeto_consulta = $consulta->fetchAll(PDO::FETCH_ASSOC);

        return $objeto_consulta;

    }

    /**
     * Trae todos los datos de la talba usuario en donde el id sea igual al id recibido como parametro.
     *
     * @param int $id
     * @return array Tabla de datos del usario al que le pertenece el id
     */
    public function EditarLista($id){
        $sql = 'SELECT * FROM usuarios WHERE id = :id';
        $consulta = $this->conexion->prepare($sql);
        $consulta->bindParam(':id', $id);
        $consulta->execute();
        $objeto_consulta = $consulta->fetchAll(PDO::FETCH_ASSOC);

        return $objeto_consulta;
    }

    /**
     * Evalua los datos que desea actualizar el usuario, verifica que el email y el documento no se
     * encuentren en la base de datos ya que estos deben ser unicos. Retorna si se pudo realizar o no.
     *
     * @param int $id
     * @param string $nombre
     * @param int $documento
     * @param string $email
     * @return true|false True si se pudo actualizar correctamente. False si ocurrio algun inconveniente.
     */
    public function ActualizarTabla($id, $nombre, $documento, $email)
    {
        // Query que toma valor segun condiciones especificas.
        $sql =
            'UPDATE usuarios SET nombre_usuario = :nombre_usuario ';

        // Trae el id del email que sea igual al que desea actualizar el usuario.

        $consulta = $this->conexion->prepare(
            'SELECT id FROM usuarios WHERE email= :email'
        );
        $consulta->bindParam(':email', $email);
        $consulta->execute();
        $emailExistencia = $consulta->fetchAll(PDO::FETCH_ASSOC);

        /**
         * Valida si encontro algo, si es asi compara el id de ese email con el id que tiene el usuario.
         * Si el id del usuario es diferente al id que tiene ese email retorna retorna un string que dice
         * que el email ya esta en uso.
         */
        if (count($emailExistencia) > 0) {
            if ($emailExistencia[0]['id'] != $id) {
                return 'email_existente';
            } else {
                $emailExistencia = false;
            }
        } else {
            $emailExistencia = false;
        }

        // Trae el id del email que sea igual al que desea actualizar el usuario.

        $consulta2 = $this->conexion->prepare(
            'SELECT id FROM usuarios WHERE documento= :documento'
        );
        $consulta2->bindParam(':documento', $documento);
        $consulta2->execute();
        $documentoExistencia = $consulta2->fetchAll(PDO::FETCH_ASSOC);

        /**
         * Valida si encontro algo, si es asi compara el id de ese documento con el id que tiene el usuario.
         * Si el id del usuario es diferente al id que tiene ese documento retorna un string que dice que el
         * documento ya esta en uso.
         */
        if (count($documentoExistencia) > 0) {
            if ($documentoExistencia[0]['id'] != $id) {
                return 'documento_existente';
            } else {
                $documentoExistencia = false;
            }
        } else {
            $documentoExistencia = false;
        }

        /**
         * Valida las diferentes condiciones que se den para actualizar la query, enviara la consulta sql
         * correcta del dato que desea cambiar el usuario.
         *
         * Si el usuario solo desea cambiar su nombre, se actualizara la tabla con la query especifica que
         * realizara esa accion.
         */
        if (!$emailExistencia and !$documentoExistencia) {
            $sql .= ', email = :email , documento = :documento WHERE id = :id';
            $sentencia = $this->conexion->prepare($sql);
            $sentencia->bindParam(':nombre_usuario', $nombre);
            $sentencia->bindParam(':documento', $documento);
            $sentencia->bindParam(':email', $email);
            $sentencia->bindParam(':id', $id);
            $sentencia->execute();

            return true;
        } elseif (!$emailExistencia and $documentoExistencia) {
            $sql .= ', email = :email  WHERE id = :id';
            $sentencia = $this->conexion->prepare($sql);
            $sentencia->bindParam(':nombre_usuario', $nombre);
            $sentencia->bindParam(':email', $email);
            $sentencia->bindParam(':id', $id);
            $sentencia->execute();

            return true;
        } elseif ($emailExistencia and !$documentoExistencia) {
            $sql .= ', documento = :documento  WHERE id = :id';
            $sentencia = $this->conexion->prepare($sql);
            $sentencia->bindParam(':nombre_usuario', $nombre);
            $sentencia->bindParam(':documento', $documento);
            $sentencia->bindParam(':id', $id);
            $sentencia->execute();

            return true;
        } else {
            $sql .= ' WHERE id = :id';
            $sentencia = $this->conexion->prepare($sql);
            $sentencia->bindParam(':nombre_usuario', $nombre);
            $sentencia->bindParam(':id', $id);
            $sentencia->execute();

            return true;
        }
        return false;
    }

    /**
     * Verifica que la contraseña ingresada sea igual a la almcenada en la base de datos y que 
     * las dos contraseñas nuevas sean totalmente iguales. Si no es asi retorna una condicion
     * especificando el caso o el inconveniente presentado.
     * Tambien hasea la contraseña en caso de que la condicion sea correcta.
     *
     * @param int $id
     * @param string $contrasena_anterior
     * @param string $contrasena_nueva
     * @param string $contrasena_verificar
     * @return true|false True si se pudo actualizar correctamente, False si resulto algun inconveniente.
     */
    public function VerficiarCambiarContrasena($id, $contrasena_anterior, $contrasena_nueva,$contrasena_verificar){
        $ics = new IniciadorContoller();
        if($_SESSION['Usuario'] == $id){
            if($contrasena_nueva == $contrasena_verificar){
                $sql = "SELECT * FROM usuarios WHERE id = '$id'";
                $consulta = $this->conexion->prepare($sql);
                $consulta->execute();
                $objeto_consulta = $consulta->fetchAll(PDO::FETCH_OBJ);

                foreach ($objeto_consulta as $usuario) {
                    if (password_verify($contrasena_anterior, $usuario->contrasena)) {
                        $sql = "UPDATE usuarios SET contrasena = :contrasena WHERE id = :id";
                        $contrasena_has = password_hash($contrasena_nueva, PASSWORD_BCRYPT);    
                        $consulta = $this->conexion->prepare($sql);
                        $consulta->bindParam(':contrasena', $contrasena_has);
                        $consulta->bindParam(':id', $id);
                        $consulta->execute();
                        return true;
                
                        } else {
                        return "contrasena_incorrecta";
                        }
                    }
            }else{
                return "contasena_no_coincide";
            }
        }else{
            return "id_no_coincide";
        }

    }
}

?>
