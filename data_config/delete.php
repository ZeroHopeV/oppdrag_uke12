<?php
require_once 'session.php';

if (isset($_POST["submit"])) {
    try {
        require_once 'conn.php';

        $query = "DELETE FROM sak WHERE saksnummer = :saksnummer;";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":saksnummer", $_POST["nummer"]);
        $stmt->execute();

        header("Location: ../admin.php");
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
} else {
    header("Location: ../admin.php");
}