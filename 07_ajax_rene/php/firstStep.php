<?php
$myArr = ["antipasto" => "Bruschetta","primo" => "Spaghetti aglio","secondo" => "Fegato alla veneziana"];
header('Content-Type: application/json');
echo json_encode($myArr);
?>