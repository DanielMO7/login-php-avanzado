<?php
session_start();
/**
 * Verifica que el rol del usuario sea administrador para que pueda acceder a esta vista.
 */
if (isset($_SESSION['rol']) and $_SESSION['rol'] == 'Administrador') {
    echo 'Bienvenido ' . $_SESSION['rol'] . ' a la ventana de Administracion.';
} else {
    header('Location: /login/index.php/home');
}
?>
<input type="button" value=" Ver Lista de Usuarios" onclick="window.location.href='/login/index.php/lista_usuarios'"> 