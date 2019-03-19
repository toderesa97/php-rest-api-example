<?php
include_once 'Checker.php';

class Database {
    private static $pdo = null;
    public static function createDatabaseInstance() {
        try {
            if (Database::$pdo == null) {
                Database::$pdo = new pdo( 'mysql:host=127.0.0.1:3306;dbname=api',
                    'root',
                    '',
                    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
                //die(json_encode(array('outcome' => true)));
            }
        } catch(Exception $e) {
            die(json_encode(array('outcome' => false, 'message' => 'Unable to connect')));
        }
    }
    /* method fetchs directly all the query inserted by user */
    public static function areValidCredentials($user, $pass) {
        $pass = hash("sha256", $pass);
        $query = "select * from users where username='$user';";
        $info = Database::query($query);
        if ($info) {
            foreach ($info as $key) {
                if ($key['username'] == $user && $key['password'] == $pass) {
                    return true;
                }
            }
        }
        return false;
    }

    public static function query($query) {
        if (Database::$pdo == null) {
            return null;
        }

        $info = Database::$pdo->query($query);
        if ($info) {
            return $info->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return null;
        }
    }

    public static function exec($query) {
        if (Database::$pdo == null) {
            return;
        }
        Database::$pdo->exec($query);
    }

    public static function existsPrimaryKeyOn($table, $primaryKeyFieldName, $value) {
        $query = "select * from $table where $primaryKeyFieldName='$value';";
        $info = Database::query($query);
        if ($info) {
            return true;
        }
        return false;
    }
}
?>