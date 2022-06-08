<?php
// Verifica si existe una session, si no exsite la crea  si ya existe no la crea.
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
/**
 * Verifica que el rol del usuario sea administrador para que pueda acceder a esta vista.
 */
if (isset($_SESSION['rol']) and $_SESSION['rol'] == 'Administrador') {
    echo '<h2>Bienvenido ' . $_SESSION['rol'] . ' a la ventana de Administracion.</h2>';
} else {
    header('Location: /login/index.php/home');
}
?>
<input type="button" value=" Ver Lista de Usuarios" onclick="window.location.href='/login/index.php/lista_usuarios'"> 