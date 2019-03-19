<?php

include_once 'libs/Database.php';

header("Content-Type: application/json; charset=UTF-8");

Database::createDatabaseInstance();

$myObj = null;

if (Checker::areSetAndValidFields($_POST['username'])) {
    if ( Database::areValidCredentials($_POST['username'], $_POST['password']) ) {
        $myObj = array('message' => "Verified", 'success' => true);
    } else {
        $myObj = array('message' => "Unauthorized", 'username' => $_POST['username'], 'success' => false);
    }
} else {
    $myObj = array('message' => 'ERR: missing fields or forbidden characters used.');
}

$myJSON = json_encode($myObj);

echo $myJSON;
?>