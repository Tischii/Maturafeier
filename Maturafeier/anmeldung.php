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
    $statement = $pdo->prepare("SELECT * FROM teilnehmer WHERE id = :userid");
    $result = $statement->execute(array(':userid' => $userid));
    $anmeldung = $statement->fetch();

    if($anmeldung !== false){
       
    }else{
        $anzahl = $_POST['anzahl'];
        $sql = "INSERT INTO teilnehmer (id, anzahl) VALUES ($userid, $anzahl)";
        $pdo->exec($sql);
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Anmeldung</title>
    <a href="logout.php">Logout</a>
</head>
<body>
    <?php
        $statement = $pdo->prepare("SELECT * FROM teilnehmer WHERE id = :userid");
        $result = $statement->execute(array(':userid' => $userid));
        $anmeldung = $statement->fetch();
        if ($anmeldung == false) {
            include("anmeldefeld.html");
        }else{
            $statement = $pdo->prepare("SELECT anzahl FROM teilnehmer WHERE id = :userid");
            $result = $statement->execute(array(':userid' => $userid));
            while($row = $statement->fetch()) {
                $info = $row['anzahl']." Teilnehmer sind bereits angemeldet.";
            }
        }
        if(isset($info)) {
            echo '<span>'.$info.'<br></span>';
        }
    ?>
</body>
</html>