<?php
session_start();
if (isset($_SESSION['token'])) {
    echo 'Estas Logueado ' . $_SESSION['rol'];
} else {
    header('Location: /login/index.php/login');
} ?>

<input type="button" value="Cerrar Sesion" onclick="window.location.href='/login/index.php?action=cerrar_sesion'"> 
<input type="button" value="Ver Perfil" onclick="window.location.href='/login/index.php/perfil'"> 

<?php
if ($_SESSION['rol'] == "Administrador" ){
?>
<input type="button" value=" Ver Lista de Usuarios" onclick="window.location.href='/login/index.php/lista_usuarios'"> 
<?php
}
?>