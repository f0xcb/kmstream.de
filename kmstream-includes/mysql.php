<?php
/*
* kmstream.de-v3 - mysql.php
*
* 2020 (c) by bambulemule
*/

$host = "<your-ip>";
$port = "3306";
$name = "<db-name>";
$user = "<db-user>";
$passwort = "<db-password>";
try {
    $mysql = new PDO("mysql:host=$host;port=$port;dbname=$name", $user, $passwort);
} catch (PDOException $e) {
    echo "SQL Error: " . $e->getMessage();
}