<?php
session_start();
if (isset($_SESSION['rol']) and $_SESSION['rol'] == 'Administrador') {

    echo 'Bienvenido ' . $_SESSION['rol'] . ' a la Lista de Usuarios.';

    require_once '././Controllers/AdminController.php';

    $lista_usuarios = new AdminController();
    $resultado = $lista_usuarios->ListaUsuarios();
    ?>
<h2>Lista De Usuarios</h2>      
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Documento</th>
                <th>Email</th>   
                <th>Rol</th>
                <th>Accion</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($resultado as $usuario) { ?>
               <tr>
               <td><?php echo $usuario['nombre_usuario']; ?></td>
               <td><?php echo $usuario['documento']; ?></td>
               <td><?php echo $usuario['email']; ?></td>
               <td><?php echo $usuario['rol']; ?></td>
               <td>
               <form action="" method="GET">
                <input type="hidden" name="action" value="editar_usuario">
                <input type="hidden" name="id" value="<?php echo $usuario[
                    'id'
                ]; ?>">
                <input type="submit" value="Editar">
               </form>|
                <form action="" method="POST">
                <input type="hidden" name="action" value="borrar_usuario">
                <input type="hidden" name="id" value="<?php echo $usuario[
                    'id'
                ]; ?>">
                <input type="submit" value="Borrar">
                </td>
               </tr>
            <?php } ?>
        </tbody>
    </table>    
<?php
} else {
    header('Location: /login/index.php/home');
}
?>
