<?php

define("USER", 0);
define("ADMIN", 1);

$host = "10.35.46.80";
$port = "3306";
$name = "k127775_kmstreamDB";
$user = "k127775_proddb";
$passwort = "6mZ@h52w";
try {
    $mysql = new PDO("mysql:host=$host;port=$port;dbname=$name", $user, $passwort);
} catch (PDOException $e) {
    echo "SQL Error: " . $e->getMessage();
}

function getRank($username){
    $host = "10.35.46.80";
    $port = "3306";
    $name = "k127775_kmstreamDB";
    $user = "k127775_proddb";
    $passwort = "6mZ@h52w";
    try {
        $mysql = new PDO("mysql:host=$host;port=$port;dbname=$name", $user, $passwort);
    } catch (PDOException $e) {
        echo "SQL Error: " . $e->getMessage();
    }

    $stmt = $mysql->prepare("SELECT * FROM accounts WHERE username = :user");
    $stmt->bindParam(":user", $username, PDO::PARAM_STR);
    $stmt->execute();
    $row = $stmt->fetch();
    return $row["urank"];
}

function isBanned($username){
    if(getRank($username) == -1){
        return true;
    } else {
        return false;
    }
}