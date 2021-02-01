<!--suppress HtmlUnknownAnchorTarget --><!--suppress HtmlFormInputWithoutLabel -->
<!--suppress HtmlFormInputWithoutLabel -->
<html lang="es">
<?php

require_once('header.php');
require_once('config.php');

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once('navbar.php');
$corregir = false;
$mensajeError = "";
$mensajeError2 = "";
$error = 1;
$error2 = 1;

if (isset($_POST['submit'])) {
    $nombre = $_POST['nombre'];
    $altura = $_POST['altura'];
    $peso = $_POST['peso'];
    $longitud = $_POST['longitud'];
    $velocidad = $_POST['velocidad'];
    $poder = $_POST['poder'];
    $img = $_FILES['imganimal']['name'];
    $alturamag = $_POST['alturamag'];
    $pesomag = $_POST['pesomag'];
    $longitudmag = $_POST['longitudmag'];
    $velocidadmag = $_POST['velocidadmag'];
    $descripcion = $_POST['mensaje'];

    $q = "select * from carta where name = :nombre";

    /** @var PDO $con */
    $s = $con->prepare($q);
    $s->execute(array("nombre" => $nombre));

    if (empty($nombre) || $nombre == "Nombre de la carta / Elefante (primera letra mayúscula) *" || empty($altura) || $altura == "Altura *" ||
        empty($peso) || $peso == "Peso *" || empty($longitud) || $longitud == "Longitud *" ||
        empty($velocidad) || $velocidad == "Velocidad *" || empty($poder) || $poder == "Poder mortífero (1-10) *") {
        $mensajeError = "Los campos con * son requeridos...";
        $error = 1;
        $corregir = false;
        echo "No haga trampas y revise los campos";
        //        echo "<span class='error' style='text-align: center;margin: 0 auto;color:red;font-weight: bold;'>Debes rellenar todos los campos</span>";
    } elseif (empty($img)) {
        $mensajeError = "Debes de añadir una imagen";
        $error = 1;
        $corregir = false;
        echo "No haga trampas y revise los campos (valor erróneo imagen)";
        //        echo "<span class='error' style='text-align: center;margin: 0 auto;color:red;font-weight: bold;'>Debes añadir una imagen</span>";
    } elseif (!is_numeric($altura) || !is_numeric($peso) || !is_numeric($longitud) || !is_numeric($velocidad) || !is_numeric($poder)) {
        $mensajeError = "Revisa los campos, hay algún dato incorrecto";
        $error = 1;
        $corregir = false;
        echo "Los campos no son numéricos";
        //        echo "<span class='error'>Lo sentimos hay un error en alguno de los campos requeridos</span>";
    } elseif ($poder < 0 || $poder > 10) {
        $mensajeError = "El poder tiene que estar entre 0 y 10";
        $error = 1;
        $corregir = false;
        echo "El poder tiene que estar entre 1 y 10";
        //        echo "<span class='error'>El poder debe ser un valor comprendido entre 0 y 10</span>";
    } elseif (!empty($s->fetch(PDO::FETCH_ASSOC))) {
        $mensajeError2 = "Esta carta ya existe en la base de datos";
        $error2 = 1;
        //        header("Location: http://localhost:63342/pruebagitweb/index.php#slide-4");
    } else {
        if ($descripcion == "Escriba una pequeña descripción de no más de 300 caracteres") {
            $descripcion = "Esta carta no contiene descripción";
        }
        $mensajeError = "La carta se ha subido satisfactoriamente";
        $error = 0;
        $error2 = 0;

        $sql = "insert into carta values(null, :imagen, :nombre, :descripcion  )";
        $stmt = $con->prepare($sql);

        $stmt->execute(array(":nombre" => $nombre, ":descripcion" => $descripcion, ":imagen" => $img));


        $query = "select id from carta where name = :nombre";
        $st = $con->prepare($query);
        $st->execute(array(":nombre" => $nombre));
        $rs = $st->fetch(PDO::FETCH_ASSOC);
        $id = $rs['id'];
        //Altura
        $sql = "insert into pregunta values(null, :idcarta, :pregunta, :respuesta, :magnitud  ) ";
        $stmt = $con->prepare($sql);
        $stmt->execute(array(":idcarta" => $id, ":pregunta" => 'altura', ":respuesta" => $altura, ":magnitud" => $alturamag));
        //Peso
        $sql = "insert into pregunta values(null, :idcarta, :pregunta, :respuesta, :magnitud ) ";
        $stmt = $con->prepare($sql);
        $stmt->execute(array(":idcarta" => $id, ":pregunta" => 'peso', ":respuesta" => $peso, ":magnitud" => $pesomag));
        //Longitud
        $sql = "insert into pregunta values(null, :idcarta, :pregunta, :respuesta, :magnitud ) ";
        $stmt = $con->prepare($sql);
        $stmt->execute(array(":idcarta" => $id, ":pregunta" => 'longitud', ":respuesta" => $longitud, ":magnitud" => $longitudmag));
        //Velocidad
        $sql = "insert into pregunta values(null, :idcarta, :pregunta, :respuesta, :magnitud ) ";
        $stmt = $con->prepare($sql);
        $stmt->execute(array(":idcarta" => $id, ":pregunta" => 'velocidad', ":respuesta" => $velocidad, ":magnitud" => $velocidadmag));
        //Poder
        $sql = "insert into pregunta values(null, :idcarta, :pregunta, :respuesta, :magnitud  ) ";
        $stmt = $con->prepare($sql);
        $stmt->execute(array(":idcarta" => $id, ":pregunta" => 'poder', ":respuesta" => $poder, ":magnitud" => ""));

        if ((move_uploaded_file($_FILES['imganimal']['tmp_name'], "img/" . $img))) {
            echo "";
        }
    }
}
?><!--suppress HtmlUnknownAnchorTarget --><!--suppress HtmlFormInputWithoutLabel -->
<!--suppress HtmlFormInputWithoutLabel -->
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">
    <!-- Ban -->
    <div class="slide story" id="slide-1" xmlns="http://www.w3.org/1999/html">
        <div id="content">
            <div id="slider">
                <img src="images/newImages/wallpaper2.jpg" alt="Animales" data-url="#">
                <img src="images/newImages/wallpaper1.jpg" alt="Salvajes" data-url="#">
                <img src="images/newImages/wallpaper3.jpg" alt="<->" data-url="#">
                <img src="images/newImages/wallpaper4.jpg" alt="Top" data-url="#">
                <img src="images/newImages/wallpaper5.jpg" alt="Trump" data-url="#">
                <img src="images/newImages/wallpaper6.jpg" alt="Game" data-url="#">
            </div>
        </div>
    </div>
    <!-- About Us -->
    <section class="about-us slideanim" id="about">
        <div class="container">
            <div class="row">
                <div class="col-sm-7">
                    <div class="about-details">
                        <h3 class="slideanim">Team Biscochito</h3>
                        <p class="p1 slideanim">Al ejecutar por primera vez la aplicación se introduce una clave de
                            acceso para entrar al modo de administración en el cuál la clave se pondrá solo y una única
                            vez.<b> Por lo cuál anote bien la clave</b> ya que no la podrá actualizar al menos en esta
                            versión.</p>
                        <p class="p2 slideanim">A continuación, se pueden definir los diferentes jugadores que van a
                            participar en el juego (se necesita saber la clave de administrador para administrar a los
                            propios jugadores), para ello se introduce el nombre del jugador y se selecciona de entre
                            una serie de iconos de avatares disponibles. En posteriores ejecuciones de nuestra
                            aplicación
                            saldrá en la pantalla inicial la lista de jugadores con su avatar, para que el propio
                            jugador
                            pueda seleccionar con qué personaje se inicia el juego. A través del menú también se podrá
                            entrar en modo administración, para lo cual se tendrá que introducir la clave de
                            administración
                            que se puso anteriormente al instalar <b>Animales Salvajes</b> por primera vez.</p>
                        <p class="p3 slideanim">Habrá una pantalla de menú como indicamos en la imagen donde podrás ver
                            características de tu perfil, acceder a un pequeño tutorial, etc.</p>
                        <p class="p4 slideanim">En el juego se mostrará la carta del animal y se le harán las preguntas
                            correspondientes sobre este con 4 opciones a elegir, donde una será la correcta. Se tendrá
                            en
                            cuenta el número de respuestas y el número de aciertos. Podrá responder preguntas hasta que
                            el
                            usuario quiera salir.</p>
                        <p class="p5 slideanim">Por último, en el modo de administración, se pueden crear nuevos
                            jugadores,
                            editar los existentes y crear, editar y borrar cartas con sus preguntas. También se podrá
                            importar un conjunto de cartas con sus preguntas desde esta <b>página web</b> que se debe
                            especificar y que devolverá como respuesta una cadena en formato JSON con toda la
                            información
                            necesaria.</p>
                    </div>
                </div>
                <div class="col-sm-5">
                    <ul class="grid cs-style-5">
                        <li>
                            <figure>
                                <img src="images/newImages/ourWork.png" alt="about-us"
                                     class="img-responsive slideanim">
                                <figcaption>
                                    <h4>Aplicación en nuestro móvil</h4>
                                    <h5>¡ Animales - Salvajes !</h5>
                                    <br>
                                    <h6>¡ COMPLETAMENTE GRATUITO !</h6>
                                </figcaption>
                            </figure>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- /About Us -->
    <!-- === Slide 2 === -->
    <div class="slide story" id="slide-2">
        <section class="our-work slideanim">
            <h3 class="text-center slideanim">Desarrollo del juego</h3>
            <div class="container">
                <hr>
            </div>
            <p class="text-center slideanim">Animales Salvajes - Progreso de todo el desarrollado - Open Source
                Github</p>
            <div class="container-fluid">
                <div class="demo-wrapper" id="subeArriba">
                    <ul class="portfolio-items">
                        <li class="item">
                            <figure>
                                <div class="view"><img src="images/newImages/teambiscochito.jpg" alt=""/></div>
                                <figcaption>
                                    <p><span><a style="cursor:pointer;">Inicio de proyecto</a></span></p>
                                    <p><span>Reunión de miembros</span></p>
                                </figcaption>
                            </figure>
                            <div class="date" style="width: 30%">2020-12-04</div>
                        </li>
                        <li class="item">
                            <figure>
                                <div class="view"><img src="images/newImages/grupo.jpg" alt=""/></div>
                                <figcaption>
                                    <p><span><a style="cursor:pointer;">Reunión de grupo</a></span></p>
                                    <p><span>Grupo completo</span></p>
                                </figcaption>
                            </figure>
                            <div class="date" style="width: 30%">2020-12-15</div>
                        </li>
                        <li class="item">
                            <figure>
                                <div class="view"><img src="images/newImages/ourWork2.png" alt=""/></div>
                                <figcaption>
                                    <p><span><a href="https://github.com/TeamBiscochito" target="_blank">Inicio de App / Repositorio</a></span>
                                    </p>
                                    <p><span>Team Biscochito</span></p>
                                </figcaption>
                            </figure>
                            <div class="date" style="width: 30%">2020-12-30</div>
                        </li>
                        <li class="item">
                            <figure>
                                <div class="view"><img src="images/newImages/ourWork3.png" alt=""/></div>
                                <figcaption>
                                    <p>
                                        <span><a href="https://github.com/TeamBiscochito/proyectofinal/releases/tag/v0.0.1"
                                                 target="_blank">Primera versión v0.0.1</a></span></p>
                                    <p><span>Animales Salvajes</span></p>
                                </figcaption>
                            </figure>
                            <div class="date" style="width: 30%">2021-01-13</div>
                        </li>
                        <li class="item">
                            <figure>
                                <div class="view"><img src="images/newImages/ourWork4.png" alt=""/></div>
                                <figcaption>
                                    <p>
                                        <span><a href="https://github.com/TeamBiscochito/proyectofinal/releases/tag/v0.0.2"
                                                 target="_blank">Segunda versión v0.0.2</a></span></p>
                                    <p><span>Animales Salvajes</span></p>
                                </figcaption>
                            </figure>
                            <div class="date" style="width: 30%">2021-01-15</div>
                        </li>
                        <li class="item">
                            <figure>
                                <div class="view"><img src="images/newImages/ourWork5.png" alt=""/></div>
                                <figcaption>
                                    <p>
                                        <span><a href="https://github.com/TeamBiscochito/proyectofinal/releases/tag/v0.0.5"
                                                 target="_blank">Tercera versión v0.0.5</a></span></p>
                                    <p><span>Animales Salvajes</span></p>
                                </figcaption>
                            </figure>
                            <div class="date" style="width: 30%">2021-01-21</div>
                        </li>
                        <li class="item">
                            <figure>
                                <div class="view"><img src="images/newImages/ourWork6.png" alt=""/></div>
                                <figcaption>
                                    <p>
                                        <span><a href="https://github.com/TeamBiscochito/proyectofinal/releases/tag/v0.0.7"
                                                 target="_blank">Cuarta versión v0.0.7</a></span></p>
                                    <p><span>Animales Salvajes</span></p>
                                </figcaption>
                            </figure>
                            <div class="date" style="width: 30%">2021-01-26</div>
                        </li>
                        <li class="item">
                            <figure>
                                <div class="view"><img src="images/newImages/ourWork7.png" alt=""/></div>
                                <figcaption>
                                    <p>
                                        <span><a href="https://github.com/TeamBiscochito/proyectofinal/releases/tag/v0.0.9"
                                                 target="_blank">Quinta versión v0.0.9</a></span></p>
                                    <p><span>Animales Salvajes</span></p>
                                </figcaption>
                            </figure>
                            <div class="date" style="width: 30%">2021-01-29</div>
                        </li>
                    </ul>
                </div>
            </div><!-- /container -->
        </section>
    </div><!-- /slide2 -->
    <!-- Portfolio Section -->
    <!-- === Slide 3 - Portfolio -->
    <div class="slide story" id="slide-3" data-slide="3">
        <?php
        if (isset($_GET['pag'])) {
            $actual = $_GET['pag'];
            if ($actual < 1) {
                $actual = 1;
            }
        } else {
            $actual = 1;
        }

        // Hay que coger cuantas cartas hay para ver
        $sql = "select * from carta";

        /** @var PDO $con */
        $stmt = $con->prepare($sql);
        $stmt->execute();

        $consulta = "select COUNT(*) from carta";
        $statement = $con->prepare($sql);
        $statement->execute();

        $tuplas = $statement->rowCount();
        $pags = ceil($tuplas / 4);

        $sql = "select * from carta limit 4 offset " . (($actual - 1) * 4);
        $stmt = $con->prepare($sql);
        $stmt->execute();
        ?>
        <section class="gallery slideanim">
            <h3 class="text-center slideanim">Nuestra galería de cartas</h3>
            <div class="container">
                <hr>
            </div>
            <p class="text-center slideanim">Conjunto de todas las cartas que poseemos actualmente</p>
            <div class="container">
                <div class="im_wrapper2">
                    <?php
                    while ($resultset = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<div class='col-12 col-sm-6 col-lg-3'>";
                        echo "<div class=hoverEffect>";
                        $query = "select * from pregunta where card_id = :idcard";
                        $st = $con->prepare($query);
                        $st->execute(array(":idcard" => $resultset['id']));
                        echo "<img src=\"img/" . $resultset['picUrl'] . "\" class=imgPrueba alt=\"" . $resultset['picUrl'] . "\" >";
                        echo "<div class=overlay>";
                        echo '<h2 style="font-weight: bold">' . $resultset['name'] . '</h2>';
                        echo "<p>";
                        //                                echo '<p>' . $resultset['description'] . '</p>';
                        if ($st->rowCount() > 0) {
                            while ($rs = $st->fetch(PDO::FETCH_ASSOC)) {
                                echo "<p style='font-weight: bold'>" . "<span style='color: black'>" . ucfirst($rs['question']) . ":</span> " . $rs['answer'] . $rs['magnitude'] . " </p>";
                            }
                        }
                        echo "</p>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                    }
                    ?>
                </div>
            </div>
            <div class="divPaginas">
                <?php if ($actual == 1) {
                    echo "<span class='botonesPag'>Anterior</span>";
                } else {
                    echo "<a class='botonesPagActiva' href =" . $_SERVER['PHP_SELF'] . '?pag=' . ($actual - 1) . "#subeArriba>Anterior  </a>";
                }

                for ($i = 1; $i <= $pags; $i++) {
                    if ($i == $actual) {
                        echo "<span class='paginas'> " . $i . "  </span>";
                    } else {
                        echo "<a class='paginaActiva' href =" . $_SERVER['PHP_SELF'] . '?pag=' . ($i) . "#subeArriba> " . $i . "  </a>";
                    }
                }

                if ($actual == $pags) {
                    echo "<span class='botonesPag'>Siguiente</span>";
                } else {
                    echo "<a class='botonesPagActiva' href =" . $_SERVER['PHP_SELF'] . '?pag=' . ($actual + 1) . "#subeArriba>Siguiente</a>";
                }
                ?>
                <!--suppress CssUnusedSymbol -->
                <style>
                    .paginas {
                        margin: 5px;
                        padding: 10px;
                        background-color: white;
                        color: black;
                        border: 1px solid black;
                        border-radius: 56px;
                    }

                    .paginaActiva {
                        margin: 5px;
                        padding: 10px;
                        background-color: black;
                        color: #00ff21;
                        border: 1px solid black;
                        border-radius: 56px;
                    }

                    .botonesPag {
                        padding: 15px 30px;
                        margin: 5px 20px;
                        background-color: black;
                        color: white;
                        font-size: 21px;
                        text-decoration: none;
                    }

                    .botonesPagActiva {
                        padding: 15px 30px;
                        margin: 5px 20px;
                        background-color: black;
                        color: #00ff21;
                        font-size: 21px;
                        text-decoration: none;
                    }

                    .botonesPag:visited, .botonesPag:active, .botonesPag:link, .botonesPagActiva:visited, .botonesPagActiva:active, .botonesPagActiva:visited, .botonesPagActiva:link {
                        text-decoration: none;
                    }
                </style>
            </div>
        </section>
    </div><!-- /slide3 -->
    <!-- /Portfolio Section -->
    <!-- === Slide 4 - Process === -->
    <!-- Testimonial Section -->
    <div class="slide story" id="slide-4" data-slide="4">
        <section class="testimonials slideanim">
            <h3 class="text-center slideanim">¡ Reseñas de nuestros usuarios !</h3>
            <div class="container">
                <hr>
            </div>
            <p class="text-center slideanim">Últimas reseñas recibidas por parte de nuestros jugadores</p>
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-4 client-info">
                        <div class="testimonial slideanim">
                            <div class="test-info1">
                                <p class="test1 slideanim">Es un gran juego que a principios de su lanzamiento intenté
                                    jugar (sin internet) hasta que un dia se hizo popular. También es bastante divertido
                                    y tiene una interfaz con muuuy buena calidad me encantaría que ya sacaran alguna
                                    actualización para pulir algunos detalles. Incluso propondría un botón para poder
                                    cambiar la contraseña. Saludos Cordiales Jugador Satisfecho</p>
                            </div>
                            <div class="test-info2">
                                <img src="images/test-img1.png" alt="test-img" class="img-responsive slideanim">
                                <div class="test-details1 slideanim">
                                    <h4>Sara Hernández</h4>
                                    <p class="test2">Participante</p>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 client-info">
                        <div class="testimonial slideanim">
                            <div class="test-info1">
                                <p class="test1">Es uno de los mejores juegos que he probado, me parece que aprendes
                                    mucho sobre los animales y más a los niños que le puede enseñar una valiosa lección
                                    sobre todos los animales :) recomiendo un 90% porque poco a poco se vuelve muy
                                    repetitivo, tengo metido en este juego más de 200 horas pero en si, si quieres pasar
                                    un buen rato con tus amigos o hasta solos si se los recomiendo.</p>
                            </div>
                            <div class="test-info2">
                                <img src="images/test-img2.png" alt="test-img" class="img-responsive slideanim">
                                <div class="test-details2 slideanim">
                                    <h4>Jose Anotonio</h4>
                                    <p class="test2">Participante</p>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 client-info">
                        <div class="testimonial slideanim">
                            <div class="test-info1">
                                <p class="test1 slideanim">La verdad que es un juego muy entretenido, puedes pasar horas
                                    ahí y no te aburres, los servidores estan muy bien hechos, recomendado para niños,
                                    tienes que saber un poco sobre animales, y pues si hay un poco de fallas, y si
                                    pueden integrar mas cartas por defecto al juego estaría genial, todo el juego esta
                                    muy bien en sí. Para jugar con niños es super entretenido.</p>
                            </div>
                            <div class="test-info2" id="bajarParaAbajo">
                                <img src="images/test-img3.png" alt="test-img" class="img-responsive slideanim">
                                <div class="test-details3 slideanim">
                                    <h4>Jusep Almedina</h4>
                                    <p class="test2">Participante</p>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div><!-- /slide4 -->
    <!-- /Testimonial Section -->
    <!-- Pricing Tables -->
    <div class="slide story" id="slide-5" data-slide="5">
        <section class="pricing-table slideanim" id="Agregar">
            <h3 class="text-center slideanim" style="color: white">Añadir tus propias cartas</h3>
            <div class="container">
                <hr>
            </div>
            <p class="text-center slideanim" style="color: white; margin-bottom: 50px;">Aquí podrás subir tus propias
                cartas al juego, fíjate
                en las plantillas y
                rellena los datos</p>
            <div class="container">
                <div class="grid1 slideanim">
                    <span>Nombre de carta</span>
                    <h2 style="font-size: 21px; font-weight: bold">Ingrese - Poder mortífero</h2>
                    <div class="para">
                        <p>Se necesita - Altura</p>
                        <p>Se necesita - Peso</p>
                        <p>Se necesita - Longitud</p>
                        <p>Se necesita - Velocidad</p>
                        <p style="font-size: 14px">Descripción: <br>Breve descripción sobre el animal que quieres
                            añadir</p>
                    </div>
                    <div class="sign text-center">
                        <a>Añadir</a>
                    </div>
                </div>
                <div class="grid2 slideanim" id="imagenCarta">
                    <span>Elefante</span>
                    <h2 style="font-size: 26px; font-weight: bold">10</h2>
                    <div class="para" style="opacity: 1">
                        <p style="opacity: 1">3,5 metros (m)</p>
                        <p>6000 Kilos (kg)</p>
                        <p>5 metros (m)</p>
                        <p>40 km hora (km/h)</p>
                        <p style="font-size: 14px">Los elefantes son los mamíferos terrestres más grandes del planeta.
                            Su cuerpo es de color grisáceo y casi no presenta pelo. Poseen unas grandes orejas y una
                            larga trompa que utilizan para oler, comer...</p>
                    </div>
                    <div class="sign text-center">
                        <a class="popup-with-zoom-anim" href="#small-dialog">Añade tu carta</a>
                        <?php
                        if (isset($error2)) {
                            echo "<p class='error" . $error . "' style='color: red; margin-top: 20px; font-weight: bold;'>" . $mensajeError2 . '</p>';
                        }
                        ?>
                    </div>
                </div>
                <div class="grid3 slideanim">
                    <span>Plantilla en directo</span>
                    <h2 style="font-size: 21px; font-weight: bold">Ingrese - Poder mortífero</h2>
                    <div class="para">
                        <p>Ingresa - Altura</p>
                        <p>Ingrese - Peso</p>
                        <p>Ingrese - Longitud</p>
                        <p>Ingrese - Velocidad</p>
                        <p style="font-size: 14px">Descripción: <br>Breve descripción sobre el animal que quieres
                            añadir</p>
                    </div>
                    <div class="sign text-center">
                        <a>Añadir</a>
                    </div>
                </div>
                <p></p>
                <div class="clear"></div>
                <!--pop-up-grid-->
                <div id="popup">
                    <div id="small-dialog" class="mfp-hide slideanim" style="height: 750px">
                        <div class="pop_up" style="height: 100%">
                            <div class="payment-online-form-left" id="imganimal">
                                <!--suppress HtmlUnknownAnchorTarget -->
                                <form action="index.php#bajarParaAbajo" method="POST"
                                      enctype="multipart/form-data" href="#imagenCarta">
                                    <h4 style="display: flex;justify-content: space-around;"><span class="shipping"
                                                                                                   style="margin: 0;"> </span>Detalles
                                        de la carta<span class="shipping" style="margin: 0;"> </span></h4>
                                    <ul style="display: flex;justify-content: center;">
                                        <li style="width: 100%;display: flex;justify-content: center;">
                                            <input
                                                    class="text-box-dark" type="text" name="nombre" id="nombre"
                                                    value="Nombre de la carta / Elefante (primera letra mayúscula) *"
                                                    onfocus="if (this.value === 'Nombre de la carta / Elefante (primera letra mayúscula) *') {this.value = ''}"
                                                    onblur="if (this.value === '') {this.value = 'Nombre de la carta / Elefante (primera letra mayúscula) *';}"
                                                    style="margin: 0;width: 80%;text-align: center;"></li>
                                    </ul>
                                    <ul style="display: flex;justify-content: space-around;">
                                        <li style="display: flex;width: 100%;justify-content: space-around;"><input
                                                    class="text-box-dark" type="text" name="altura"
                                                    value="Altura (1-9999) *"
                                                    id="altura"
                                                    onfocus="if (this.value === 'Altura (1-9999) *') {this.value = ''}"
                                                    onblur="if (this.value === '') {this.value = 'Altura (1-9999) *';}"
                                                    style="width: 80%;text-align: center;margin: 2% 0;padding: 3%;">
                                        </li>
                                        <li style="display: flex;width: 100%;justify-content: space-around;"><select
                                                    name="alturamag"
                                                    style="color: #485460;width: 80%;margin: 0.5em 0 0.5em 0;-webkit-transition: border-color 0.3s;border: 1px solid #EEE;text-align: center">
                                                <option value="m">m</option>
                                                <option value="cm">cm</option>
                                            </select></li>
                                    </ul>

                                    <ul style="display: flex;justify-content: space-around;">
                                        <li style="display: flex;width: 100%;justify-content: space-around;"><input
                                                    class="text-box-dark" type="text" name="peso"
                                                    value="Peso (1-9999) *"
                                                    id="peso"
                                                    onfocus="if (this.value === 'Peso (1-9999) *') {this.value = ''}"
                                                    onblur="if (this.value === '') {this.value = 'Peso (1-9999) *';}"
                                                    style="width: 80%;text-align: center;margin: 2% 0;padding: 3%;">
                                        </li>
                                        <li style="display: flex;width: 100%;justify-content: space-around;"><select
                                                    name="pesomag"
                                                    style="color: #485460;width: 80%;margin: 0.5em 0 0.5em 0;-webkit-transition: border-color 0.3s;border: 1px solid #EEE;text-align: center">
                                                <option value="kg">kg</option>
                                                <option value="g">g</option>
                                                <option value="T">T</option>
                                            </select></li>
                                    </ul>

                                    <ul style="display: flex;justify-content: space-around;">
                                        <li style="display: flex;width: 100%;justify-content: space-around;"><input
                                                    class="text-box-dark" type="text" name="longitud"
                                                    value="Longitud (1-9999) *"
                                                    id="longitud"
                                                    onfocus="if (this.value === 'Longitud (1-9999) *') {this.value = ''}"
                                                    onblur="if (this.value === '') {this.value = 'Longitud (1-9999) *';}"
                                                    style="width: 80%;text-align: center;margin: 2% 0;padding: 3%;">
                                        </li>
                                        <li style="display: flex;width: 100%;justify-content: space-around;"><select
                                                    name="longitudmag"
                                                    style="color: #485460;width: 80%;margin: 0.5em 0 0.5em 0;-webkit-transition: border-color 0.3s;border: 1px solid #EEE;text-align: center">
                                                <option value="m">m</option>
                                                <option value="cm">cm</option>
                                            </select></li>
                                    </ul>

                                    <ul style="display: flex;justify-content: space-around;">
                                        <li style="display: flex;width: 100%;justify-content: space-around;"><input
                                                    class="text-box-dark" type="text" name="velocidad"
                                                    id="velocidad"
                                                    value="Velocidad (1-9999) *"
                                                    onfocus="if (this.value === 'Velocidad (1-9999) *') {this.value = ''}"
                                                    onblur="if (this.value === '') {this.value = 'Velocidad (1-9999) *';}"
                                                    style="width: 80%;text-align: center;margin: 2% 0;padding: 3%;">
                                        </li>
                                        <li style="display: flex;width: 100%;justify-content: space-around;"><select
                                                    name="velocidadmag"
                                                    style="color: #485460;width: 80%;margin: 0.5em 0 0.5em 0;-webkit-transition: border-color 0.3s;border: 1px solid #EEE;text-align: center">
                                                <option value="km/h" style="text-align: center">km/h</option>
                                            </select></li>
                                    </ul>

                                    <ul style="display: flex;justify-content: center;">
                                        <li style="width: 100%;display: flex;justify-content: center;"><input
                                                    class="text-box-dark" type="text" name="poder" id="poder"
                                                    value="Poder mortífero (1-10) *"
                                                    onfocus="if (this.value === 'Poder mortífero (1-10) *') {this.value = ''}"
                                                    onblur="if (this.value === '') {this.value = 'Poder mortífero (1-10) *';}"
                                                    style="width: 80%;text-align: center;margin: 0 0 7px;padding: 2%;">
                                        </li>
                                    </ul>

                                    <ul style="display: flex;  align-items: center;  justify-content: center; flex-direction: column">
                                        <li style="width: 100%;display: flex;justify-content: center;">
                                            <textarea class="text-box-dark" name="mensaje" maxlength="300" id="mensaje"
                                                      placeholder="Escriba una pequeña descripción de no más de 300 caracteres"
                                                      onfocus="if (this.value === 'Escriba una pequeña descripción de no más de 300 caracteres') {this.value = ''}"
                                                      onblur="if (this.value === '') {this.value = 'Escriba una pequeña descripción de no más de 300 caracteres';}"
                                                      style="margin: 0; width: 100%; text-align: justify; max-height: 140px; min-height: 40px; resize: vertical; line-height: 22px; height: 60px; padding: 1%;">Escriba una pequeña descripción de no más de 300 caracteres</textarea>
                                        </li>
                                        <li style="display: flex;width: 20%;justify-content: space-around;">
                                            <div id="contador">0/300</div>
                                            <script>
                                                const mensaje = document.getElementById('mensaje');
                                                const contador = document.getElementById('contador');

                                                mensaje.addEventListener('input', function (e) {
                                                    const target = e.target;
                                                    const longitudMax = target.getAttribute('maxlength');
                                                    const longitudAct = target.value.length;
                                                    contador.innerHTML = `${longitudAct}/${longitudMax}`;
                                                });
                                            </script>
                                        </li>
                                    </ul>

                                    <ul style="display: flex;justify-content: center;">
                                        <li style="width: 100%;display: flex;justify-content: center;margin-top: 3%;">
                                            <input type="file" name="imganimal" id="inputfile"
                                                   style="display:none;background-color: blue;">
                                            <label for="inputfile"
                                                   style="Color: white;background-color: black;padding: 3%; cursor:pointer;">Sube
                                                la imagen de tu carta *</label>
                                        </li>
                                    </ul>

                                    <ul class="payment-sendbtns" style="float: none;display: flex; margin-top: 3%">
                                        <li style="width: 50%;">
                                            <button type="button" name="validar" id="validar"
                                                    style="background: #ff9a02; padding: 6px 50px; border: none; color: #FFF; cursor: pointer; font-size: 1.2em; display: block; -webkit-transition: all 0.5s ease-in-out; -moz-transition: all 0.5s ease-in-out; -o-transition: all 0.5s ease-in-out; transition: all 0.5s ease-in-out; outline: none; width: 100%">
                                                Validar carta
                                            </button>
                                        </li>
                                        <li style="width: 50%;">
                                            <button type="submit" name="submit" id="submit" disabled="disabled"
                                                    style="margin: 0;width: 100%; background-color: #1abc9c40">Añadir
                                                carta
                                            </button>
                                        </li>
                                    </ul>

                                    <ul>
                                        <li style="margin-top: 3%;">
                                            <?php
                                            if (isset($error)) {
                                                echo "<span id='error' class='error" . $error . "' style='text-align: center;margin: 0 auto;color:red;font-weight: bold;'>" . $mensajeError . '</span>';
                                            }
                                            ?>
                                            <span id="error"
                                                  style="text-align: center;margin: 0 auto;color:red;font-weight: bold;"></span>
                                        </li>
                                    </ul>


                                    <script>
                                        function init() {
                                            const inputFile = document.getElementById('inputfile');
                                            inputFile.addEventListener('change', mostrarImagen, false);
                                        }

                                        function mostrarImagen(event) {
                                            const file = event.target.files[0];
                                            const reader = new FileReader();
                                            reader.onload = function (event) {
                                                const img = $('#imganimal').css('background', 'linear-gradient(rgba(255, 255, 255, 0.8), rgba(255, 255, 255, 0.8)), ' + 'url("' + reader.result + '") no-repeat center').css('background-size', 'contain');
                                                img.src = event.target.result;
                                            }
                                            reader.readAsDataURL(file);
                                        }

                                        window.addEventListener('load', init, false);
                                    </script>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!--                <button> title="Close (Esc)" type="button" class="mfp-close">×</button-->
                <!--pop-up-grid-->
            </div>
        </section>
    </div>
    <!-- /Pricing Tables -->
    <div class="slide story" id="slide-6" data-slide="6">
        <section class="our-contacts slideanim" id="contact">
            <h3 class="slideanim">¡ Contacta con nosotros !</h3>
            <div class="container">
                <hr>
            </div>
            <p class="text-center slideanim">Si tienes algún problema en el juego o quieres sugerir algún cambio o
                añadir cosas a la aplicación, no dudes en contactarnos</p>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 slideanim">
                        <form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <div class="row">
                                <div class="form-group col-lg-4">
                                    <input type="text" name="Name" class="form-control user-name"
                                           placeholder="Tu nombre" required/>
                                </div>
                                <div class="form-group col-lg-4">
                                    <input type="email" name="Email" class="form-control mail" placeholder="Tu Correo"
                                           required/>
                                </div>
                                <div class="form-group col-lg-4">
                                    <input type="tel" name="Phone" class="form-control pno"
                                           placeholder="Tu número de teléfono" required/>
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group col-lg-12">

                                    <textarea class="form-control" name="Message" rows="6"
                                              placeholder="Breve descripción de que es lo que propones, quieras mejorar, soluciones..."
                                              required></textarea>
                                </div>
                                <div class="form-group col-lg-12">
                                    <button type="submit" href="#" class="btn-outline" name="email" id="email">Enviar
                                    </button>
                                </div>
                            </div>
                            <?php

                            if (isset($_POST['email'])) {
                                $visitor_name = "";
                                $visitor_email = "";
                                $phone = "";
                                $visitor_message = "";
                                $email_title = "Sugerencia para Animales Salvajes";

                                if (isset($_POST['Email'])) {
                                    $visitor_email = str_replace(array("\r", "\n", "%0a", "%0d"), '', $_POST['Email']);
                                    $visitor_email = filter_var($visitor_email, FILTER_VALIDATE_EMAIL);
                                }

                                if (isset($_POST['Message']) && isset($_POST['Phone']) && isset($_POST['Name'])) {
                                    $visitor_name = $_POST['Name'];
                                    $phone = $_POST['Phone'];
                                    $complexMessage = htmlspecialchars($_POST['Message']);

                                    $visitor_message = "Hola: " . $visitor_name . "," . "\r\n" . ".Su número de teléfono: " . $phone . "\r\n" . $complexMessage;
                                }

                                $recipient = "iofernandezllebrez134@ieszaidinvergeles.org";

                                $headers = 'MIME-Version: 1.0' . "\r\n"
                                    . 'Content-type: text/html; charset=utf-8' . "\r\n"
                                    . 'From: ' . $visitor_email . "\r\n";

                                if (mail($recipient, $email_title, $visitor_message, $headers)) {
                                    echo "<p>Gracias por contactar con nosotros, $visitor_name. Recibirás una respuesta en menos de 24h</p>";
                                } else {
                                    echo '<p>Lo sentimos pero ha habido un problema y no se ha podido enviar, intentelo de nuevo más tarde</p>';
                                }

                            } else {
                                echo '<p>¡Rellene el formulario para poder enviarlo!</p>';
                            }

                            ?>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- Our History -->
    <section class="history slideanim">
        <h3 class="text-center slideanim">Nuestro equipo de desarrollo</h3>
        <div class="container">
            <hr>
        </div>
        <p class="text-center slideanim">Descripción de lo que hace cada uno de los integrantes de nuestro proyecto
            <b style="font-weight: bold">"Animales Salvajes"</b><br><a
                    href="https://github.com/orgs/TeamBiscochito/projects/1" class="verProyecto" target="_blank">Haga
                clic para ver el progreso del proyecto</a></p>
        <div class="container">
            <section class="tabs slideanim">
                <input id="tab-1" type="radio" name="radio-set" class="tab-selector-1" checked="checked"/>
                <label for="tab-1" class="tab-label-1">Gabriel</label>

                <input id="tab-2" type="radio" name="radio-set" class="tab-selector-2"/>
                <label for="tab-2" class="tab-label-2">Manuel</label>

                <input id="tab-3" type="radio" name="radio-set" class="tab-selector-3"/>
                <label for="tab-3" class="tab-label-3">Oleg</label>

                <input id="tab-4" type="radio" name="radio-set" class="tab-selector-4"/>
                <label for="tab-4" class="tab-label-4">Pablo</label>

                <div class="clear-shadow"></div>

                <div class="content">
                    <div class="content-1">
                        <h3 class="his1">GABRIEL GUERRERO EXPÓSITO</h3>
                        <p>Tercer integrante del proyecto, para animales salvajes. Estudia en IES Zaidín Vergeles, Grado
                            Superior en Técnico Superior en Desarrollo de Aplicaciones Multiplataforma.</p>
                        <h3 class="his2">TRABAJO REALIZADO</h3>
                        <p>Departamento de código. Broadcast implementado (más adelante mejorado). Componente de
                            navegación y fragmentos creados. Preferencias compartidas + RecyclerView y Adapter. Laravel
                            JSON + paginación.</p>
                    </div>
                    <div class="content-2">
                        <h3 class="his1">MANUEL GARCÍA ARQUELLADAS</h3>
                        <p>Cuarto integrante del proyecto, para animales salvajes. Estudia en IES Zaidín Vergeles, Grado
                            Superior en Técnico Superior en Desarrollo de Aplicaciones Multiplataforma.</p>
                        <h3 class="his2">TRABAJO REALIZADO</h3>
                        <p>Departamento de diseño y programación de navegación. Creación del menú inicial del juego.
                            Añade créditos. Fragmentos generales modificados. Fragmentos de jugador + música +
                            animaciones. Fragmento correo añadido.</p>
                    </div>
                    <div class="content-3">
                        <h3 class="his1">OLEG FERÁNDEZ-LLEBREZ RODRÍGUEZ</h3>
                        <p>Segundo integrante del proyecto, para animales salvajes. Estudia en IES Zaidín Vergeles,
                            Grado
                            Superior en Técnico Superior en Desarrollo de Aplicaciones Multiplataforma.</p>
                        <h3 class="his2">TRABAJO REALIZADO</h3>
                        <p>Departamento de diseño y web. Creación del repositorio de Github (Wiki, y Github-Web).
                            Mejoras en el diseño de fragmentos. Creación de Portrait (7"). Cambios en XML. Creación de
                            página Web.</p>
                    </div>
                    <div class="content-4">
                        <h3 class="his1">PABLO JAVIER JÁIMEZ COBOS</h3>
                        <p>Tercer integrante del proyecto, para animales salvajes. Estudia en IES Zaidín Vergeles, Grado
                            Superior en Técnico Superior en Desarrollo de Aplicaciones Multiplataforma.</p>
                        <h3 class="his2">TRABAJO REALIZADO</h3>
                        <p>Departamento de código. Creación del primer commit. Creación de Room. Creación de repositorio
                            + LiveData. Base de datos inicializada y estructura modificada para un mejor acceso.
                            Estructura del juego.</p>
                    </div>
                </div>
            </section>
        </div>
    </section>
    <!-- /Our History -->
    <section class="map">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 slideanim">
                    <iframe class="googlemaps"
                            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12718.565692904409!2d-3.5911843!3d37.1612249!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x5cc395f96e47c0d9!2sIES%20Zaid%C3%ADn%20Vergeles!5e0!3m2!1ses!2ses!4v1611310581574!5m2!1ses!2ses"
                            style="border:0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </section>
    <!-- /google map -->
    <!-- contact section -->

    <!-- /contact section -->
    <?php require_once('footer.php') ?>
</body>
<?php require_once('scripts.php') ?>
</html>