<?php
require_once 'Conexion.php';
require_once './Controllers/AdminController.php';

class Admin
{
    public $conexion;
    public function __construct()
    {
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->ConexionRetornada();
    }
    public function TraerUsuarios(){

        $sql = "SELECT * FROM usuarios WHERE estado = 1";
        $consulta = $this->conexion->prepare($sql);
        $consulta->execute();
        $objeto_consulta = $consulta->fetchAll(PDO::FETCH_ASSOC);

        return $objeto_consulta;
    }
    public function EliminarUsuario($id){
        $sql = "UPDATE usuarios SET estado = 0 WHERE id = :id";
        $consulta = $this->conexion->prepare($sql);
        $consulta->bindParam(':id', $id);
        $consulta->execute();
        return true;        

    }
    public function EditarUsuario($id){

        $sql = "SELECT * FROM usuarios WHERE id = ?";
        $consulta = $this->conexion->prepare($sql);
        $consulta->bindParam(':id', $id);
        $consulta->execute();
        $objeto_consulta = $consulta->fetchAll(PDO::FETCH_ASSOC);

        return $objeto_consulta;
    }
    public function EditarLista($id){

        $sql = "SELECT * FROM usuarios WHERE id = ?";
        $consulta = $this->conexion->prepare($sql);
        $consulta->bindParam(':id', $id);
        $consulta->execute();
        $objeto_consulta = $consulta->fetchAll(PDO::FETCH_ASSOC);

        return $objeto_consulta;
    }



}