<?php
// Verifica si existe una session, si no exsite la crea  si ya existe no la crea.
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
if (isset($_SESSION['token'])) {

    // Muestra un mensaje en caso de que exista.
    if (isset($mensaje)) {
        echo $mensaje;
    }

?>  
    <h2>Cambiar Contrasena</h2>
    <form action="" method="POST">
        <input type="hidden" name="action" value="guardar_contrasena">
        <label for="contrasena_anterior" >Contraseña Anterior: </label>
        <input type="password" name="contrasena_anterior" value="<?php ?>" placeholder="Escibra su Contraseña anterior" >              
        <br>
        <label for="contrasena_nueva">Nueva Contraseña: </label>
        <input type="password" name="contrasena_nueva" value="<?php  ?>" placeholder="Escibra su Nueva Contraseña" >              
        <br>
        <label for="contrasena_verificar">Verificar Contraseña: </label>
        <input type="password" name="contrasena_verificar" value="<?php  ?>" placeholder="Escibra de nuevo su Nueva Contraseña" >              
        <br>
        <button type="submit">Guardar</button>
        <button type="button" onclick="window.location.href='/login/index.php/perfil'">Cancelar</button>
    </form>
</div> 
<?php 
}else {
    header('Location: /login/index.php/login');
}
?>