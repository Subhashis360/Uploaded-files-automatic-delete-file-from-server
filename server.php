<?php
session_start();
$url = $_SESSION['value'];
$time = $_SESSION['time'];
$sectime = ($time*60);
$realpath = realpath($url);
sleep($sectime);
if (file_exists($realpath)) {
unlink($realpath);
} else {
    echo "No file exist";
}
?>