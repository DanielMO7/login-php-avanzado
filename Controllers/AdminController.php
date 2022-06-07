<?php

require './Models/Admin.php';

class AdminController
{
    public function AdminIndex()
    {
        require './Views/Admin/admin.php';
    }
    public function ListaVista()
    {
        require './Views/Admin/lista_usuarios.php';
    }
    public function EditarVista()
    {
        require './Views/Admin/editar_usuarios.php';
    }
    
    /**
     * Funcion que trae todos los usuarios almacenados en la base de datos.
     *
     * @return array lista de usuarios.
     */
    public function ListaUsuarios()
    {
        $usuarios = new Admin();
        return $usuarios->TraerUsuarios();
    }
        
    /**
     * Funcion que envia el id que se desea eliminar y trae el resultado.
     *
     * @param  mixed $id
     * @return true|false 
     */
    public function GuardarIDEliminar($id)
    {
        $usuario = new Admin();
        return $usuario->EliminarUsuario($id);
    }
    public function EditarUsuario($id)
    {
        $usuario = new Admin();
        return $usuario->EditarLista($id);
    }
    public function EnviarDatosActualizar($id, $nombre,  $email,$documento, $rol){
        $usuario = new Admin();
        return $usuario->ActualizarTabla($id, $nombre, $email,$documento, $rol);


    }
}
