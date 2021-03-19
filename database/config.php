<?php

define("dbserver", "localhost");
define("dbusername", "root");
define("dbpassword", "");
define("dbname", "dbwebdev");

try {
    $pdo = new PDO("mysql:host=" . dbserver . ";dbname=" . dbname , dbusername, dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $exception){
    die("Could not connect to the database" . $exception->getMessage());
}