<?php

include_once 'libs/Database.php';
include_once 'libs/Checker.php';

header("Content-Type: application/json; charset=UTF-8");

Database::createDatabaseInstance();

if (Checker::areSetFields($_POST['username'], $_POST['password'], $_POST['email'], $_POST['birthdate'])) {
    if (Database::existsPrimaryKeyOn("users", "username", $_POST['username'])) {
        echo json_encode(array('message' => 'ERR: user '.$_POST['username'].' already exists.'));
    } else {
        if (! Checker::areValidStrings($_POST['username'], $_POST['password'], $_POST['email'])) {
            echo json_encode(array('message' => 'ERR: forbidden characters used.'));
        } else {
            Database::exec(sprintf("INSERT INTO users (username, password, email, birthdate) VALUES ('%s', '%s', '%s', '%s')",
                $_POST['username'],
                hash("sha256", $_POST['password']),
                $_POST['email'],
                $_POST['birthdate']));
            echo json_encode(array('message' => 'OK: user '.$_POST['username'].' inserted.'));
        }
    }
} else {
    echo json_encode(array('message' => 'ERR: missing fields.'));
}

?>