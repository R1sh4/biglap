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
                    $title = $_POST["title"];
                    $content = $_POST["content"];
                    $title_old = $_POST["title_old"];
                    $sql = "UPDATE pages SET title = '$title', content = '$content'  WHERE title = '$title_old'"; 
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