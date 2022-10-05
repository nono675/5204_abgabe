<?php
// Hier werden die Daten empfangen
$key = $_POST["send"];
$myArr = ["antipasto" => "Bruschetta","primo" => "Spaghetti aglio","secondo" => "Fegato alla veneziana"];
header('Content-Type: application/json');
echo json_encode($myArr[$key]);
?>