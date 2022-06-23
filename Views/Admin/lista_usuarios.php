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
                <div class="banner-content">
                    <h1>Lista de Usuarios.</h1>
                </div>
                <div class="content-text">
                    <table class="tabla-admin">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Documento</th>
                                <th>Email</th>
                                <th>Rol</th>
                                <th>Accion</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="fila-tabla-usuario-admin">
                            <tr>
                                <td>
                                    Daniel Mendez
                                </td>
                                <td>
                                    1004668435
                                </td>
                                <td>
                                    dani019jorje@gmail.com
                                </td>
                                <td>
                                    Usuario
                                </td>
                                <td>
                                    <input class="lista-user-boton" type="submit" value="Editar">
                                    <input class="lista-user-boton" type="submit" value="Borrar">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Daniel Mendez
                                </td>
                                <td>
                                    1004668435
                                </td>
                                <td>
                                    dani019jorje@gmail.com
                                </td>
                                <td>
                                    Usuario
                                </td>
                                <td>
                                    <input class="lista-user-boton" type="submit" value="Editar">
                                    <input class="lista-user-boton" type="submit" value="Borrar">
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>

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