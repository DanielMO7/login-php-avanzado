<?php
// Verifica si existe una session, si no exsite la crea  si ya existe no la crea.
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
if (isset($_SESSION['token'])) {
    
    // Muestra un mensaje en caso de que exista alun error o inconveniente.
    if (isset($mensaje)) {
        echo $mensaje;
    }

    /**
     * Se invoca Una funcion que permite traer los datos del usuario que se desea actualizar.
     */
    require_once '././Controllers/UsuarioController.php';
    $usuario = new UsuarioController();
    $resultados = $usuario->EditarUsuario($_GET['id']);

    foreach ($resultados as $resultado) { ?> 
    <h2>Editar Perfil</h2>
    <form action="" method="POST">
        <input type="hidden" name="action" value="guardar_edicion_perfil">
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
        <button type="submit">Guardar</button>
        <button type="button" onclick="window.location.href='/login/index.php/perfil'">Cancelar</button>
    </form>
</div> 
<?php 
    }
} else {
    header('Location: /login/index.php/login');
}
?>