<?php
header('Content-Type: application/json; charset=utf-8');
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "biglap";
$filename = $_POST["filename"];
$filepath = "../img/$filename";
if($_SESSION['flag_admin'] == 1 && isset($_SESSION['flag_admin'])) {
$mysqli = new mysqli($hostname, $username, $password, $dbname);
    if ($mysqli -> connect_error) {
        $err['connect'] = 'Соединение не удалось: %s\n'. $mysqli -> connect_error.'';}
                else {
                    mysqli_set_charset($mysqli, "utf8");
                    $id = $_POST["id"];
                    $sql = "DELETE FROM kittens WHERE id = '$id'"; 
                    mysqli_query($mysqli, $sql);
                    unlink($filepath);
                }
            mysqli_close($mysqli);
                

    if(count($err) == 0){
        $json = json_encode('ok');
        echo $json;
    }else{
        $json = json_encode($err);
        echo $json;
    }
}
?>