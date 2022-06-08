<?php
require_once 'Conexion.php';
require_once './Controllers/AdminController.php';

class Admin
{
    public $nombre;
    public $documento;
    public $email;
    public $conexion;

    /**
     * Crea la conexion con la base de datos.
     */
    public function __construct()
    {
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->ConexionRetornada();
    }

    /**
     * Selecciona de la base de datos todos los usuarios de la tabla usuarios.
     *
     * @return array Lista con todos los datos de los usuarios.
     */
    public function TraerUsuarios()
    {
        $sql = 'SELECT * FROM usuarios WHERE estado = 1';
        $consulta = $this->conexion->prepare($sql);
        $consulta->execute();
        $objeto_consulta = $consulta->fetchAll(PDO::FETCH_ASSOC);

        return $objeto_consulta;
    }

    /**
     * Actualiza el estado del usuario a 0 en donde el id de igual al id enviado.
     *
     * @param int $id
     * @return true Retorna true si se cambio correctamente el estado.
     */
    public function EliminarUsuario($id)
    {
        $sql = 'UPDATE usuarios SET estado = 0 WHERE id = :id';
        $consulta = $this->conexion->prepare($sql);
        $consulta->bindParam(':id', $id);
        $consulta->execute();
        return true;
    }

    /**
     * Selecciona todos los datos del id enviado y retorna la lista con los datos del usuario.
     *
     * @param int $id
     * @return array Retorna un array con todos los datos del usuario del que se tomo el id
     */
    public function EditarLista($id)
    {
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
     * @param string $rol
     * @return true|false| True si se pudo actualizar correctamente el usaurio. False si no se pudo 
     * actualizar algun dato.
     *
     */
    public function ActualizarTabla($id, $nombre, $documento, $email, $rol)
    {
        // Query que toma valor segun condiciones especificas.
        $sql =
            'UPDATE usuarios SET nombre_usuario = :nombre_usuario, rol = :rol ';

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
                return 'documento_existente.';
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
            $sentencia->bindParam(':rol', $rol);
            $sentencia->bindParam(':id', $id);
            $sentencia->execute();

            return true;
        } elseif (!$emailExistencia and $documentoExistencia) {
            $sql .= ', email = :email  WHERE id = :id';
            $sentencia = $this->conexion->prepare($sql);
            $sentencia->bindParam(':nombre_usuario', $nombre);
            $sentencia->bindParam(':email', $email);
            $sentencia->bindParam(':rol', $rol);
            $sentencia->bindParam(':id', $id);
            $sentencia->execute();

            return true;
        } elseif ($emailExistencia and !$documentoExistencia) {
            $sql .= ', documento = :documento  WHERE id = :id';
            $sentencia = $this->conexion->prepare($sql);
            $sentencia->bindParam(':nombre_usuario', $nombre);
            $sentencia->bindParam(':documento', $documento);
            $sentencia->bindParam(':rol', $rol);
            $sentencia->bindParam(':id', $id);
            $sentencia->execute();

            return true;
        } else {
            $sql .= ' WHERE id = :id';
            $sentencia = $this->conexion->prepare($sql);
            $sentencia->bindParam(':nombre_usuario', $nombre);
            $sentencia->bindParam(':rol', $rol);
            $sentencia->bindParam(':id', $id);
            $sentencia->execute();

            return true;
        }
        return false;
    }
}
