<?php

include_once '../libs/Database.php';
include_once '../libs/Checker.php';

header("Content-Type: application/json; charset=UTF-8");

Database::createDatabaseInstance();

if (Checker::areSetAndValidFields($_GET['username'])) {
    $retrievedData = Database::query(sprintf("SELECT * from users WHERE username='%s'", $_GET['username']));
    if ($retrievedData) {
        foreach ($retrievedData as $row) {
            echo json_encode(array('username' => $row['username'], 'email' => $row['email'], 'birthdate' => $row['birthdate']));
        }
    } else {
        echo json_encode(array('message' => 'ERR: user not found.'));
    }
} else {
    echo json_encode(array('message' => 'ERR: missing fields or invalid characters used.'));
}


?>