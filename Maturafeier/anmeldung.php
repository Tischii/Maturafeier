<?php
session_start();
if(!isset($_SESSION['userid'])) {
 die('Bitte zuerst einloggen - <a href="login.php">Login</a>');
}
 
//Abfrage der Nutzer ID vom Login
$userid = $_SESSION['userid'];
$benutzer = $_SESSION['benutzer'];

 
echo "Benutzername des angemeldeten Users: ".$benutzer;


$pdo = new PDO('mysql:host=localhost;dbname=itp_mtf18', 'root', '');

if(isset($_GET['anmeldung'])) {
    $statement = $pdo->prepare("SELECT * FROM user WHERE id = :userid");
    $user = $statement->fetch();

    if($user != false){
        $anzahl = $_POST['anzahl'];
        $sql = "INSERT INTO teilnehmer (id, anzahl) VALUES ($userid, $anzahl)";
        $pdo->exec($sql);
    }else{
        $info = "Bereits Teilnehmer angegeben";
    }


}



?>

<!DOCTYPE html>
<html>
<head>
    <title>Anmeldung</title>
</head>
<body>
    <br>
    <a href="logout.php">Logout</a>
    <form action="?anmeldung=1" method="post">
        <label>Anzahl der Personen</label>
        <input type="number" name="anzahl" required>
        <input type="submit" value="Senden">
    </form>
    <?php
    if(isset($info)) {
        echo '<span>'.$info.'<br></span>';
    }
    ?>
</body>
</html>