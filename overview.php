<?php
require_once 'data_config/session.php';
require_once 'data_config/conn.php';

$query = "SELECT sak.saksnummer, sak.beskrivelse, sak.losning, sak.oppklart, sak.bruker, kategori.ktgr_navn FROM sak 
            INNER JOIN kategori ON sak.kategori = kategori.ktgr_id;";
$stmt = $pdo->prepare($query);
$stmt->execute();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fjell - Oversikt</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div id="header">Oversikt</div>

<a href="reply.php">Tilbake</a>

<?php
if ($stmt->rowCount() > 0) {
    ?>
    <div id="container">
        <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
            <div class="box">
                Saksnummer: <?php echo $row["saksnummer"] ?><br>
                Kategori: <?php echo $row["ktgr_navn"] ?><br>
                Bruker-id: <?php echo $row["bruker"] ?><br>
                <?php if ($row["oppklart"] === 1) {echo "Oppklart";} else {echo "Ikke oppklart";} ?><br>
                <p>Beskrivelse:<br> <?php echo $row["beskrivelse"] ?></p><br>
                <?php if ($row["losning"] !== null) {echo "<p>Løsning:<br>".$row['losning']."</p>";} ?>
            </div>
            <?php
        }
        ?>
    </div>
    <?php
} else {
    echo "<p>Ingenting funnet</p>";
}
?>

</body>
</html>