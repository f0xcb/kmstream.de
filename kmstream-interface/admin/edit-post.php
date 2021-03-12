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

                <div class="card">
                    <?php
                    if(isset($_GET["id"])){
                        if(!empty($_GET["id"])){
                            require("../../kmstream-includes/mysql.php");
                            if(isset($_POST["submit"])){
                                $stmt = $mysql->prepare("UPDATE kmstream_neuigkeiten SET titel = :title, news_text = :ntext WHERE ID = :id");
                                $stmt->execute(array(":title" => $_POST["title"], ":ntext" => $_POST["ntext"], ":id" => $_GET["id"]));
                                header('Location: https://kmskollektiv.de/kmstream-interface/admin/show-post.php');
                            }
                            $stmt = $mysql->prepare("SELECT * FROM kmstream_neuigkeiten WHERE ID = :id");
                            $stmt->execute(array(":id" => $_GET["id"]));
                            $row = $stmt->fetch();
                        } else {
                            echo "<p>Kein Beitrag wurde angefragt</p>";
                        }
                    } else {
                        echo "<p>Kein Beitrag wurde angefragt</p>";
                    }
                    ?>
                    <div class="card-headline">Beitrag bearbeiten:</div>
                    <div class="card-text">
                        <form action="edit-post.php?id=<?php echo $_GET["id"] ?>" method="post">
                            <input class="interface-form" type="text" name="title" value="<?php echo $row["titel"] ?>" placeholder="Beitrag-Title" require>
                            <textarea style="height: 20em;" class="interface-form" name="ntext" placeholder="Beitrag-Text" required><?php echo $row["news_text"] ?></textarea>
                            <button class="interface-form-button" name="submit" type="submit">Speichern</button>
                        </form>
                    </div>
                </div>

        </div>
    </div>
</div>


<?php include('../../kmstream-includes/footer-template.php'); ?>

</body>
</html>