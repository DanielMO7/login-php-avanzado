<?php
// Verifica si existe una session, si no exsite la crea  si ya existe no la crea.
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
if (isset($_SESSION['token'])) {

    /**
     * Invoca el controlador de usuarios y ejecuta una funcion para mostrar los datos del usuario.
     */
    require_once '././Controllers/UsuarioController.php';
    $usuarios = new UsuarioController();
    $resultados = $usuarios->GuardarInfoListaUsuario();


    echo "<h2> Bienvenido ".$_SESSION['Nombre']." este es tu perfil.<h2>";

?>
<h1></h1>
<table>
    <thead>
        <tr>
            <td>Nombre</td>
            <td>Documento</td>
            <td>Email</td>
            <td>Rol</td>
        </tr>
    </thead>
    <tbody>
        <tr>

        </tr>
    </tbody>
        <?php foreach ($resultados as $usuario) { ?>
               <tr>
               <td><?php echo $usuario['nombre_usuario']; ?></td>
               <td><?php echo $usuario['documento']; ?></td>
               <td><?php echo $usuario['email']; ?></td>
               <td><?php echo $usuario['rol']; ?></td>
               <td>
               <form action="" method="GET">
                <input type="hidden" name="action" value="editar_perfil">
                <input type="hidden" name="id" value="<?php echo $usuario[
                    'id'
                ]; ?>">
                <input type="submit" value="Editar">
               </form>
                </td>
                <td>
                <form action="" method="GET">
                <input type="hidden" name="action" value="cambiar_contrasena">
                <input type="hidden" name="id" value="<?php echo $usuario[
                    'id'
                ]; ?>">
                <input type="submit" value="Cambiar Contraseña">
                </td>
               </tr>
    </tbody>
</table>
<?php }
}else {
    header('Location: /login/index.php/login');
}?>