<?php
// Verifica si existe una session, si no exsite la crea  si ya existe no la crea.
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (isset($_SESSION['token'])) {
    header('Location:/login/index.php/home');
}
    // Muestra un mensaje en caso de que exista alun error o inconveniente.
    if (isset($mensaje)) {
        echo $mensaje;
    }
?>
<div>
<input type="button" value="Registrarce" onclick="window.location.href='/login/index.php/register'"> 
    <form action="" method="POST">
        <input type="hidden" name="action" value="loguearse">
        <label>Correo Electronico: </label>
        <input type="text" name="email" placeholder="Escriba su Correo Electronico">
        <br>
        <label>Contraseña: </label>
        <input type="password" required name="contrasena" placeholder="Escibra su Contraseña" >              
        <br>
        <button type="submit">Iniciar Session</button>
    </form>
</div>
