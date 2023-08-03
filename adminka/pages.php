<?php
header('Content-Type: application/json; charset=utf-8');
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "biglap";
if($_SESSION['flag_admin'] == 1 && isset($_SESSION['flag_admin'])) {          
$mysqli = new mysqli($hostname, $username, $password, $dbname);
$res = array();
    if ($mysqli -> connect_error) {
        $res['connect'] = 'Соединение не удалось: %s\n'. $mysqli -> connect_error.'';}
                else {
                    mysqli_set_charset($mysqli, "utf8");
                    $id = $_POST["id"];
                    $sql = "SELECT * FROM pages WHERE id = '$id'";
                    if($result = mysqli_query($mysqli, $sql)){
                        foreach($result as $row){
                            $res['title'] = $row["title"];
                            $res['content'] = $row["content"];
                        }
                    }
                }
            mysqli_close($mysqli);
$json = json_encode($res);
echo $json;
}
?>
