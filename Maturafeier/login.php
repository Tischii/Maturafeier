<?php
session_start();
$errorMessage= '';
$pdo = new PDO('mysql:host=localhost;dbname=itp_mtf18', 'root', '');

if(isset($_GET['login'])) {
 $benutzer = $_POST['benutzer'];
 $passwort = $_POST['passwort'];

 $statement = $pdo->prepare("SELECT * FROM user WHERE benutzer = :benutzer");
 $result = $statement->execute(array('benutzer' => $benutzer));
 $user = $statement->fetch();

 //Überprüfung des Passworts
 if ($user !== false && password_verify($passwort, $user['passwort'])) {
 $_SESSION['userid'] = $user['id'];
 $_SESSION['benutzer'] = $user['benutzer'];
 header('Location: geheim.php');
 } else {
     if($benutzer != null) {
         $errorMessage = "Benutzer ist ungültig<br>";
     }
     elseif ($passwort != null && password_verify($passwort, $user['passwort']) == false){
         $errorMessage = "Passwort ist ungültig<br>";
     }
     elseif ($passwort == null || $benutzer == null){
         $errorMessage = "Felder müssen ausgefüllt werden<br>";
     }
 }
}

?>
<!DOCTYPE html>
<html> 
<head>
  <title>Login</title> 
</head> 
<body>

<!DOCTYPE html>
<style>
.form {
  position: relative;
  margin-left: auto;
  margin-right: auto;
  margin-top: 10%;
  z-index: 1;
  background: #FFFFFF;
  width: 350px;
  padding: 30px;
  border-top-left-radius: 3px;
  border-top-right-radius: 3px;
  border-bottom-left-radius: 3px;
  border-bottom-right-radius: 3px;
  text-align: center;
}
.form .thumbnail {
  background: #143744;
  width: 150px;
  height: 150px;
  margin: 0 auto 30px;
  padding: 50px 30px;
  border-top-left-radius: 100%;
  border-top-right-radius: 100%;
  border-bottom-left-radius: 100%;
  border-bottom-right-radius: 100%;
  box-sizing: border-box;
}
.form .thumbnail img {
  display: block;
  width: 100%;
}
.form input {
  outline: 0;
  background: #f2f2f2;
  width: 100%;
  border: 0;
  margin: 0 0 15px;
  padding: 15px;
  border-top-left-radius: 3px;
  border-top-right-radius: 3px;
  border-bottom-left-radius: 3px;
  border-bottom-right-radius: 3px;
  box-sizing: border-box;
  font-size: 14px;
}
.button-form {
  outline: 0;
  background: #143744;
  color: #000;
  width: 100%;
  border: 0;
  padding: 15px;
  border-top-left-radius: 3px;
  border-top-right-radius: 3px;
  border-bottom-left-radius: 3px;
  border-bottom-right-radius: 3px;
  font-size: 14px;
  cursor: pointer;
}
.form .message {
  margin: 15px 0 0;
  color: #b3b3b3;
  font-size: 12px;
}
.form .message a {
  color: #EF3B3A;
  text-decoration: none;
}
.form .register-form {
  display: none;
}


*{

  font-family: "Roboto", sans-serif;


}
/* END Form */
/* Demo Purposes */
body {

  background-image: url("img/homeBLUR.png");
  background-repeat: no-repeat;
  background-position: center center;
  background-attachment: fixed;
  background-size: cover;
  font-family: "Roboto", sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}
body:before {
  content: "";
  position: fixed;
  top: 0;
  left: 0;
  display: block;
  background: rgba(255, 255, 255, 0);
  width: 100%;
  height: 100%;
}

#video {
  z-index: -99;
  position: fixed;
  top: 50%;
  left: 50%;
  min-width: 100%;
  min-height: 100%;
  width: auto;
  height: auto;
  -webkit-transform: translateX(-50%) translateY(-50%);
  transform: translateX(-50%) translateY(-50%);
}

.logo{
    position: relative;
    width: 55px;
    vertical-align: middle;
    top:-13px;
  }
  .nav.navbar-nav.navbar-right li a {
      color: white;
  }

    .navbar {
      margin-bottom: 0;
      border-radius: 0;
      background-color: #143744;
      border-color: #143744;
      color: white;
      text-decoration-color: white;
    }
.row.content {height:50em; }



</style>

<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Maturafeier 2k18</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
  <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900'>
  <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Montserrat:400,700'>
  <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>

<body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">

      <a class="navbar-brand" href="home.html" ><img src="img/logo_white.png" class="logo"></img></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">

      <ul class="nav navbar-nav navbar-right">
        <li><a href="Home.html">HOME</a></li>
        <li><a href="Info.html">INFO</a></li>
        <li><a href="Fotos.html">FOTOS</a></li>
        <li><a href="login.php">LOGIN</a></li>

    </div>
  </div>
</nav>


<div class="form" >
  <div class="thumbnail"><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/169963/hat.svg"/></div>
  <form class="login-form" action="?login=1" method="post">
    <input type="text" placeholder="username" name="benutzer"/>
    <input type="password" placeholder="password" name="passwort"/>
      <span>
          <?php
              if(isset($errorMessage)) {
                  echo $errorMessage.'<br>';
              }
          ?>
      </span>
    <input class="button-form" type="submit" value="Abschicken">
  </form>
</div>

<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script  src="js/index.js"></script> 

</body>
</html>
