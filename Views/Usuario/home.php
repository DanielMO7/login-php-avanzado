<?php
// Verifica si existe una session, si no exsite la crea  si ya existe no la crea.
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
// Verifca si exsite el token.
if (isset($_SESSION['token'])) {
    echo 'Estas Logueado ' . $_SESSION['rol'];
} else {
    header('Location: /login/index.php/login');
} ?>

<input type="button" value="Cerrar Sesion" onclick="window.location.href='/login/index.php?action=cerrar_sesion'"> 
<input type="button" value="Ver Perfil" onclick="window.location.href='/login/index.php/perfil'"> 

<?php

// Evalua si el usuario es administrador para que pueda ir a la vista de administracion.
if ($_SESSION['rol'] == "Administrador" ){
?>
<input type="button" value=" Ver Lista de Usuarios" onclick="window.location.href='/login/index.php/lista_usuarios'"> 
<?php
}
?>