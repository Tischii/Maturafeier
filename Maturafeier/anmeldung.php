<?php
session_start();
if(!isset($_SESSION['userid'])) {
 die('Bitte zuerst <a href="login.php">einloggen</a>');
}
 
//Abfrage der Nutzer ID vom Login
$userid = $_SESSION['userid'];
$benutzer = $_SESSION['benutzer'];

 
echo "Benutzername des angemeldeten Users: ".$benutzer;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Anmeldung</title>
</head>
<body>
<br>
<a href="logout.php">Logout</a>
<form>
    <label>Anzahl der Personen</label>
    <input type="number" required>
    <input type="submit" value="Senden">
</form>
</body>
</html>