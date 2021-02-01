<?php

/**
 * Class DBConnection
 */

class DBConnection {

    /**
     * @var array de settings
     */
    protected array $settings;

    /**
     * @var PDO|null
     */
    public ?PDO $dbc = null;

    /**
     * DBConnection constructor.
     *
     * Función que devuelve una instancia de conexión a la BBDD
     *
     * 1.- Debemos recoger los datos de los settings
     * 2.- Invocar al método getter que devuelve la instancia de la conexión
     *
     * @param array $config Contiene los settings de la conexión
     */
    public function __construct(array $config) {
        $this->settings = $config;
        $this->getDBConnection();
    }

    /**
     * Función getDBConnection()
     *
     * Intentar obtener una instancia de la conexion siempre que no este creada ya
     */
    public function getDBConnection() {
        if ($this->dbc == NULL) {
            $dsn = "" . $this->settings['driver'] .
                ":host=" . $this->settings['host'] .
                ";dbname=" . $this->settings['dbname'] .
                ";charset=utf8mb4";
            $options = array();
            try {
                $this->dbc = new PDO($dsn, $this->settings['username'], $this->settings['password'], $options);
            } catch (PDOException $ex) {
                echo __LINE__ . $ex->getMessage();
            }
        }
    }


//    /**
//     * Función getQuery
//     *
//     * Ejecuta una consulta de tipo select
//     *
//     * @param $sql
//     *
//     * @return string|PDOStatement
//     */
//    public function getQuery($sql) {
//        try {
//            $resultset = $this->dbc->query($sql);
//
//        } catch (PDOException $ex) {
//            echo $ex->getMessage();
//            return $ex->getMessage();
//        }
//        return $resultset;
//    }


//    /**
//     * Función runQuery
//     *
//     * Ejecuta consultas de tipo DELETE, INSERT...
//     *
//     * @param $sql, se le pasa la consulta
//     *
//     * @return int donde retorna un entero, diciendo las filas afectadas
//     */
//    public function runQuery($sql): int {
//        try {
//            $lineasAfectadas = $this->dbc->exec($sql);
//        } catch (PDOException $ex) {
//            echo $ex->getMessage();
//            return $ex->getMessage();
//        }
//        return $lineasAfectadas;
//    }

    /**
     * @return PDO|null
     */
    public function getCon() {
        if ($this->dbc instanceof PDO) {
            return $this->dbc;
        }
        return null;
    }
}