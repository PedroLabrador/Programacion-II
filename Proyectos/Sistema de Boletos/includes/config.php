<?php
class Database {
    private static $db;

    public static function getConnection() {
        if (empty(self::$db)) {
            $dsn = 'mysql:host=localhost; dbname=boleteria';
            $user = 'root';
            $password = '1521067';
            try {
                $conn = new PDO($dsn, $user, $password);
                $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
                $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$db = $conn;
            } catch (PDOException $e) {
                echo "Falló en la conexión : ". $e->getMessage();
            }
        }
        return self::$db;
    }
}
