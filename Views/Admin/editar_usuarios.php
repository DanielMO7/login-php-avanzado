<?php
// Verifica si existe una session, si no exsite la crea  si ya existe no la crea.
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

/**
 * Verifica que el rol del usuario sea administrador para que pueda acceder a esta vista.
 */
if (isset($_SESSION['rol']) and $_SESSION['rol'] == 'Administrador') {
    echo 'Bienvenido ' . $_SESSION['rol'] . ' a la Editar Usuario.';
    if (isset($mensaje)) {
        echo $mensaje;
    }

    require_once '././Controllers/AdminController.php';

    /**
     * Se invoca Una funcion que permite traer los datos del usuario que se desea actualizar.
     */
    $usuario = new AdminController();
    $resultados = $usuario->EditarUsuario($_GET['id']);

    foreach ($resultados as $resultado) { ?> 
    <form action="" method="POST">
        <input type="hidden" name="action" value="guardar_edicion_usuarios">
        <label for="nombre" >Nombre: </label>
        <input type="text" name="nombre" value="<?php echo $resultado[
            'nombre_usuario'
        ]; ?>" placeholder="Escibra su Nombre" >              
        <br>
        <label for="documento">Documento: </label>
        <input type="number" name="documento" value="<?php echo $resultado[
            'documento'
        ]; ?>" placeholder="Escibra su Documento" >              
        <br>
        <label for="email">Correo Electronico: </label>
        <input type="email" name="email" value="<?php echo $resultado[
            'email'
        ]; ?>" placeholder="Escriba su Correo Electronico">
        <br>
        <label for="rol">Rol: </label>
        <select name="rol">              
            <option value="Administrador">Administrador</option>
            <option value="Empleado">Empleado</option>
        </select>
        <br>
        <button type="submit">Guardar</button>
        <button type="button">Cancelar</button>
    </form>
</div>  
<?php }
} else {
    header('Location: /login/index.php/home');
}
?>
