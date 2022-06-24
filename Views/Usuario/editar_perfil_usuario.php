<?php
// Verifica si existe una session, si no exsite la crea  si ya existe no la crea.
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/login/Public/styles/styles.css">
    <link rel="stylesheet" type="text/css" href="/login/Public/styles/styles-login.css">
    <link rel="stylesheet" type="text/css" href="/login/Public/styles/styles-resposive.css">
    <title>Editar Perfil</title>
</head>

<body onload="datosUsuario(<?php echo $_SESSION['Usuario']?>)">
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
                <ul>
                    <li>
                        <a href="#">Inicio</a>
                    </li>
                </ul>
            </nav>
        </header>
        <!--Fin Cabecera-->
        <div id="formulario">

            <div class="contenedor-formularios">
                <div id="editar-title" class="titulo">
                    <h5>Editar Perfil.</h5>
                </div>
                <div class="formulario-contenido">
                    <form id="formulario-perfil-usuario" class="content">
                        <div class="contents">
                            <h2>Nombre: </h2><br>
                            <input name="nombre_usuario" class="nombre_usuario" id="register" type="text" placeholder="Escibra su Nombre">
                        </div>
                        <br>
                        <div class="contents">
                            <h2>Documento: </h2><br>
                            <input name="documento" id="register" type="number" placeholder="Escibra su Numero de Documento">
                            <span id="mensaje-error-documento" class="mensaje-error">El documento que ingresaste ya se encuentra registrado.</span>
                        </div>
                        <br>
                        <div class="contents">
                            <h2>Correo Electronico:</h2><br>
                            <input name="email" id="register" type="email" placeholder="Escriba su Correo Electronico">
                            <span id="mensaje-error-email" class="mensaje-error">El email que ingresaste ya se encuentra registrado.</span>
                        </div>
                        <br>
                        <span id="mensaje-ok" class="mensaje-ok">Datos guardados Correctamente.</span>
                        <button type="button" onclick="guardarEdicion(<?php echo $_SESSION['Usuario']?>)">Guardar</button>
                        <button type="button" onclick="cancelarEdicionPerfil()">Cancelar</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="espacio">

        </div>
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
    </div>
    <!--Fin Container.-->

    <script src="/login/Services/axios.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

</body>

</html>