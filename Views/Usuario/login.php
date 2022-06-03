<?php
    if(isset($_SESSION['mensaje'])){
        echo $_SESSION['mensaje'];
    }
    if(isset($_SESSION['token'])){
        header("Location:/login/index.php/home");
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
        <input type="text" required name="contrasena" placeholder="Escibra su Contraseña" >              
        <br>
        <button type="submit">Iniciar Session</button>
    </form>
</div>