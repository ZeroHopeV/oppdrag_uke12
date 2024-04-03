<?php
require_once 'session.php';

if (isset($_POST["submit"])) {
    try {
        require_once 'conn.php';

        $passord = trim($_POST["passord"]);

        $query = "SELECT * FROM bruker WHERE epost = :epost;";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":epost", $_POST["epost"]);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $verify = $result["passord"];

            if (password_verify($passord, $verify)) {
                session_unset();

                if ($result["arbeider"] === 1) {
                    if ($result["admin"] === 1) {
                        $_SESSION["admin"] = true;
                    }
                    header("Location: ../reply.php");
                } else {
                    $_SESSION["id"] = $result["id"];
                    header("Location: ../main.php");
                }

            } else {
                $_SESSION["message"] = "Passordet er feil";
                header("Location: ../index.php");
            }
        } else {
            $_SESSION["message"] = "Epost er ikke funnet";
            header("Location: ../index.php");
        }
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
} else {
    header("Location: ../index.php");
}
