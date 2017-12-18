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

<a href="logout.php">Logout</a>