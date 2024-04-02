<?php
//Henter inn filer for tilkobling og session
require_once 'data_config/session.php';
require_once 'data_config/conn.php';

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

<div id="header">Velkommen</div>

<?php
//Hvis det er melding fra annen php fil, så vises det og slettes fra session
if (isset($_SESSION["message"])) {
    echo '<p>'.$_SESSION["message"].'</p>';
    unset($_SESSION["message"]);
}
?>

<!--Form for innlogging-->
<form action="data_config/login.php" method="post" class="user">
    Logg inn
    <input type="text" name="epost" placeholder="Epost" required>

    <input type="password" name="passord" placeholder="Passord" required>

    <input type="submit" name="submit" value="Logg inn">
</form>

<!--Form for oppretting av konto-->
<form action="data_config/user.php" method="post" class="user">
    Opprett bruker

    <input type="text" name="navn" required placeholder="Navn">

    <input type="text" name="epost" required placeholder="Epost">

    <input type="password" name="passord" required placeholder="Passord">

    <input type="password" name="bekreft" required placeholder="Bekreft passord">

    <input type="submit" name="submit" value="Lag bruker">
</form>

</body>
</html>