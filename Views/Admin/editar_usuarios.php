<?php
session_start();
if(isset($_SESSION['rol']) and $_SESSION['rol'] == 'Administrador'){
    echo "Bienvenido ".$_SESSION['rol'] ." a la Editar Usuario.";

    require_once('././Controllers/AdminController.php');

    $usuario = new AdminController();
    $resultado = $usuario->EditarUsuario();
    echo $resultado;

?>
<input type="button" value="Iniciar Sesion" onclick="window.location.href='/login/index.php/login'"> 
    <form action="" method="POST">
        <input type="hidden" name="action" value="insert">
        <label for="nombre" >Nombre: </label>
        <input type="text" name="nombre" placeholder="Escibra su Nombre" >              
        <br>
        <label for="documento">Documento: </label>
        <input type="number" name="documento" placeholder="Escibra su Documento" >              
        <br>
        <label for="email">Correo Electronico: </label>
        <input type="email" name="email" placeholder="Escriba su Correo Electronico">
        <br>
        <label for="contrasena">Contraseña: </label>
        <input type="pass" name="contrasena" placeholder="Escibra su Contraseña" >              
        <br>   
        <label for="rol">Rol: </label>
        <select name="rol">              
            <option value="Administrador">Administrador</option>
            <option value="Empleador">Usuario</option>
        </select>
        <br>
        <button type="submit">Guardar</button>
        <button type="">Cancelar</button>
    </form>
</div>  
<?php
}else{
    header("Location: /login/index.php/home");
}
?>