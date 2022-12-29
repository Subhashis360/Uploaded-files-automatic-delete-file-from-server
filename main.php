<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$time = $_POST['time'];

include('connect.php');

$photo = $_FILES['upload']['name'];
// folder url
$u = "uploded";
// temp file for upload
$aa = $_FILES['upload']['tmp_name'];
//Upload to server
$uploaded =  move_uploaded_file($aa, "$u/".$photo);
//convert main url
$url = "$u/".$photo;
//session to download the file


$result = mysqli_query($conn, "SELECT * FROM `data` WHERE url='$url'");

$noname = "nothing";

while ($row = mysqli_fetch_array($result)) {
    $noname = $row['url'];
}
$rand = rand();

session_start();
$_SESSION['value'] = $url;
$_SESSION['time'] = $time;


if ($noname == $url) {
    echo "File Found On the server download now >>>";

} elseif ($noname = "nothing") {
    echo "Uploaded SuccessFul";
    mysqli_query($conn, "INSERT INTO `data`(`url`) VALUES ('$url')");
    mysqli_query($conn, "CREATE EVENT delete_event$rand ON SCHEDULE AT CURRENT_TIMESTAMP + INTERVAL $time MINUTE DO DELETE FROM data WHERE `url`='$url';");
    exec("php server.php &");
     
} else {
    echo "Uploaded SuccessFul";
    mysqli_query($conn, "INSERT INTO `data`(`url`) VALUES ('$url')");
    mysqli_query($conn, "CREATE EVENT delete_event$rand ON SCHEDULE AT CURRENT_TIMESTAMP + INTERVAL $time MINUTE DO DELETE FROM data WHERE `url`='$url';");
    exec("php server.php &");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="<?php echo $_SESSION['value']; ?>" Download>Download File</a>
</body>
</html>