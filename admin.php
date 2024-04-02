<?php
//Henter inn filer for tilkobling og session
require_once 'data_config/session.php';
require_once 'data_config/conn.php';

if ($_SESSION["admin"] !== true or !isset($_SESSION["admin"])) {
    header("Location: index.php");
}

$query = "SELECT * FROM sak;";
$stmt = $pdo->prepare($query);
$stmt->execute();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fjell</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div id="header">Admin</div>

<a href="reply.php">Tilbake</a>

<?php
if ($stmt->rowCount()) {
?>
    <table>
        <tr>
            <th>
                Saksnummer
            </th>
            <th>
                Status
            </th>
            <th>
                (Bytt status)
            </th>
            <th>
                (Slett)
            </th>
        </tr>
        <?php
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        ?>
            <tr>
                <td><?php echo $row["saksnummer"]?></td>
                <td><?php if ($row["oppklart"] === 1) {echo "Oppklart";} else {echo "Ikke oppklart";} ?></td>
                <td>
                    <form action="<?php if ($row["oppklart"] === 1) {echo "data_config/off.php";} else {echo "data_config/on.php";} ?>" method="post">
                        <input type="hidden" name="nummer" value="<?php echo $row["saksnummer"]?>">
                        <input type="submit" name="submit" value="Bytt status">
                    </form>
                </td>
                <td>
                    <form action="data_config/delete.php" method="post">
                        <input type="hidden" name="nummer" value="<?php echo $row["saksnummer"]?>">
                        <input type="submit" name="submit" value="Slett">
                    </form>
                </td>
            </tr>
        <?php
        }
        ?>
    </table>
<?php
} else {
    echo "<p>Ingenting funnet</p>";
}
?>
</body>
</html>