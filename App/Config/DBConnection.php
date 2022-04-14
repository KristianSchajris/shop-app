<?php

class DBConnection {
    private $host            = 'localhost';
    private $dbname          = 'shopdb';
    private $username        = 'root';
    private $password        = '';
    private $charset         = 'utf8';
    private static $instance = null;
    
    private $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    private function __construct()
    {
        try {
            $dns = "mysql:host=$this->host;dbname=$this->dbname;charset=$this->charset";
            self::$instance = new PDO(
                $dns,
                $this->username,
                $this->password,
                $this->options
            );
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * metodo implementado para evitar la creacion de multiples instancias
     * de la coneccion a la base de datos.
     * 
     * @return PDO
     */
    public static function getInstance()
    {
        if (self::$instance === null) {
            new self();
        }
        return self::$instance;
    }

}
