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

<div id="content">
    <div class="row">
        <div class="col-2">
            <?php include('../../kmstream-includes/navigator-interface-template.php'); ?>
        </div>
        <div class="col-10">

                <div class="row">
                    <?php
                    require("../../kmstream-includes/mysql.php");

                    if(isset($_GET["del"])){
                        if(!empty($_GET["del"])){
                            $stmt = $mysql->prepare("DELETE FROM kmstream_neuigkeiten WHERE ID = :id");
                            $stmt->execute(array(":id" => $_GET["del"]));
                            header('Location: https://kmskollektiv.de/kmstream-interface/admin/show-post.php');
                        }
                    }

                    $stmt = $mysql->prepare("SELECT * FROM kmstream_neuigkeiten");
                    $stmt->execute();
                    while($row = $stmt->fetch()){
                        ?>
                        <div class="col-5">
                            <div class="card card-bottom-spacecadet">
                                <div class="card-headline card-center">ID: <?php echo $row["ID"] ?></div>
                                <div class="card-text card-center"><?php echo $row["titel"] ?></div>
                                <div class="card-text card-center"><?php echo substr($row["news_text"], 0, 150) ?></div>
                                <a href="edit-post.php?id=<?php echo $row["ID"] ?>"><button class="card-user-edit">Bearbeiten</button></a>
                                <a href="show-post.php?del=<?php echo $row["ID"] ?>"><button class="card-user-delete">Löschen</button></a>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>

        </div>
    </div>
</div>


<?php include('../../kmstream-includes/footer-template.php'); ?>

</body>
</html>