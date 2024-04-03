<?php
require_once 'data_config/session.php';
require_once 'data_config/conn.php';

$query = "SELECT * FROM sak WHERE oppklart = 0;";
$stmt = $pdo->prepare($query);
$stmt->execute();

$comp_query = "SELECT sak.saksnummer, sak.beskrivelse, sak.bruker, kategori.ktgr_navn FROM sak
                INNER JOIN kategori ON sak.kategori = kategori.ktgr_id WHERE sak.oppklart = 0;";
$comp_stmt = $pdo->prepare($comp_query);
$comp_stmt->execute();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fjell - Svar</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div id="header">Svar sak/henvendelse</div>

<a href="overview.php">Se oversikt</a>

<p>Tilgjengelige saker ligger samlet nederst</p>

<?php
if (isset($_SESSION["admin"]) and $_SESSION["admin"] === true) {
    echo '<a href="admin.php">Admin</a>';
}
?>

<form action="data_config/logout.php" method="post" class="user">
    <input type="submit" name="submit" value="Logg ut">
</form>

<?php
if ($stmt->rowCount() > 0) {
?>
    <form action="data_config/response.php" method="post" id="main">
        <textarea name="losning" required placeholder="Løsning"></textarea>
        <p>Velg saksnummer</p>
        <select name="nummer">
            <?php
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value='".$row['saksnummer']."'>".$row['saksnummer']."</option>";
            }
            ?>
        </select>
        <input type="submit" name="submit" value="Send inn">
    </form>

    <div id="container">
    <?php while ($row = $comp_stmt->fetch(PDO::FETCH_ASSOC)) {?>

        <div class="box">
            Saksnummer: <?php echo $row["saksnummer"] ?><br>
            Kategori: <?php echo $row["ktgr_navn"] ?><br>
            Bruker-id: <?php echo $row["bruker"] ?><br>
            <p>Beskrivelse:<br> <?php echo $row["beskrivelse"] ?></p>
        </div>

<?php
    }
    echo "</div>";
} else {
    echo "<p>Ingen sak er tilgjengelig for svar</p>";
}
?>
</body>
</html>