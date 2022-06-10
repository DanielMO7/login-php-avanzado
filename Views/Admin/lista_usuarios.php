<?php
// Verifica si existe una session, si no exsite la crea  si ya existe no la crea.
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
/**
 * Verifica que el rol del usuario sea administrador para que pueda acceder a esta vista.
 */
if (isset($_SESSION['rol']) and $_SESSION['rol'] == 'Administrador') {

    echo '<h2>Bienvenido ' . $_SESSION['rol'] . ' a la Lista de Usuarios.</h2>';

    require_once '././Controllers/AdminController.php';

    /**
     * Se invoca una funcion que permite traer los datos del los usuarios.
     */
    $lista_usuarios = new AdminController();
    $usuarios = $lista_usuarios->ListaUsuarios();
    ?>
<h2>Lista De Usuarios</h2>
<input type="button" value="cerrar sesion" onclick="window.location.href='/login/index.php?action=cerrar_sesion'">     
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
            <?php foreach ($usuarios as $usuario) { ?>
               <tr>
               <td><?php echo $usuario['nombre_usuario']; ?></td>
               <td><?php echo $usuario['documento']; ?></td>
               <td><?php echo $usuario['email']; ?></td>
               <td><?php echo $usuario['rol']; ?></td>
               <td>
               <form action="lista_usuarios/editar_usuario" method="GET">
                <!--<input type="hidden" name="action" value="">-->
                <input type="hidden" name="id" value="<?php echo $usuario[
                    'id'
                ]; ?>">
                <input type="submit" value="Editar">
                </td>
                
                <td>
               </form>
                <form action="lista_usuarios/borrar_usuario" method="POST">
                <input type="hidden" name="action" value="borrar_usuario">
                <input type="hidden" name="id" value="<?php echo $usuario[
                    'id'
                ]; ?>">
                <input type="submit" value="Borrar">
                </form>
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
