<?php

$config = array(
    'driver' => 'mysql',
    'host' => 'localhost',
    'dbname' => 'toptrump',
    'username' => 'Oleg',
    'password' => 'oleg-',
);

require_once('DBConnection.php');
require_once('functions.php');
$dbc = new DBConnection($config);
$con = $dbc->getCon();