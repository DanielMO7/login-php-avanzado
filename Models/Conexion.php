<?php

class Conexion
{
    private $host;
    private $user;
    private $password;
    private $db;
    private $conexion_pdo;


    /**
     * Crea la conexion con la base de datos usando PDO
     *
     * @return void
     */
    public function __construct()
    {
        $this->host = $_ENV["HOST"];
        $this->user = $_ENV["USER"];
        $this->password = $_ENV["PASSWORD"];
        $this->db = $_ENV["DATABASE_NAME"];
        
        $conecionString =
            'mysql:host=' .
            $this->host .
            ';dbname=' .
            $this->db.
            ';charset=utf8';
        try {
            $this->conexion_pdo = new PDO(
                $conecionString,
                $this->user,
                $this->password
            );
            $this->conexion_pdo->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );
        } catch (PDOException $e) {
            $this->conexion_pdo = 'Error de conexion';
            echo 'ERROR' . $e->getMessage();
        }
    }

    /**
     * Retorna la variable de conexion.
     *
     * @return conexion_pdo Retorna la conexion a la base de datos.
     */
    public function ConexionRetornada()
    {
        return $this->conexion_pdo;
    }
}

?>
