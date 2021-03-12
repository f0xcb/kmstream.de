<!--
  _                  _                                 _
 | |                | |                               | |
 | | ___ __ ___  ___| |_ _ __ ___  __ _ _ __ ___    __| | ___
 | |/ / '_ ` _ \/ __| __| '__/ _ \/ _` | '_ ` _ \  / _` |/ _ \
 |   <| | | | | \__ \ |_| | |  __/ (_| | | | | | || (_| |  __/
 |_|\_\_| |_| |_|___/\__|_|  \___|\__,_|_| |_| |_(_)__,_|\___|

 2020 (c) kmstream.de
-->
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>kmstream // neuigkeiten</title>

    <?php include('kmstream-includes/style-head-template.php'); ?>

</head>
<body>

<div class="container-1">
    <h1>kmstream mediakollektiv</h1>
    <p>// neuigkeiten</p>
</div>

<?php include('kmstream-includes/navigator-template.php'); ?>

<div id="content">
    <div class="row">
        <?php
        if(isset($_GET["id"])){
            require("./kmstream-includes/mysql.php");
            $stmt = $mysql->prepare("SELECT * FROM kmstream_neuigkeiten WHERE ID = :id");
            $stmt->bindParam(":id", $_GET["id"], PDO::PARAM_INT);
            $stmt->execute();
            $count = $stmt->rowCount();
            if($count == 0){
                echo "Die News wurde nicht gefunden.";
            } else {
                $row = $stmt->fetch();
                ?>

                <div class="card">
                    <img src="kmstream-content/assets/media/picture/twitter_header_photo_2.png">
                    <div class="card-headline"><?php echo $row["titel"] ?></div>
                    <div class="card-text"><?php echo $row["news_text"] ?></div>
                    <div class="card-footer"><?php echo date("d.m.Y", $row["created_at"]) ?> // <?php echo $row["author"] ?></div>
                </div>

                <?php
            }
        } else {
            require("./kmstream-includes/mysql.php");
            $stmt = $mysql->prepare("SELECT * FROM kmstream_neuigkeiten ORDER BY created_at DESC");
            $stmt->execute();
            $count = $stmt->rowCount();
            if($count == 0){
                echo "Es wurden keine News gefunden.";
            } else {
                while($row = $stmt->fetch()){
                    ?>
                    <div class="col-4">
                        <div class="card">
                            <a href="news.php?id=<?php echo $row["ID"] ?>">
                                <img src="kmstream-content/assets/media/picture/twitter_header_photo_2.png">
                                <div class="card-headline card-center"><?php echo $row["titel"] ?></div>
                                <div class="card-text card-justify"><?php echo substr($row["news_text"], 0, 150) ?></div>
                                <div class="card-footer card-center">Erstellt am: <?php echo date("d.m.Y H:i", $row["created_at"]) ?></div>
                            </a>
                        </div>
                    </div>
                    <?php
                }
            }
        }
        ?>
    </div>
</div>

<?php include('kmstream-includes/footer-template.php'); ?>

</body>
</html>