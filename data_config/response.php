<?php
//Henter inn fil for session
require_once 'session.php';

//Kjører for post-forespørsel
if (isset($_POST["submit"])) {
    try {
        //Henter inn fil for tilkobling
        require_once 'conn.php';

        $query = "UPDATE sak SET losning = :losning, oppklart = 1 WHERE saksnummer = :saksnummer;";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":losning", $_POST["losning"]);
        $stmt->bindParam(":saksnummer", $_POST["nummer"]);
        $stmt->execute();

        header("Location: ../reply.php");
    } catch (PDOException $e) {
        //Feilmelding
        die("Error: " . $e->getMessage());
    }
} else {
    //Sender tilbake til siden
    header("Location: ../reply.php");
}