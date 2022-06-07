<?php
require_once 'Conexion.php';
require_once './Controllers/AdminController.php';

class Admin
{
    public $nombre;
    public $documento;
    public $email;
    public $conexion;
    public function __construct()
    {
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->ConexionRetornada();
    }
    public function TraerUsuarios()
    {
        $sql = 'SELECT * FROM usuarios WHERE estado = 1';
        $consulta = $this->conexion->prepare($sql);
        $consulta->execute();
        $objeto_consulta = $consulta->fetchAll(PDO::FETCH_ASSOC);

        return $objeto_consulta;
    }
    public function EliminarUsuario($id)
    {
        $sql = 'UPDATE usuarios SET estado = 0 WHERE id = :id';
        $consulta = $this->conexion->prepare($sql);
        $consulta->bindParam(':id', $id);
        $consulta->execute();
        return true;
    }

    public function EditarLista($id)
    {
        $sql = 'SELECT * FROM usuarios WHERE id = :id';
        $consulta = $this->conexion->prepare($sql);
        $consulta->bindParam(':id', $id);
        $consulta->execute();
        $objeto_consulta = $consulta->fetchAll(PDO::FETCH_ASSOC);

        return $objeto_consulta;
    }
    public function ActualizarTabla($id, $nombre, $documento,$email, $rol){

        $sql = "UPDATE usuarios SET nombre_usuario = :nombre_usuario, rol = :rol ";

        // Valida que el email y el documento del usuario no este en la base de datos.

        $stmt = $this->conexion->prepare(
            'SELECT id FROM usuarios WHERE email= :email'
        );
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $emailExistencia = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // if(count($emailExistencia)){
        //     $id_validado = $emailExistencia[0]['id'];
        // }else{
        //     $id_validado = 1;
        // }
        //var_dump($id_validado);

        if (count($emailExistencia) > 0){
            if ($emailExistencia[0]['id'] != $id){
                return "email_existente";
            }else{
                $emailExistencia = false;
            }
        }else{
            $emailExistencia = false;
        }
        
        // echo $emailExistencia."<br>";
        // echo $id."<br>";
        // echo $nombre."<br>";
        // echo $email."<br>";
        // echo $documento."<br>";
        // echo $rol."<br>";
        //--------------------------------

        $stmt2 = $this->conexion->prepare(
            'SELECT id FROM usuarios WHERE documento= :documento'
        );
        $stmt2->bindParam(':documento', $documento);
        $stmt2->execute();
        $documentoExistencia = $stmt2->fetchAll(PDO::FETCH_ASSOC);
        // $documento = intval($documento);
        // var_dump($documento);

        if (count($documentoExistencia) > 0){
            if ($documentoExistencia[0]['id'] != $id){
                return "documento_existente.";
            }else{
                $documentoExistencia = false;
            }
        }else{
            $documentoExistencia = false;
        }

        //echo $documentoExistencia ."<br>";

        if (!$emailExistencia and !$documentoExistencia ) {
            $sql .= ', email = :email , documento = :documento WHERE id = :id';
            $sentencia = $this->conexion->prepare($sql);
            $sentencia->bindParam(':nombre_usuario', $nombre);
            $sentencia->bindParam(':documento', $documento);
            $sentencia->bindParam(':email', $email);
            $sentencia->bindParam(':rol', $rol);
            $sentencia->bindParam(':id', $id);
            $sentencia->execute();

            return true;

        }elseif (!$emailExistencia and $documentoExistencia){
            $sql .= ', email = :email  WHERE id = :id';
            $sentencia = $this->conexion->prepare($sql);
            $sentencia->bindParam(':nombre_usuario', $nombre);
            $sentencia->bindParam(':email', $email);
            $sentencia->bindParam(':rol', $rol);
            $sentencia->bindParam(':id', $id);
            $sentencia->execute();

            return true;
        }elseif($emailExistencia and !$documentoExistencia){
            $sql .= ', documento = :documento  WHERE id = :id';
            $sentencia = $this->conexion->prepare($sql);
            $sentencia->bindParam(':nombre_usuario', $nombre);
            $sentencia->bindParam(':documento', $documento);
            $sentencia->bindParam(':rol', $rol);
            $sentencia->bindParam(':id', $id);
            $sentencia->execute();

            return true;

        }else{
            $sql .= " WHERE id = :id";
            $sentencia = $this->conexion->prepare($sql);
            $sentencia->bindParam(':nombre_usuario', $nombre);
            $sentencia->bindParam(':rol', $rol);
            $sentencia->bindParam(':id', $id);
            $sentencia->execute();
            //$se = $sentencia->fetchAll();
            return true;
        }
        return false;
    }
}
