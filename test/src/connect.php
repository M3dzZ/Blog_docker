<?php

$servername = "db";
$dbname = "data";
$name = "root";
$mdp = "password";

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $name, $mdp);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>