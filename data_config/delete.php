<?php
//Henter inn fil for session
require_once 'session.php';

//Kjører for post-forespørsel
if (isset($_POST["submit"])) {
    try {
        //Henter inn fil for tilkobling
        require_once 'conn.php';

        $query = "DELETE FROM sak WHERE saksnummer = :saksnummer;";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":saksnummer", $_POST["nummer"]);
        $stmt->execute();

        header("Location: ../admin.php");
    } catch (PDOException $e) {
        //Feilmelding
        die("Error: " . $e->getMessage());
    }
} else {
    //Sender tilbake til siden
    header("Location: ../admin.php");
}