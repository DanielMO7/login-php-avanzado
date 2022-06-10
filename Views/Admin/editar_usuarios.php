<?php
// Verifica si existe una session, si no exsite la crea  si ya existe no la crea.
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

/**
 * Verifica que el rol del usuario sea administrador para que pueda acceder a esta vista.
 */
if (isset($_SESSION['rol']) and $_SESSION['rol'] == 'Administrador') {
    echo '<h2>Bienvenido ' . $_SESSION['rol'] . ' a Editar Usuario.</h2>';
    
    // Muestra un mensaje en caso de que exista.
    if (isset($mensaje)) {
        echo $mensaje;
    }

    /**
     * Se invoca Una funcion que permite traer los datos del usuario que se desea actualizar.
     */
    require_once '././Controllers/AdminController.php';
    $usuario = new AdminController();
    $resultados = $usuario->EditarUsuario($_GET['id']);

    foreach ($resultados as $resultado) { ?> 
    <form action="editar_usuario/guardar_edicion_usuarios" method="POST">
        <input type="hidden" name="action" value="guardar_edicion_usuarios">
        <input type="hidden" name="id" value="<?php echo $resultado['id']?>">
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
        <button type="button" onclick="window.location.href='/login/index.php/lista_usuarios'">Cancelar</button>
    </form>
</div>  
<?php }
} else {
    header('Location: /login/index.php/home');
}
?>
