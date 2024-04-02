<?php
//Henter inn fil for session
require_once 'session.php';

//Kjører for post-forespørsel
if (isset($_POST["submit"])) {
    try {
        //Henter inn fil for tilkobling
        require_once 'conn.php';

        $pre_query = "SELECT * FROM kategori WHERE ktgr_navn = :navn;";
        $pre_stmt = $pdo->prepare($pre_query);
        $pre_stmt->bindParam(":navn", $_POST["kategori"]);
        $pre_stmt->execute();
        $result = $pre_stmt->fetch(PDO::FETCH_ASSOC);

        $main_query = "INSERT INTO sak (beskrivelse, bruker, oppklart, kategori) 
                    VALUES (:beskrivelse, :bruker, 0, :kategori);";
        $main_stmt = $pdo->prepare($main_query);
        $main_stmt->bindParam(":beskrivelse", $_POST["beskrivelse"]);
        $main_stmt->bindParam(":bruker", $_SESSION["id"]);
        $main_stmt->bindParam(":kategori", $result["ktgr_id"]);
        $main_stmt->execute();

        $new = $pdo->lastInsertId();
        $_SESSION["message"] = "Saksnummeret er $new";
        header("Location: ../main.php");

    } catch (PDOException $e) {
        //Feilmelding
        die("Error: " . $e->getMessage());
    }
} else {
    //Sender tilbake til siden
    header("Location: ../main.php");
}