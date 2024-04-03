<?php
require_once 'session.php';

if (isset($_POST["submit"])) {
    try {
        require_once 'conn.php';

        $query = "UPDATE sak SET losning = :losning, oppklart = 1 WHERE saksnummer = :saksnummer;";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":losning", $_POST["losning"]);
        $stmt->bindParam(":saksnummer", $_POST["nummer"]);
        $stmt->execute();

        header("Location: ../reply.php");
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
} else {
    header("Location: ../reply.php");
}