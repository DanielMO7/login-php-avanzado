<?php
// Verifica si existe una session, si no exsite la crea  si ya existe no la crea.
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="e">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/login/Public/styles/styles.css">
    <link rel="stylesheet" href="/login/Public/styles/styles-login.css">
    <link rel="stylesheet" href="/login/Public/styles/styles-resposive.css">
    <title>Inicio</title>
</head>

<body onload="mostrarDatosUsuario()">
    <!--Inicio Container.-->
    <div id="container">
        <!---Inicio Cabecera-->
        <header id="header">
            <div class="logo">
                <div class="logo-bilioteca">
                    <h2>Z</h2>
                </div>
                <a href="/login/index.php/home">
                    <h1>BIBLIOTECA</h1>
                </a>
            </div>

            <nav id="menu">
                <ul class="center">
                    <li>
                        <a href="/login/index.php/home">Inicio</a>
                    </li>
                    <li>
                        <a href="/login/index.php/cerrar_sesion">Cerrar Sesión</a>
                    </li>

                </ul>
            </nav>
        </header>
        <!--Fin Cabecera-->

        <div id="contenedor-principal">
            <div class="contenido_perfil">
                <div class="titulo">
                    <h2>Bienvenido a tu Perfil.</h2>
                </div>
                <div class="contenido">
                    <table>
                        <thead>
                            <tr>
                                <td>Nombre</td>
                                <td>Documento</td>
                                <td>Email</td>
                                <td>Rol</td>
                            </tr>
                        </thead>
                        <tbody id="formulario-usuario-script" class="fila-tabla-usuario" >
                            <tr>
                                
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="botones-perfil">
                    
                    <input type="submit" value="Editar" class="boton-perfil" onclick="VistaEditarUsuario(<?php echo $_SESSION['Usuario'] ?>)">
                    <input type="submit" value="Cambiar Contraseña" class="boton-perfil" onclick="VistaCambiarContasena()">
                </div>
            </div>
        </div>

        <!--Fin Container.-->

        <!--Inicio Footer-->
        <footer id="footer">
            <div class="wrap">
                <div id="menu_footer">
                    <h5>MENU</h5>
                    <ul>
                        <li><a href="#">Inicio</a></li>
                    </ul>
                </div>
            </div>
            <div class="wrap">
                <div id="location">
                    <h5>¿Donde Estamos?</h5>
                    <!--<iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15903.09632723943!2d-75.70333510637286!3d4.808810295231943!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e388746c2e5d171%3A0xdfec04a31a4c133!2sGobernaci%C3%B3n%20De%20Risaralda!5e0!3m2!1ses!2sco!4v1655237041095!5m2!1ses!2sco"
                        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>-->

                </div>
            </div>
            <div class="wrap">
                <div id="info">
                    <h5>AUTOR</h5>
                    <p>&copy; Daniel Mendez </p>
                </div>
            </div>
        </footer>
        <!--Fin footer-->

    <script src="/login/Services/axios.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

</body>

</html>