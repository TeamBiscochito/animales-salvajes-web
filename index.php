<?php

require_once('header.php');
require_once('config.php');

ini_set('display_errors', 1);
error_reporting(E_ALL);
?>
<?php

require_once('navbar.php');
$corregir = false;
$mensajeError = "";
$error = 1;

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

if (isset($_POST['validar'])) {

    if (empty($nombre) || $nombre == "Nombre de la carta / Elefante *" || empty($altura) || $altura == "Altura *" ||
        empty($peso) || $peso == "Peso *" || empty($longitud) || $longitud == "Longitud *" ||
        empty($velocidad) || $velocidad == "Velocidad *" || empty($poder) || $poder == "Poder mortífero (1-10) *") {
        $mensajeError = "Los campos con * son requeridos...";
        $error = 1;
        $corregir = false;
        //        echo "<span class='error' style='text-align: center;margin: 0 auto;color:red;font-weight: bold;'>Debes rellenar todos los campos</span>";
    } elseif (empty($img)) {
        $mensajeError = "Debes de añadir una imagen";
        $error = 1;
        $corregir = false;
        //        echo "<span class='error' style='text-align: center;margin: 0 auto;color:red;font-weight: bold;'>Debes añadir una imagen</span>";
    } elseif (!is_numeric($altura) || !is_numeric($peso) || !is_numeric($longitud) || !is_numeric($velocidad) || !is_numeric($poder)) {
        $mensajeError = "Revisa los campos, hay algún dato incorrecto";
        $error = 1;
        $corregir = false;
        //        echo "<span class='error'>Lo sentimos hay un error en alguno de los campos requeridos</span>";
    } elseif ($poder < 0 || $poder > 10) {
        $mensajeError = "El poder tiene que estar entre 0 y 10";
        $error = 1;
        $corregir = false;
        //        echo "<span class='error'>El poder debe ser un valor comprendido entre 0 y 10</span>";
    } else {
        $mensajeError = "Todos los parámetros están correctos";
        $error = 0;
        if (isset($_POST['submit'])) {
            if ($descripcion == "Escriba una pequeña descripción de no más de 300 caracteres...") {
                $descripcion = "No se ha proporcionado una descripción";
            }

            $sql = "insert into carta values(null, :nombre, :descripcion, :imagen )";
            $stmt = $con->prepare($sql);

            $stmt->execute(array(":nombre" => $nombre, ":descripcion" => $descripcion, ":imagen" => $img));


            $query = "select id from carta where nombre = :nombre";
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

            }
        }
    }
}

function corregir() {


}

?>
    <!-- Ban -->
    <div class="slide story" id="slide-1">
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
                                <img src="images/newImages/ourWork1.png" alt="about-us"
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
    </div>
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
                <div class="demo-wrapper">
                    <ul class="portfolio-items">
                        <li class="item">
                            <figure>
                                <div class="view"><img src="images/work1.jpg"/></div>
                                <figcaption>
                                    <p><span><a href="#0">Passion For Birds.</a></span></p>
                                    <p><span>By Ornithology</span></p>
                                </figcaption>
                            </figure>
                            <div class="date">2010</div>
                        </li>
                        <li class="item">
                            <figure>
                                <div class="view"><img src="images/work2.jpg"/></div>
                                <figcaption>
                                    <p><span><a href="#0">Everyone's Favourite Birds.</a></span></p>
                                    <p><span>By Ornithology</span></p>
                                </figcaption>
                            </figure>
                            <div class="date">2011</div>
                        </li>
                        <li class="item">
                            <figure>
                                <div class="view"><img src="images/work3.jpg"/></div>
                                <figcaption>
                                    <p><span><a href="#0">Birds For a Better Future.</a></span></p>
                                    <p><span>By Ornithology</span></p>
                                </figcaption>
                            </figure>
                            <div class="date">2012</div>
                        </li>
                        <li class="item">
                            <figure>
                                <div class="view"><img src="images/work4.jpg"/></div>
                                <figcaption>
                                    <p><span><a href="#0">Birds - To Feel Free.</a></span></p>
                                    <p><span>By Ornithology</span></p>
                                </figcaption>
                            </figure>
                            <div class="date">2013</div>
                        </li>
                        <li class="item">
                            <figure>
                                <div class="view"><img src="images/work5.jpg"/></div>
                                <figcaption>
                                    <p><span><a href="#0">Birds For You.</a></span></p>
                                    <p><span>By Ornithology</span></p>
                                </figcaption>
                            </figure>
                            <div class="date">2014</div>
                        </li>
                        <li class="item">
                            <figure>
                                <div class="view"><img src="images/work6.jpg"/></div>
                                <figcaption>
                                    <p><span><a href="#0">Go Far With Birds.</a></span></p>
                                    <p><span>By Ornithology</span></p>
                                </figcaption>
                            </figure>
                            <div class="date">2015</div>
                        </li>
                        <li class="item">
                            <figure>
                                <div class="view"><img src="images/work7.jpg"/></div>
                                <figcaption>
                                    <p><span><a href="#0">Birds For Me.</a></span></p>
                                    <p><span>By Ornithology</span></p>
                                </figcaption>
                            </figure>
                            <div class="date">2016</div>
                        </li>
                        <li class="item">
                            <figure>
                                <div class="view"><img src="images/work8.jpg"/></div>
                                <figcaption>
                                    <p><span><a href="#0">Birds - Enjoy The Difference.</a></span></p>
                                    <p><span>By Ornithology</span></p>
                                </figcaption>
                            </figure>
                            <div class="date">2017</div>
                        </li>
                        <li class="item">
                            <figure>
                                <div class="view"><img src="images/work9.jpg"/></div>
                                <figcaption>
                                    <p><span><a href="#0">Try Birds You'll Like It.</a></span></p>
                                    <p><span>By Ornithology</span></p>
                                </figcaption>
                            </figure>
                            <div class="date">2018</div>
                        </li>
                        <li class="item">
                            <figure>
                                <div class="view"><img src="images/work10.jpg"/></div>
                                <figcaption>
                                    <p><span><a href="#0">Birds, Take Me Away.</a></span></p>
                                    <p><span>By Ornithology</span></p>
                                </figcaption>
                            </figure>
                            <div class="date">2019</div>
                        </li>
                        <li class="item">
                            <figure>
                                <div class="view"><img src="images/work11.jpg"/></div>
                                <figcaption>
                                    <p><span><a href="#0">Most Exellent Birds</a></span></p>
                                    <p><span>By Ornithology</span></p>
                                </figcaption>
                            </figure>
                            <div class="date">2020</div>
                        </li>
                        <li class="item">
                            <figure>
                                <div class="view"><img src="images/work12.jpg"/></div>
                                <figcaption>
                                    <p><span><a href="#0">All Birds, All the Time.</a></span></p>
                                    <p><span>By Ornithology</span></p>
                                </figcaption>
                            </figure>
                            <div class="date">2021</div>
                        </li>
                        <li class="item">
                            <figure>
                                <div class="view"><img src="images/work13.jpg"/></div>
                                <figcaption>
                                    <p><span><a href="#0">Birds For Your Life.</a></span></p>
                                    <p><span>By Ornithology</span></p>
                                </figcaption>
                            </figure>
                            <div class="date">2022</div>
                        </li>
                        <li class="item">
                            <figure>
                                <div class="view"><img src="images/work14.jpg"/></div>
                                <figcaption>
                                    <p><span><a href="#0">Life's Beautiful With Birds.</a></span></p>
                                    <p><span>By Ornithology</span></p>
                                </figcaption>
                            </figure>
                            <div class="date">2023</div>
                        </li>
                        <li class="item">
                            <figure>
                                <div class="view"><img src="images/work15.jpg"/></div>
                                <figcaption>
                                    <p><span><a href="#0">Me And My Birds.</a></span></p>
                                    <p><span>By Ornithology</span></p>
                                </figcaption>
                            </figure>
                            <div class="date">2024</div>
                        </li>
                    </ul>
                </div>
            </div><!-- /container -->
        </section>
    </div><!-- /slide2 -->
    <!-- Portfolio Section -->
    <!-- === SLide 3 - Portfolio -->
    <div class="slide story" id="slide-3" data-slide="3">
        <section class="gallery slideanim">
            <h3 class="text-center slideanim">Our Gallery</h3>
            <div class="container">
                <hr>
            </div>
            <p class="text-center slideanim">Lorem Ipsum is simply dummy text of the printing and typesetting
                industry.</p>
            <div class="container">
                <div class="im_wrapper">
                    <div><img src="images/1.jpg" class="img-responsive" alt=""/></div>
                    <div><img src="images/2.jpg" class="img-responsive" alt=""/></div>
                    <div><img src="images/3.jpg" class="img-responsive" alt=""/></div>
                    <div><img src="images/4.jpg" class="img-responsive" alt=""/></div>
                    <div><img src="images/5.jpg" class="img-responsive" alt=""/></div>
                    <div><img src="images/6.jpg" class="img-responsive" alt=""/></div>

                    <div><img src="images/7.jpg" class="img-responsive" alt=""/></div>
                    <div><img src="images/8.jpg" class="img-responsive" alt=""/></div>
                    <div><img src="images/9.jpg" class="img-responsive" alt=""/></div>
                    <div><img src="images/10.jpg" class="img-responsive" alt=""/></div>
                    <div><img src="images/11.jpg" class="img-responsive" alt=""/></div>
                    <div><img src="images/12.jpg" class="img-responsive" alt=""/></div>

                    <div><img src="images/3.jpg" class="img-responsive" alt=""/></div>
                    <div><img src="images/9.jpg" class="img-responsive" alt=""/></div>
                    <div><img src="images/7.jpg" class="img-responsive" alt=""/></div>
                    <div><img src="images/2.jpg" class="img-responsive" alt=""/></div>
                    <div><img src="images/4.jpg" class="img-responsive" alt=""/></div>
                    <div><img src="images/12.jpg" class="img-responsive" alt=""/></div>

                    <div><img src="images/7.jpg" class="img-responsive" alt=""/></div>
                    <div><img src="images/5.jpg" class="img-responsive" alt=""/></div>
                    <div><img src="images/10.jpg" class="img-responsive" alt=""/></div>
                    <div><img src="images/3.jpg" class="img-responsive" alt=""/></div>
                    <div><img src="images/8.jpg" class="img-responsive" alt=""/></div>
                    <div><img src="images/4.jpg" class="img-responsive" alt=""/></div>

                    <div><img src="images/1.jpg" class="img-responsive" alt=""/></div>
                    <div><img src="images/11.jpg" class="img-responsive" alt=""/></div>
                    <div><img src="images/10.jpg" class="img-responsive" alt=""/></div>
                    <div><img src="images/6.jpg" class="img-responsive" alt=""/></div>
                    <div><img src="images/3.jpg" class="img-responsive" alt=""/></div>
                    <div><img src="images/8.jpg" class="img-responsive" alt=""/></div>
                </div>
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
                            <div class="test-info2">
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
                    <span>Se necesita - Nombre de carta</span>
                    <h2 style="font-size: 21px; font-weight: bold">Ingrese - Poder mortífero</h2>
                    <div class="para">
                        <p>Se necesita - Altura</p>
                        <p>Se necesita - Peso</p>
                        <p>Se necesita - Longitud</p>
                        <p>Se necesita - Velocidad</p>
                        <p style="font-size: 14px">Descripción: <br>Breve descripcipción sobre el animal que quieres
                            añadir</p>
                    </div>
                    <div class="sign text-center">
                        <a href="#Agregar">Añadir</a>
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
                            larga trompa que utilizan para oler, comer, comunicarse, manipular objetos y absorber
                            agua para bañarse o para beber.</p>
                    </div>
                    <div class="sign text-center">
                        <a class="popup-with-zoom-anim" href="#small-dialog">Añade tu carta</a>
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
                        <p style="font-size: 14px">Descripción: <br>Breve descripcipción sobre el animal que quieres
                            añadir</p>
                    </div>
                    <div class="sign text-center">
                        <a href="#Agregar">Añadir</a>
                    </div>
                </div>
                <div class="clear"></div>
                <!--pop-up-grid-->
                <div id="popup">
                    <div id="small-dialog" class="mfp-hide slideanim" style="height: 750px">
                        <div class="pop_up" style="height: 100%">
                            <div class="payment-online-form-left" id="imganimal">
                                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST"
                                      enctype="multipart/form-data" href="#imagenCarta">
                                    <h4 style="display: flex;justify-content: space-around;"><span class="shipping"
                                                                                                   style="margin: 0;"> </span>Detalles
                                        de la carta<span class="shipping" style="margin: 0;"> </span></h4>
                                    <ul style="display: flex;justify-content: center;">
                                        <li style="width: 100%;display: flex;justify-content: center;"><input
                                                    required="required"
                                                    class="text-box-dark" type="text" name="nombre"
                                                    value="Nombre de la carta / Elefante *"
                                                    onfocus="if (this.value == 'Nombre de la carta / Elefante *') {this.value = ''}"
                                                    onblur="if (this.value == '') {this.value = 'Nombre de la carta / Elefante *';}"
                                                    style="margin: 0;width: 80%;text-align: center;"></li>
                                    </ul>
                                    <ul style="display: flex;justify-content: space-around;">
                                        <li style="display: flex;width: 100%;justify-content: space-around;"><input
                                                    required="required"
                                                    class="text-box-dark" type="text" name="altura" value="Altura *"
                                                    onfocus="if (this.value == 'Altura *') {this.value = ''}"
                                                    onblur="if (this.value == '') {this.value = 'Altura *';}"
                                                    style="width: 80%;text-align: center;margin: 2% 0px;padding: 3%;">
                                        </li>
                                        <li style="display: flex;width: 100%;justify-content: space-around;"><select
                                                    name="alturamag"
                                                    style="color: #485460;width: 80%;margin: 0.5em 0;margin-right: 0px;border: 1px solid;-webkit-transition: border-color 0.3s;border-color: #EEE; text-align: center">
                                                <option value="m">m</option>
                                                <option value="cm">cm</option>
                                            </select></li>
                                    </ul>

                                    <ul style="display: flex;justify-content: space-around;">
                                        <li style="display: flex;width: 100%;justify-content: space-around;"><input
                                                    required="required"
                                                    class="text-box-dark" type="text" name="peso" value="Peso *"
                                                    onfocus="if (this.value == 'Peso *') {this.value = ''}"
                                                    onblur="if (this.value == '') {this.value = 'Peso *';}"
                                                    style="width: 80%;text-align: center;margin: 2% 0px;padding: 3%;">
                                        </li>
                                        <li style="display: flex;width: 100%;justify-content: space-around;"><select
                                                    name="pesomag"
                                                    style="color: #485460;width: 80%;margin: 0.5em 0;margin-right: 0px;border: 1px solid;-webkit-transition: border-color 0.3s;border-color: #EEE; text-align: center">
                                                <option value="kg">kg</option>
                                                <option value="g">g</option>
                                                <option value="T">T</option>
                                            </select></li>
                                    </ul>

                                    <ul style="display: flex;justify-content: space-around;">
                                        <li style="display: flex;width: 100%;justify-content: space-around;"><input
                                                    required="required"
                                                    class="text-box-dark" type="text" name="longitud" value="Longitud *"
                                                    onfocus="if (this.value == 'Longitud *') {this.value = ''}"
                                                    onblur="if (this.value == '') {this.value = 'Longitud *';}"
                                                    style="width: 80%;text-align: center;margin: 2% 0px;padding: 3%;">
                                        </li>
                                        <li style="display: flex;width: 100%;justify-content: space-around;"><select
                                                    name="longitudmag"
                                                    style="color: #485460;width: 80%;margin: 0.5em 0;margin-right: 0px;border: 1px solid;-webkit-transition: border-color 0.3s;border-color: #EEE; text-align: center">
                                                <option value="m">m</option>
                                                <option value="cm">cm</option>
                                            </select></li>
                                    </ul>

                                    <ul style="display: flex;justify-content: space-around;">
                                        <li style="display: flex;width: 100%;justify-content: space-around;"><input
                                                    required="required"
                                                    class="text-box-dark" type="text" name="velocidad"
                                                    value="Velocidad *"
                                                    onfocus="if (this.value == 'Velocidad *') {this.value = ''}"
                                                    onblur="if (this.value == '') {this.value = 'Velocidad *';}"
                                                    style="width: 80%;text-align: center;margin: 2% 0px;padding: 3%;">
                                        </li>
                                        <li style="display: flex;width: 100%;justify-content: space-around;"><select
                                                    name="velocidadmag"
                                                    style="color: #485460;width: 80%;margin: 0.5em 0;margin-right: 0px;border: 1px solid;-webkit-transition: border-color 0.3s;border-color: #EEE; text-align: center">
                                                <option value="km/h" style="text-align: center">km/h</option>
                                            </select></li>
                                    </ul>

                                    <ul style="display: flex;justify-content: center;">
                                        <li style="width: 100%;display: flex;justify-content: center;"><input
                                                    class="text-box-dark" type="text" name="poder"
                                                    value="Poder mortífero (1-10) *"
                                                    onfocus="if (this.value == 'Poder mortífero (1-10) *') {this.value = ''}"
                                                    onblur="if (this.value == '') {this.value = 'Poder mortífero (1-10) *';}"
                                                    style="margin: 0;width: 80%;text-align: center;margin-bottom: 7.2px;padding: 2%;">
                                        </li>
                                    </ul>

                                    <ul style="display: flex;  align-items: center;  justify-content: center; flex-direction: column">
                                        <li style="width: 100%;display: flex;justify-content: center;">
                                            <textarea class="text-box-dark" name="mensaje" maxlength="300" id="mensaje"
                                                      value="Escriba una pequeña descripción de no más de 300 caracteres..."
                                                      onfocus="if (this.value == 'Escriba una pequeña descripción de no más de 300 caracteres...') {this.value = ''}"
                                                      onblur="if (this.value == '') {this.value = 'Escriba una pequeña descripción de no más de 300 caracteres...';}"
                                                      style="margin: 0px; width: 100%; text-align: justify; max-height: 140px; min-height: 40px; resize: vertical; line-height: 22px; height: 60px; padding: 1%;">Escriba una pequeña descripción de no más de 300 caracteres</textarea>
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

                                    <ul>
                                        <li style="margin-top: 3%;">
                                            <?php
                                            if (isset($error)) {
                                                /** @var String $mensajeError */
                                                echo "<span class='error" . $error . "' style='text-align: center;margin: 0 auto;color:red;font-weight: bold;'>" . $mensajeError . '</span>';
                                            }
                                            ?>
                                        </li>
                                    </ul>

                                    <ul class="payment-sendbtns" style="float: none;display: flex;">
                                        <li style="width: 50%;"><input type="reset" value="Resetear"
                                                                       style="margin: 0;width: 100%;"></li>
                                        <li style="width: 50%;">
                                            <button type="submit" name="submit" id="submit"
                                                    style="margin: 0;width: 100%;">Añadir carta
                                            </button>
                                            <!--                                            <a href="#small-dialog" class="order" style="margin: 0;width: 100%;">Añadir carta</a>-->
                                        </li>
                                    </ul>
<!--                                    <ul class="payment-sendbtns" style="float: none;display: flex;">-->
<!--                                        <li style="width: 100%;">-->
<!--                                            <input type="button" value="Validar todos los campos" id="validar"-->
<!--                                                   style="margin: 0;width: 100%;"></li>-->
<!--                                    </ul>-->

                                    <script>
                                        function init() {
                                            var inputFile = document.getElementById('inputfile');
                                            inputFile.addEventListener('change', mostrarImagen, false);
                                        }

                                        function mostrarImagen(event) {
                                            var file = event.target.files[0];
                                            var reader = new FileReader();
                                            reader.onload = function (event) {
                                                var img = $('#imganimal').css('background', 'linear-gradient(rgba(255, 255, 255, 0.8), rgba(255, 255, 255, 0.8)), ' + 'url("' + reader.result + '") no-repeat center').css('background-size', 'contain');
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
    <!-- Our History -->
    <section class="history slideanim">
        <h3 class="text-center slideanim">Our History</h3>
        <div class="container">
            <hr>
        </div>
        <p class="text-center slideanim">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
        <div class="container">
            <section class="tabs slideanim">
                <input id="tab-1" type="radio" name="radio-set" class="tab-selector-1" checked="checked"/>
                <label for="tab-1" class="tab-label-1">2010</label>

                <input id="tab-2" type="radio" name="radio-set" class="tab-selector-2"/>
                <label for="tab-2" class="tab-label-2">2011</label>

                <input id="tab-3" type="radio" name="radio-set" class="tab-selector-3"/>
                <label for="tab-3" class="tab-label-3">2012</label>

                <input id="tab-4" type="radio" name="radio-set" class="tab-selector-4"/>
                <label for="tab-4" class="tab-label-4">2013</label>

                <div class="clear-shadow"></div>

                <div class="content">
                    <div class="content-1">
                        <h3 class="his1">OUR BEGINNING</h3>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                            been the industry's standard dummy text ever since the 1500s. </p>
                        <h3 class="his2">HOW WE WORK</h3>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                            been the industry's standard dummy text ever since the 1500s, when an unknown printer took a
                            galley of type and scrambled it to make a type specimen book.</p>
                    </div>
                    <div class="content-2">
                        <h3 class="his1">OUR WORK</h3>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                            been the industry's standard dummy text ever since the 1500s, when an unknown printer took a
                            galley of type and scrambled it to make a type specimen book.</p>
                        <h3 class="his2">OUR EXELLENCE</h3>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                            been the industry's standard dummy text ever since the 1500s, when an unknown printer took a
                            galley of type and scrambled it to make a type specimen book. It has survived not only five
                            centuries, but also the leap into electronic typesetting, remaining essentially
                            unchanged.</p>
                    </div>
                    <div class="content-3">
                        <h3 class="his1">OUR DEDICATION</h3>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                            been the industry's standard dummy text ever since the 1500s, when an unknown printer took a
                            galley of type and scrambled it to make a type specimen book. It has survived not only five
                            centuries, but also the leap into electronic typesetting, remaining essentially
                            unchanged.</p>
                        <h3 class="his2">OUR HARDWORK</h3>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                            been the industry's standard dummy text ever since the 1500s, when an unknown printer took a
                            galley of type and scrambled it to make a type specimen book.</p>
                    </div>
                    <div class="content-4">
                        <h3 class="his1">OUR STRATEGY</h3>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                            been the industry's standard dummy text ever since the 1500s, when an unknown printer took a
                            galley of type and scrambled it to make a type specimen book.</p>
                        <h3 class="his2">OUR CONSISTENCY</h3>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                            been the industry's standard dummy text ever since the 1500s, when an unknown printer took a
                            galley of type and scrambled it to make a type specimen book. It has survived not only five
                            centuries, but also the leap into electronic typesetting, remaining essentially
                            unchanged.</p>
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
    <div class="slide story" id="slide-6" data-slide="6">
        <section class="our-contacts slideanim" id="contact">
            <h3 class="slideanim">Contact Us</h3>
            <div class="container">
                <hr>
            </div>
            <p class="text-center slideanim">Lorem Ipsum is simply dummy text of the printing and typesetting
                industry.</p>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 slideanim">
                        <form role="form">
                            <div class="row">
                                <div class="form-group col-lg-4">
                                    <input type="text" name="Name" class="form-control user-name"
                                           placeholder="Your Name" required/>
                                </div>
                                <div class="form-group col-lg-4">
                                    <input type="email" name="Email" class="form-control mail" placeholder="Your Email"
                                           required/>
                                </div>
                                <div class="form-group col-lg-4">
                                    <input type="tel" name="Phone" class="form-control pno"
                                           placeholder="Your Phone Number" required/>
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group col-lg-12">
                                    <textarea class="form-control" name="Message" rows="6" placeholder="Your Message"
                                              required></textarea>
                                </div>
                                <div class="form-group col-lg-12">
                                    <button type="submit" href="#" class="btn-outline">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- /contact section -->
<?php require_once('footer.php') ?>
<?php require_once('scripts.php') ?>