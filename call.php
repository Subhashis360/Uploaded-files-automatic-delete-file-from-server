<?php
$abc = realpath('C:\xampp\htdocs\upload\server.php');
$x = exec('php server.php &');
echo $x;
?>