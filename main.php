<?php
require_once 'data_config/session.php';
require_once 'data_config/conn.php';

$query = "SELECT * FROM kategori;";
$stmt = $pdo->prepare($query);
$stmt->execute();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fjell - Send inn</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div id="header">Send inn sak/henvendelse</div>

<a href="history.php">Se historikk</a>

<form action="data_config/logout.php" method="post" class="user">
    <input type="submit" name="submit" value="Logg ut">
</form>

<?php
if (isset($_SESSION["message"])) {
    echo '<p>'.$_SESSION["message"].'</p>';
    unset($_SESSION["message"]);
}
?>

<form action="data_config/insert.php" method="post" id="main">
    <textarea name="beskrivelse" required placeholder="Beskrivelse"></textarea>
    <p>Velg kategori som passer best</p>
    <select name="kategori">
        <?php
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<option value='".$row['ktgr_navn']."'>".$row['ktgr_navn']."</option>";
        }
        ?>
    </select>
    <input type="submit" name="submit" value="Send inn">
</form>

</body>
</html>