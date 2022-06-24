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
     * Envia el id que se desea eliminar retorna el resultado.
     *
     * @param  mixed $id
     * @return true|false True si el dato se pudo eliminar correctamente | False si no se pudo eliminar correctamente.
     */
    public function GuardarIDEliminar($id)
    {
        $usuario = new Admin();
        return $usuario->EliminarUsuario($id);
    }

    /**
     * Se envia el id del usuario a editar y trae una lista con los elementos del usuario.
     *
     * @param mixed $id
     * @return array Lista de elementos del id que se envio del usuario.
     */
    public function EditarUsuario($id)
    {
        $usuario = new Admin();
        return $usuario->EditarLista($id);
    }

    /**
     * Envia los datos que se desean actualizar de un usuario.
     *
     * @param int $id
     * @param string $nombre
     * @param string $email
     * @param int $documento
     * @param string $rol
     * @return true|false Retorna true si se actualizaron los datos y false si ocurrio algun inconveniente.
     */
    public function EnviarDatosActualizar(
        $id,
        $nombre,
        $email,
        $documento,
        $rol
    ) {
        $usuario = new Admin();
        return $usuario->ActualizarTabla(
            $id,
            $nombre,
            $email,
            $documento,
            $rol
        );
    }
}
