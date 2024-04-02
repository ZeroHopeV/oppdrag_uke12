<?php
//Henter inn filer for tilkobling og session
require_once 'session.php';
require_once 'conn.php';

//Kjører for post-forespørsel
if (isset($_POST["submit"])) {
    try {
        //Restarter hele session og sender til forsiden
        session_unset();
        session_destroy();
        header("Location: ../index.php");
    } catch (PDOException $e) {
        //Feilmelding
        die("Error: " . $e->getMessage());
    }
} else {
    //Sender til forsiden
    header("Location: ../index.php");
}
