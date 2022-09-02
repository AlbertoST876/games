<?php

namespace Games\Classes;
use Exception;
use mysqli;

/**
 * Clase que contiene toda la información para realizar la conexión con la Base de Datos y determinadas instrucciones
 */
class DB {
    // Rellene los siguientes campos para la conexión a su Base de Datos
    private string $hostname = "localhost"; // Servidor - Por defecto: "localhost"
    private string $username = "root"; // Usuario - Por defecto: "root"
    private string $password = ""; // Contraseña
    private string $database = "es_games"; // Base de Datos - Por defecto: "es_games"

    private mysqli $connect;

    public function __construct() {
        try {
            $this -> connect = new mysqli($this -> hostname, $this -> username, $this -> password, $this -> database);
            $this -> connect -> set_charset("UTF8");

            if (mysqli_connect_errno()) throw new Exception("No se puede conectar a la Base de Datos");
        } catch (Exception $error) {
            throw new Exception($error -> getMessage());
        }
    }

    public function clearString(string $string) {
        return $this -> connect -> real_escape_string($string);
    }

    private function executeStatement(string $query = "", array $params = []) {
        try {
            $stmt = $this -> connect -> prepare($query);

            if ($stmt === false) throw new Exception("No se puede preparar la sentencia: " . $query);
            if ($params) call_user_func_array(array($stmt, "bind_param"), $params);

            $stmt -> execute();

            return $stmt;
        } catch (Exception $error) {
            throw new Exception($error -> getMessage());
        }
    }

    public function Select(string $query = "", array $params = []) {	
        try {
            $stmt = $this -> executeStatement($query, $params);		
            $result = $stmt -> get_result() -> fetch_all(MYSQLI_ASSOC);				
            $stmt -> close();

            return $result;		
        } catch (Exception $error) {
            throw new Exception($error -> getMessage());
        }

        return false;
    }

    public function Insert(string $query = "", array $params = []) {	
        try {	
            $stmt = $this -> executeStatement($query, $params);
            $stmt -> close();

            return true;
        } catch (Exception $error) {
            throw new Exception($error -> getMessage());
        }

        return false;	
    }

    public function Update(string $query = "", array $params = []) {
        try {
            $this -> executeStatement($query, $params) -> close();
            
            return true;
        } catch (Exception $error) {
            throw new Exception($error -> getMessage());
        }

        return false;
    }

    public function Remove(string $query = "", array $params = []) {
        try {
            $this -> executeStatement($query, $params) -> close();

            return true;
        } catch (Exception $error) {
            throw new Exception($error -> getMessage());
        }

        return false;
    }
}

?>