<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Public/styles/styles.css">
    <link rel="stylesheet" href="../../Public/styles/styles-login.css">
    <link rel="stylesheet" href="../../Public/styles/styles-admin.css">
    <link rel="stylesheet" href="../../Public/styles/styles-resposive.css">
    <title>Cambiar Contraseña</title>
</head>

<body>
    <!--Inicio Container.-->
    <div id="container-admin">
        <!---Inicio Cabecera-->
        <header id="header-admin">
            <div class="contenedor-header-admin">
                <div class="titulo-admin">
                    <a href="#">
                        <h1>BIBLIOTECA</h1>
                    </a>
                </div>
                <div class="logo-bilioteca logo-admin">
                    <h2>S</h2>
                </div>
                <nav id="menu-admin">
                    <ul>
                        <li>
                            <a href="#">Lista Usuarios</a>
                        </li>
                        <li>
                            <a href="#">Inicio</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </header>
        <!--Fin Cabecera-->

        <div class="contenido-admin">
            <div class="content-admin">
                <h1>Editar Usuario.</h1> <br>
                <form>
                    <h4>Nombre: </h4>
                    <input type="text">
                    <br>
                    <h4>Documento: </h4>
                    <input type="number">
                    <br>
                    <h4>Correo Electronico: </h4>
                    <input type="email">
                    <br>
                    <h4>Rol: </h4>
                    <select>
                        <option value="Administrador">Administrador</option>
                        <option value="Empleado">Empleado</option>
                    </select>
                    <br>
                    <button class="lista-user-boton" type="submit" value="Guardar">Guardar</button>
                    <button class="lista-user-boton" type="submit" value="Cancelar">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
    <!--Inicio Footer-->
    <footer id="footer-admin">
        <h5>AUTOR &copy; Daniel Mendez</h5>
        </div>
        </div>
    </footer>
    <!--Fin footer-->
    <!--Fin Container.-->



</body>

</html>