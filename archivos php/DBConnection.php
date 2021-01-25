<?php

class DBConnection {

    protected $settings;

    public $dbc;

    /* 
     * Funcion que devuelve una instancia de conexion a la BBDD
     * @ param array Contiene los settings de la conexion
     */

    public function __construct(array $config) {

        // Debemos recoger los datos de los settings
        $this->settings = $config;
        // invocar al metodo getter que devuelve la instancia
        // de la conexion

        $this->getDBConnection();


    }

    public function getDBConnection() {
        //intentar obtener una instancia de la conexion siempre que no este creada ya


        if ($this->dbc == NULL) {
            $dsn = "" . $this->settings['driver'] . ":host=" . $this->settings['host'] . ";dbname=" . $this->settings['dbname'];
            $options = array();
            try {
                $this->dbc = new PDO($dsn, $this->settings['username'], $this->settings['password'], $options);

            } catch (PDOException $ex) {
                echo __LINE__ . $ex->getMessage();
            }

        } else {

        }
    }


    public function getQuery($sql) {
        // Para consultas tipo SELECT
        try {
            $resultset = $this->dbc->query($sql);

        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        return $resultset;

    }


    public function runQuery($sql) {
        // Para consultas tipo DELETE, INSERT, etc...

        try {
            $lineasAfectadas = $this->dbc->exec($sql);
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        return $lineasAfectadas;
    }

    public function getCon() {
        if ($this->dbc instanceof PDO) {
            return $this->dbc;
        }
    }
}