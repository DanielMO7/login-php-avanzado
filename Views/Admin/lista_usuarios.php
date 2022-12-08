<?php
// Verifica si existe una session, si no exsite la crea  si ya existe no la crea.
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
} ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Public/styles/styles.css">
    <link rel="stylesheet" href="/Public/styles/styles-login.css">
    <link rel="stylesheet" href="/Public/styles/styles-admin.css">
    <link rel="stylesheet" href="/Public/styles/styles-resposive.css">

    <title>Cambiar Contraseña</title>
</head>

<body onload="obtenerUsuarios()">
    <!--Inicio Container.-->
    <div id="container-admin">
        <div id="container-admin-box">
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
                            <a href="/index.php/lista_usuarios">
                                <li>Lista Usuarios</li>
                            </a>
                            <a href="/index.php/admin">
                                <li>Inicio</li>
                            </a>
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

                                </tr>
                            </thead>
                            <tbody id="formulario-usuarios-script" class="fila-tabla-usuario-admin">
                                <tr>

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
        </footer>
        <!--Fin footer-->
        <!--Fin Container.-->
    </div>
    <script src="/Services/admin.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

</body>

</html>