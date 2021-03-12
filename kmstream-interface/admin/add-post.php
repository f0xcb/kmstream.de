<!--
  _                  _                                 _
 | |                | |                               | |
 | | ___ __ ___  ___| |_ _ __ ___  __ _ _ __ ___    __| | ___
 | |/ / '_ ` _ \/ __| __| '__/ _ \/ _` | '_ ` _ \  / _` |/ _ \
 |   <| | | | | \__ \ |_| | |  __/ (_| | | | | | || (_| |  __/
 |_|\_\_| |_| |_|___/\__|_|  \___|\__,_|_| |_| |_(_)__,_|\___|

 2020 (c) kmstream.de
-->

<?php

require("../../kmstream-includes/mysql.php"); require("../../kmstream-includes/rank-template.php");

session_start();
if(!isset($_SESSION["username"])){
    header("Location: https://kmskollektiv.de/kmstream-includes/login.php");
    exit;
}

if (!getRank($_SESSION["username"]) >= ADMIN){
    header('Location: https://kmskollektiv.de/kmstream-includes/index.php');
    exit;
}

$sessionID = $_SESSION["username"];

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>kmstream // interface</title>

    <?php include('../../kmstream-includes/style-head-template.php'); ?>

</head>
<body>

<div class="container-1">
    <h1>kmstream mediakollektiv</h1>
    <p>// interface</p>
</div>

<?php
if(isset($_POST["submit"])){
    $stmt = $mysql->prepare("INSERT INTO kmstream_neuigkeiten (titel, news_text, author, created_at) VALUES (:titel, :news_text, :author, :now)");
    $stmt->bindParam(":titel", $_POST["titel"], PDO::PARAM_STR);
    $stmt->bindParam(":news_text", $_POST["news_text"], PDO::PARAM_STR);
    $stmt->bindParam(":author", $sessionID, PDO::PARAM_STR);
    $now = time();
    $stmt->bindParam(":now", $now, PDO::PARAM_STR);
    $stmt->execute();
    echo "<script>alert('Der Beitrag wurde hinzugefügt!');</script>";
}
?>

<div id="content">
    <div class="row">
        <div class="col-2">
            <?php include('../../kmstream-includes/navigator-interface-template.php'); ?>
        </div>
        <div class="col-10">
            <div class="card">
                <div class="card-headline">Beitrag hinzufügen:</div>
                <div class="card-text">
                    <form action="add-post.php" method="post">
                        <input class="interface-form" type="text" name="titel" placeholder="Beitrag-Titel" required><br>
                        <textarea class="interface-form" name="news_text" placeholder="Beitrag" cols="30" rows="10"></textarea><br>
                        <button class="interface-form-button" type="submit" name="submit">Hinzufügen</button><br>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include('../../kmstream-includes/footer-template.php'); ?>

</body>
</html>