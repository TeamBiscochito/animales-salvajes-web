<?php
require_once('header.php');
require_once('config.php');

ini_set('display_errors', 1);
error_reporting(E_ALL);


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
$pags = ceil($tuplas / 5);

$sql = "select * from carta limit 5 offset " . (($actual - 1) * 5);
$stmt = $con->prepare($sql);
$stmt->execute();

?>
<?php require_once('nav.php') ?>


<?php while ($resultset = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $query = "select * from pregunta where card_id = :idcard";
    $st = $con->prepare($query);
    $st->execute(array(":idcard" => $resultset['id']));
    echo '<p>Nombre:' . $resultset['name'] . '</p>';
    echo '<p>' . $resultset['description'] . '</p>';
    echo "<img src=\"img/" . $resultset['picUrl'] . "\" height=\"500\" width=\"750\" alt=\"" . $resultset['picUrl'] . "\" > ";
    if ($st->rowCount() > 0) {
        while ($rs = $st->fetch(PDO::FETCH_ASSOC)) {
            echo "<p>" . $rs['question'] . ": " . $rs['answer'] . $rs['magnitude'] . " </p>";
        }
    }
    echo "<br/> <br/> <br/> <br/> <br/>";
}
?>
    <ul class="paginacion">
        <?php if ($actual == 1) {
            echo "<li><span> anterior  </span></li>";
        } else {
            echo "<li><a href =" . $_SERVER['PHP_SELF'] . '?pag=' . ($actual - 1) . " > anterior  </a></li>";
        }

        for ($i = 1; $i <= $pags; $i++) {
            if ($i == $actual) {
                echo "<li><span> " . $i . "  </span></li>";
            } else {
                echo "<li><a href =" . $_SERVER['PHP_SELF'] . '?pag=' . ($i) . " > " . $i . "  </a></li>";
            }
        }


        if ($actual == $pags) {
            echo "<li><span> siguiente  </span></li>";
        } else {
            echo "<li><a href =" . $_SERVER['PHP_SELF'] . '?pag=' . ($actual + 1) . " > siguiente  </a></li>";
        }

        ?>

    </ul>
    </body>
<?php
require_once('footer.php');
?>