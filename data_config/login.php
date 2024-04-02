<?php
//Henter inn fil for session
require_once 'session.php';

//Kjører for post-forespørsel
if (isset($_POST["submit"])) {
    try {
        //Henter inn fil for tilkobling
        require_once 'conn.php';

        //Henter informasjon
        $passord = trim($_POST["passord"]);

        //Tar alt fra bruker
        $query = "SELECT * FROM bruker WHERE epost = :epost;";
        //Gjør klar query
        $stmt = $pdo->prepare($query);
        //Setter parameter
        $stmt->bindParam(":epost", $_POST["epost"]);
        //Kjører query
        $stmt->execute();

        //Sjekker hvis det er reultat av query
        if ($stmt->rowCount() > 0) {
            //Tar resultatet som assosiativ array
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $verify = $result["passord"];
            //Sjekker passordene
            if (password_verify($passord, $verify)) {
                //Sletter session variabler
                session_unset();

                if ($result["arbeider"] === 1) {
                    if ($result["admin"] === 1) {
                        $_SESSION["admin"] = true;
                    }
                    //Fortsett til annen side
                    header("Location: ../reply.php");
                } else {
                    //Setter id i session
                    $_SESSION["id"] = $result["id"];
                    //Fortsett til neste side
                    header("Location: ../main.php");
                }

            } else {
                //Feilmelding og sender tilbake til siden
                $_SESSION["message"] = "Passordet er feil";
                header("Location: ../index.php");
            }
        } else {
            //Feilmelding og sender tilbake til siden
            $_SESSION["message"] = "Epost er ikke funnet";
            header("Location: ../index.php");
        }
    } catch (PDOException $e) {
        //Feilmelding
        die("Error: " . $e->getMessage());
    }
} else {
    //Sender til forsiden
    header("Location: ../index.php");
}
