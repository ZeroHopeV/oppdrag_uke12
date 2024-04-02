<?php

//Localhost, databasenavn, brukernavn og passord
$db = "mysql:host=localhost;dbname=sakdb";
$dbusername = "root";
$dbpwd = "";

try {
    //Kobler til databasen med pdo
    $pdo = new PDO($db, $dbusername, $dbpwd);
    //Aktivere håndtering av feilmeldinger
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    //Feilmelding
    echo "Error: " . $e->getMessage();
}
