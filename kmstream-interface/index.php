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

require("../kmstream-includes/mysql.php"); require("../kmstream-includes/rank-template.php");

session_start();
if(!isset($_SESSION["username"])){
    header("Location: https://kmskollektiv.de/kmstream-interface/login.php");
    exit;
}
$sessionID = $_SESSION["username"];

$stmt = $mysql->prepare("SELECT * FROM accounts");
$stmt->execute();
$registerd_user = $stmt->rowCount();

$stmt1 = $mysql->prepare("SELECT * FROM kmstream_neuigkeiten");
$stmt1->execute();
$postings = $stmt1->rowCount();

$stmt2 = $mysql->prepare("SELECT * FROM kmstream_neuigkeiten WHERE author = :usern");
$stmt2->bindParam(":usern", $sessionID);
$stmt2->execute();
$personal_postings = $stmt2->rowCount();
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>kmstream // interface</title>

    <?php include('../kmstream-includes/style-head-template.php'); ?>

</head>
<body>

<div class="container-1">
    <h1>kmstream mediakollektiv</h1>
    <p>// interface</p>
</div>

<div id="content">
    <div class="row">
        <div class="col-2">
            <?php include('../kmstream-includes/navigator-interface-template.php'); ?>
        </div>
        <div class="col-10">


            <div class="row">
                <?php if (getRank($_SESSION["username"]) >= ADMIN){ ?>
                <div class="col-5">
                    <div class="card card-bottom-sandybrown">
                        <p><i class="fas fa-user"></i></p>
                        <div class="card-text card-center"><?php echo $registerd_user; ?></div>
                    </div>
                </div>
                <?php } ?>
                <div class="col-5">
                    <div class="card card-bottom-sandybrown">
                        <p><i class="fas fa-file-alt"></i></p>
                        <div class="card-text card-center"><?php echo $postings; ?></div>
                    </div>
                </div>
                <?php if (getRank($_SESSION["username"]) >= ADMIN){ ?>
                <div class="col-5">
                    <div class="card card-bottom-sandybrown">
                        <p><i class="fas fa-pen-square"></i></p>
                        <div class="card-text card-center"><?php echo $personal_postings ?></div>
                    </div>
                </div>
                <?php } ?>
                <div class="col-5">
                    <div class="card card-bottom-sandybrown">
                        <p><i class="far fa-user-circle"></i></p>
                        <div class="card-text card-center"><?php echo $sessionID; ?></div>
                    </div>
                </div>
            </div>

            <br>

        </div>
    </div>
</div>


<?php include('../kmstream-includes/footer-template.php'); ?>

</body>
</html>