<!-- Footer section -->
<?php require_once('config.php');?>
<section class="footer" id="footer">
    <div class="container">
        <div class="col-lg-3 col-sm-6">
            <div class="footer-about">
                <h3 style="text-align: center; color:lime">Sobre nosotros</h3>
                <p style="text-align: justify">Somos un pequeño grupo de clase en el que nos hemos juntado para empezar
                    este pequeño proyecto sobre
                    cartas (Top Trumps), para que los niños se diviertan con nuestra gran aplicación que es gratis.</p>
                <a href="#slide-2" data-slide="2" style="display:flex; justify-content: center">Animales Salvajes</a>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="footer-nav">
                <h3 style="text-align: center; color:lime">¡ Navega !</h3>
                <ul class="links"
                    style="display: flex;flex-direction: column;justify-content: center;align-content: center;align-items: center;margin: 0 auto;">
                    <li>
                        <a href="index.html">
                            <span class="icon icon-home"></span>Inicio<span class="icon icon-home"
                                                                            style="margin-left: 6px"></span>
                        </a>
                    </li>
                    <li><a href="#slide-2"><span class="icon icon-user"></span> Nosotros<span class="icon icon-user"
                                                                                              style="margin-left: 10px"></span></a>
                    </li>
                    <li><a href="#slide-3"><span class="icon icon-camera"></span> Cartas<span
                                    class="icon icon-camera" style="margin-left: 9px"></span></a></li>
                    <li><a href="#slide-4"><span class="icon icon-heart"></span> Reseñas<span
                                    class="icon icon-heart" style="margin-left: 8px"></span></a></li>
                    <li><a href="#slide-5"><span class="icon icon-gears"></span> Añadir carta<span
                                    class="icon icon-gears" style="margin-left: 9px"></span></a></li>
                    <li><a href="#slide-6"><span class="icon icon-envelope"></span> Contacto<span
                                    class="icon icon-envelope" style="margin-left: 9px"></span></a></li>
                </ul>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6"
             style="height: 301px;display: flex;align-content: center;justify-content: center;align-items: center;">
            <div class="footer-nav" style="height: 100%;display: flex;flex-direction: column;">
                <h3 style="text-align: center; color:lime">¡ Información !</h3>
                <ul class="links"
                    style="display: flex;flex-direction: column;justify-content: space-between;align-content: center;align-items: center;height: 100%;margin: 0 auto;">
                    <li style="padding: 0;display: flex;">
                        <a href="#footer" style="justify-content: revert;flex-direction: column;text-align: center;">
                            <span class="icon icon-globe" style="margin: 5px;"></span>21 Calle Biscocho<span
                                    class="icon icon-globe" style="margin: 5px;"></span><br><span
                                    class="icon icon-globe" style="margin: 5px;"></span>Granada - ESP<span
                                    class="icon icon-globe" style="margin: 5px;"></span>
                        </a>
                    </li>
                    <li style="padding: 0;display: flex;">
                        <a href="#footer" style="justify-content: revert;flex-direction: column;text-align: center;">
                            <span class="icon icon-phone" style="margin: 5px;"></span>+34 712 123 321<span
                                    class="icon icon-phone" style="margin: 5px;"></span><br><span
                                    class="icon icon-phone" style="margin: 5px;"></span>+34 712 123 321<span
                                    class="icon icon-phone" style="margin: 5px;"></span>
                        </a>
                    </li>

                    <li style="padding: 0;display: flex;">
                        <a <a href="mailto:help@TeamBiscochito.com"
                              style="justify-content: revert;flex-direction: column;text-align: center;">
                            <span class="icon icon-envelope" style="margin: 5px;"></span>help@TeamBiscochito.com<span
                                    class="icon icon-envelope" style="margin: 5px;"></span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="footer-gallery">
                <h3 style="text-align: center; color:lime">Cartas recientes</h3>
                <div id="photoGallery-container"
                     style="margin: 0 auto;display: flex;flex-wrap: wrap;justify-content: center;">
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
                    $stmt = $con->prepare($sql);
                    $stmt->execute();

                    $consulta = "select COUNT(*) from carta";
                    $statement = $con->prepare($sql);
                    $statement->execute();

                    $tuplas = $statement->rowCount();
                    $pags = ceil($tuplas / 12);

                    $sql = "select * from carta limit 12";
                    $stmt = $con->prepare($sql);
                    $stmt->execute();

                    while ($resultset = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $query = "select * from pregunta where card_id = :idcard";
                        $st = $con->prepare($query);
                        $st->execute(array(":idcard" => $resultset['id']));
                        echo '<img class="photoGallery" data-src=img/'.$resultset['picUrl'].' src=img/'.$resultset['picUrl'].' data-id=img/'.$resultset['picUrl'].' data-desc='.$resultset['name'].'>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <hr>
        <div class="row">
            <div class="col-lg-12">
                <div class="copyright">
                    <p class="text-center">© 2021 Animales Salvajes. Todos los derechos reservados | Design by <a
                                href="https://github.com/TeamBiscochito" target="_blank" style="color: cyan">Team Biscochito</a></p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /Footer section -->
</body>