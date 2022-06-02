<div>
    <form action="index.php" method="POST">
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