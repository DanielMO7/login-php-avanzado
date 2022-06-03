<?php

    if(isset($_SESSION['token'])){
        echo 'Estas Logueado '.$_SESSION['rol'];
    }else{
        header('Location: /login/index.php/login');
    }
?>

<input type="button" value="cerrar sesion" onclick="window.location.href='/login/index.php?action=cerrar_sesion'"> 