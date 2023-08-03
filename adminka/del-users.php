<?php
header('Content-Type: application/json; charset=utf-8');
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "biglap";
if($_SESSION['flag_admin'] == 1 && isset($_SESSION['flag_admin'])) {
$mysqli = new mysqli($hostname, $username, $password, $dbname);
    if ($mysqli -> connect_error) {
        $err['connect'] = 'Соединение не удалось: %s\n'. $mysqli -> connect_error.'';}
                else {
                    mysqli_set_charset($mysqli, "utf8");
                    $login = $_POST["Login"];
                    $sql = "DELETE FROM users WHERE login = '$login'"; 
                    mysqli_query($mysqli, $sql);
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
