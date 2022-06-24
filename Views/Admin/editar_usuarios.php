<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/login/Public/styles/styles.css">
    <link rel="stylesheet" href="/login/Public/styles/styles-login.css">
    <link rel="stylesheet" href="/login/Public/styles/styles-admin.css">
    <link rel="stylesheet" href="/login/Public/styles/styles-resposive.css">
    <title>Cambiar Contraseña</title>
</head>

<body onload="datosUsuario(<?php echo $_GET['id']?>)">
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
                            <a href="/login/index.php/lista_usuarios">
                                <li>Lista Usuarios</li>
                            </a>
                            <a href="/login/index.php/admin">
                                <li>Inicio</li>
                            </a>
                        </ul>
                    </nav>
                </div>
            </header>
            <!--Fin Cabecera-->

            <div class="contenido-admin">
                <div class="content-admin">
                    <h1>Editar Usuario.</h1> <br>
                    <form id="formulario-perfil-usuario">
                        <h4>Nombre: </h4>
                        <input name="nombre_usuario" class="nombre_usuario" type="text" placeholder="">
                        <br>
                        <h4>Documento: </h4>
                        <input name="documento" class="documento" type="number" placeholder="">
                        <br>
                        <span id="mensaje-error-documento" class="mensaje-error">El documento que ingresaste ya se encuentra registrado.</span>
                        
                        <h4>Correo Electronico: </h4>
                        <input name="email" class="email" type="email" placeholder="">
                        <br>
                        <span id="mensaje-error-email" class="mensaje-error">El email que ingresaste ya se encuentra registrado.</span>
                        
                        <h4>Rol: </h4>
                        <select name="rol" class="rol" placeholder="">
                            <option value="Administrador">Administrador</option>
                            <option value="Empleado">Empleado</option>
                        </select>
                        <br>
                        <span id="mensaje-ok" class="mensaje-ok">Datos guardados Correctamente.</span>
                        <button onclick="guardarEdicionUsuario(<?php echo $_GET['id']?>)" class="lista-user-boton" type="button" value="Guardar">Guardar</button>
                        <button class="lista-user-boton" onclick="cancelarEdicionUsuario()" type="button" value="Cancelar">Cancelar</button>
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
    </div>
    <!--Fin Container.-->
    <script src="/login/Services/admin.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

</body>

</html>