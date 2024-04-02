<?php
//Henter inn fil for session
require_once 'session.php';

//Kjører for post-forespørsel
if (isset($_POST["submit"])) {
    try {
        //Henter inn fil for tilkobling
        require_once 'conn.php';

        //Tar passordene og fjerner mellomrom på starten og slutten av string
        $passord = trim($_POST["passord"]);
        $bekreft = trim($_POST["bekreft"]);

        //Sjekker hvis passordene er like
        if ($passord !== $bekreft) {
            //Feilmelding og sender tilbake til siden
            $_SESSION["message"] = "Passordene er ikke like";
            header("Location: ../index.php");
        } else {
            //Hasher passordet
            $hash = password_hash($passord, PASSWORD_DEFAULT);

            //Setter informasjon i kunder
            $query = "INSERT INTO bruker (navn, epost, passord) VALUES (:navn, :epost, :passord);";
            //Gjør klar query
            $stmt = $pdo->prepare($query);
            //Setter parameter
            $stmt->bindParam(":navn", $_POST["navn"]);
            $stmt->bindParam(":epost", $_POST["epost"]);
            $stmt->bindParam(":passord", $hash);
            //Kjører query
            $stmt->execute();

            //Sletter session variabler
            session_unset();
            //Setter id i session
            $_SESSION["id"] = $pdo->lastInsertId();
            //Fortsett til neste side
            header("Location: ../main.php");
        }
    } catch (PDOException $e) {
        //Feilmelding
        die("Error: " . $e->getMessage());
    }
} else {
    //Sender til forsiden
    header("Location: ../index.php");
}
