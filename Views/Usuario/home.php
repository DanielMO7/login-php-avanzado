<?php
// Verifica si existe una session, si no exsite la crea  si ya existe no la crea.
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
// Verifca si exsite el token.

?>
<!DOCTYPE html>
<html lang="e">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/login/Public/styles/styles.css">
    <link rel="stylesheet" href="/login/Public/styles/styles-resposive.css">

    <title>Inicio</title>
</head>

<body>

    <!--Inicio Container.-->
    <div id="container">
        <!---Inicio Cabecera-->
        <header id="header">
            <div class="logo">
                <div class="logo-bilioteca">
                    <h2>Z </h2>
                </div>
                <a href="/login/index.php/home">
                    <h1>BIBLIOTECA</h1>
                </a>
            </div>

            <nav id="menu">
                <ul>
                    <li>
                        <a href="/login/index.php/home">Inicio</a>
                    </li>
                    <?php if(isset($_SESSION['token']) == null){?>
                    <li>
                        <a href="/login/index.php/login">Ingresar</a>
                    </li>
                    <li>
                        <a href="/login/index.php/register">Registrarce</a>
                    </li>
                    <?php }else if($_SESSION['token']){?>
                    <li>
                        <a href="/login/index.php/perfil">Perfil</a>
                    </li>
                    <?php }?>
                </ul>
            </nav>
        </header>
        <!--Fin Cabecera-->

        <!--Inicio banner-->
        <div id="banner">
            <h1>"Una biblioteca no es un lujo, sino una de las necesidades de la vida." Henry Ward Beecher.</h1>
        </div>
        <!--Fin banner-->

        <!--Inicio articulos-->
        <div id="content">
            <div class="cards">
                <h2>Ultimos articulos</h2>
                <div class="card">
                    <article>
                        <div class="data">
                            <span>Fecha: 12 dic</span>
                            <span>Categoria: Pruebas</span>
                        </div>
                        <h4>
                            <a href="#">Titulo del articulo</a>
                        </h4>
                        <p>
                            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Repellendus, ipsa delectus
                            asperiores
                            assumenda vel dolore rem provident amet fugiat et enim veniam natus saepe culpa quia earum
                            suscipit
                            dolorem consectetur.
                            Officia fugiat ad optio aut sunt natus recusandae distinctio provident numquam enim. Culpa,
                            architecto consequatur possimus quasi quis harum dignissimos maxime perferendis debitis
                            mollitia
                            suscipit excepturi, explicabo, autem at fugiat!
                            Harum tenetur, aliquid magni nihil unde, similique quis sit sapiente incidunt itaque velit
                            perferendis numquam id consequatur perspiciatis inventore voluptatum eaque accusamus nostrum
                            odit
                            error sequi dolores debitis asperiores. Perspiciatis!y
                        </p>
                    </article>
                </div>
                <div class="card">
                    <article>
                        <div class="data">
                            <span>Fecha: 12 dic</span>
                            <span>Categoria: Pruebas</span>
                        </div>
                        <h4>
                            <a href="#">Titulo del articulo</a>
                        </h4>
                        <p>
                            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Repellendus, ipsa delectus
                            asperiores
                            assumenda vel dolore rem provident amet fugiat et enim veniam natus saepe culpa quia earum
                            suscipit
                            dolorem consectetur.
                            Officia fugiat ad optio aut sunt natus recusandae distinctio provident numquam enim. Culpa,
                            architecto consequatur possimus quasi quis harum dignissimos maxime perferendis debitis
                            mollitia
                            suscipit excepturi, explicabo, autem at fugiat!
                            Harum tenetur, aliquid magni nihil unde, similique quis sit sapiente incidunt itaque velit
                            perferendis numquam id consequatur perspiciatis inventore voluptatum eaque accusamus nostrum
                            odit
                            error sequi dolores debitis asperiores. Perspiciatis!y
                        </p>
                    </article>
                </div>
            </div>
            <!--Fin acticulos-->
        </div>
        <!--Fin Container.-->

        <!--Inicio Footer-->
        <footer id="footer">
            <div class="wrap">
                <div id="menu_footer">
                    <h5>MENU</h5>
                    <ul>
                        <li><a href="#">Inicio</a></li>
                        <li><a href="#">Ingresar</a></li>
                        <li><a href="#">Registrarce</a></li>
                    </ul>
                </div>
            </div>
            <div class="wrap">
                <div id="location">
                    <h5>¿Donde Estamos?</h5>
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15903.09632723943!2d-75.70333510637286!3d4.808810295231943!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e388746c2e5d171%3A0xdfec04a31a4c133!2sGobernaci%C3%B3n%20De%20Risaralda!5e0!3m2!1ses!2sco!4v1655237041095!5m2!1ses!2sco"
                        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>

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


</body>
</html>