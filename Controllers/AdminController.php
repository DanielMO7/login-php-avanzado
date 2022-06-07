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

    public function ListaUsuarios()
    {
        $usuarios = new Admin();
        return $usuarios->TraerUsuarios();
    }
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
}
