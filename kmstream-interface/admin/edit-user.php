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
                                $stmt = $mysql->prepare("UPDATE accounts SET username = :user, urank = :urank WHERE ID = :id");
                                $stmt->execute(array(":user" => $_POST["username"], ":urank" => $_POST["urank"], ":id" => $_GET["id"]));
                                header('Location: https://kmskollektiv.de/kmstream-interface/admin/show-user.php');
                            }
                            $stmt = $mysql->prepare("SELECT * FROM accounts WHERE ID = :id");
                            $stmt->execute(array(":id" => $_GET["id"]));
                            $row = $stmt->fetch();
                        } else {
                            ?>
                            <p>Kein Benutzer wurde angefragt</p>
                            <?php
                        }
                    } else {
                        //edit.php
                        ?>
                        <p>Kein Benutzer wurde angefragt</p>
                        <?php
                    }
                    ?>
                    <div class="card-headline">Benutzer bearbeiten:</div>
                    <div class="card-text">
                        <form action="edit-user.php?id=<?php echo $_GET["id"] ?>" method="post">
                            <input class="interface-form" type="text" name="username" value="<?php echo $row["username"] ?>" placeholder="Benutzername" require>
                            <input class="interface-form" type="text" name="urank" value="<?php echo $row["urank"] ?>" placeholder="Benutzer Rang" required>
                            <small style="color: #c6f1e7;">0 = USER // 1 = ADMIN</small>
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