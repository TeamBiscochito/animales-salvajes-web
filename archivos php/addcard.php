<?php
require_once('header.php');
require_once('config.php');

ini_set('display_errors', 1);
error_reporting(E_ALL);

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
    $descripcion = $_POST['descripcion'];


    if (empty($nombre) || empty($altura) || empty($peso) || empty($longitud) || empty($velocidad) || empty($poder)) {
        echo "<span>Debes rellenar todos los campos </span>";
    } elseif (empty($img)) {
        echo "<span>Debes añadir una imagen </span>";
    } elseif (!is_numeric($altura) || !is_numeric($peso) || !is_numeric($longitud) || !is_numeric($velocidad) || !is_numeric($poder)) {
        echo "<span>Lo sentimos hay un error en alguno de los campos requeridos</span>";
    } elseif ($poder < 0 || $poder > 10) {
        echo "<span>El poder debe ser un valor comprendido entre 0 y 10</span>";
    } else {

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
            echo "correcto";

        }
    }


}
?>
    <script src="myjs.js"></script>
<?php require_once('nav.php') ?>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
        <img src="img/defaultimg.jpg" alt="Default image" height="150" width="150" id="imganimal">
        <br/>
        <label for="nombre">Nombre:</label>
        <input name="nombre" type="text">
        <br/>

        <label for="altura">Altura:</label>
        <input name="altura" type="number">
        <select name="alturamag">
            <option value="m">m</option>
            <option value="cm">cm</option>
        </select>

        <br/>
        <label for="peso">Peso:</label>
        <input name="peso" type="number">
        <select name="pesomag">
            <option value="kg">kg</option>
            <option value="g">g</option>
            <option value="T">T</option>
        </select>


        <br/>
        <label for="longitud">Longitud:</label>
        <input name="longitud" type="number">
        <select name="longitudmag">
            <option value="m">m</option>
            <option value="cm">cm</option>
        </select>

        <br/>
        <label for="velocidad">Velocidad:</label>
        <input name="velocidad" type="number">
        <select name="velocidadmag">
            <option value="km/h">km/h</option>
        </select>

        <br/>
        <label for="poder">Poder mortifero(1-10):</label>
        <input name="poder" type="number">

        <br/>

        <br/>
        <label for="descripcion">Descripcion:</label>
        <input name="descripcion" type="text">

        <br/>

        <input name="imganimal" type="file" id="inputfile">
        <br/>
        <br/>
        <button name="submit">Añadir</button>

    </form>

    </body>
<?php
require_once('footer.php');
?>