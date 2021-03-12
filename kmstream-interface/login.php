<!--
  _                  _                                 _
 | |                | |                               | |
 | | ___ __ ___  ___| |_ _ __ ___  __ _ _ __ ___    __| | ___
 | |/ / '_ ` _ \/ __| __| '__/ _ \/ _` | '_ ` _ \  / _` |/ _ \
 |   <| | | | | \__ \ |_| | |  __/ (_| | | | | | || (_| |  __/
 |_|\_\_| |_| |_|___/\__|_|  \___|\__,_|_| |_| |_(_)__,_|\___|

 2020 (c) kmstream.de
-->

<?php require("../kmstream-includes/mysql.php"); ?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>kmstream // anmelden</title>

    <?php include('../kmstream-includes/style-head-template.php'); ?>

</head>
<body>

<div class="container-1">
    <h1>kmstream mediakollektiv</h1>
    <p>// anmelden</p>
</div>

<?php include('../kmstream-includes/navigator-template.php'); ?>

<?php
if(isset($_POST["submit"])){
    $stmt = $mysql->prepare("SELECT * FROM accounts WHERE username = :user");
    $stmt->bindParam(":user", $_POST["username"]);
    $stmt->execute();
    $count = $stmt->rowCount();
    if($count == 1){
        $row = $stmt->fetch();
        if(password_verify($_POST["pw"], $row["password"])){
            session_start();
            $_SESSION["username"] = $row["username"];
            header("Location: https://kmskollektiv.de/kmstream-interface/index.php");
        } else {
            echo "Der Login ist fehlgeschlagen";
        }
    } else {
        echo "Der Login ist fehlgeschlagen";
    }
}
?>

<div id="content">
    <form action="login.php" method="post" class="login-form">
        <div class="login-img">
            <img src="https://kmskollektiv.de/kmstream-content/assets/media/picture/logo_transparent.png" alt="kmstream_logo" class="login-logo">
        </div>

        <div class="login-container">
            <input class="login-input" type="text" name="username" placeholder="Benutzername" required><br>
            <input class="login-input" type="password" name="pw" placeholder="Passwort" required><br>
            <button class="login-button" type="submit" name="submit">Einloggen</button>
        </div>
    </form>

    <div class="login-footer">
        <a href="https://kmskollektiv.de/kmstream-interface/register.php">Noch keinen Account?</a>
    </div>
</div>

<?php include('../kmstream-includes/footer-template.php'); ?>

</body>
</html>