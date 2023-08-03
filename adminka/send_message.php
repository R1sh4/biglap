<?php
header('Content-Type: application/json; charset=utf-8');
if($_SESSION['flag_admin'] == 1 && isset($_SESSION['flag_admin'])) {
require('../cmail.php');
    $cm = new CMail($_POST["PersonName"], $_POST["PersonSurname"], $_POST["Number"], $_POST["Info"], $_POST["email"]); // функция CMail, которая формирует массив ошибок и сообщение для отправки на e-mail
    $r = $cm->sendMail();
    $m = $r['sendm'];
    $err = $r['err'];
    if(count($err) == 0){
        $json = json_encode('ok');
        echo $json;
    }else{
        $json = json_encode($err);
        echo $json;
    }
}
?>
