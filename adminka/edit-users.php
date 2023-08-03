<?php
header('Content-Type: application/json; charset=utf-8');
class UpdateUsers{
    public $Login = '';
    public $Password = '';
    public $flag_admin = '';
    public $PersonName = '';
    public $PersonSurname = '';
    public $Number = '';
    public $email = '';
    public $message = '';
    public $Login_old = '';
    
    function __construct($Login, $Password, $flag_admin, $PersonName, $PersonSurname, $Number, $email, $message, $Login_old) 
    {
        $this->Login = $Login;
        $this->Password = $Password;
        $this->flag_admin = $flag_admin;
        $this->PersonName = $PersonName;
        $this->PersonSurname = $PersonSurname;
        $this->Number = $Number;
        $this->email = $email;
        if(!isset($message))
        {
            $this->message = "";
        }
        else
        $this->message = $message;
        $this->Login_old = $Login_old;
    }
    
    function UpdateUser() {
        $err = array();
        if (strlen($_POST["Login"]) < 5) {
            $err['LoginLen'] = 'Длина логина должна быть не менее 5-ти символов';
        }
        if (strlen($_POST["Password"]) < 5) {
            $err['PasswordLen'] = 'Длина пароля должна быть не менее 5-ти символов';
        }
        if (strlen($_POST["PersonName"]) < 2) {
            $err['PersonNameLen'] = 'Длина имени должна быть не менее 2-х символов';
        }
        else {
            if (preg_match('/\d/',$_POST["PersonName"]) != false) {
            $err['PersonNameNum'] = 'В имени не должно быть цифр';
        }
        }
           
        if (strlen($_POST["PersonSurname"]) < 2) {
            $err['PersonSurnameLen'] = 'Длина фамилии должна быть не менее 2-х символов';
        }
        else {
            if (preg_match('/\d/',$_POST["PersonSurname"]) != false) {
            $err['PersonSurnameNum'] = 'В фамилии не должно быть цифр';
        }
        }
           
        if (strlen($_POST["Number"]) != 10) {
            $err['NumberLen'] = 'Длина номера должна быть 10 цифр';
        }
        else {
            if (!preg_match('/^[0-9]{10,10}+$/',$_POST["Number"])) {
            $err['NumberSymbol'] = 'В номере должны быть только цифры';
        }
        }
           
        if (!preg_match('/^[a-zA-Z]\w*@[a-zA-Z]\w*\.[a-zA-Z]+$/',$_POST["email"])) {
            $err['email'] = 'Не корректный email';
        }
        if(count($err) == 0)
        {
            $hostname = "localhost";
            $username = "root";
            $password = "";
            $dbname = "biglap";
            
            $flag = true;
            $mysqli = new mysqli($hostname, $username, $password, $dbname);
            if ($mysqli -> connect_error) {
            $err['connect'] = 'Соединение не удалось: %s\n'. $mysqli -> connect_error.'';
            }
            else {
                if($_POST[Login] != $_POST[Login_old]) {
                    $login = $_POST["Login"];
                    $sql = "SELECT * FROM users WHERE login = '$login'";
                    $res = $mysqli -> query($sql);
                    if ($res -> num_rows > 0) { 
                        $err['LoginRepeat'] = 'Пользователь с таким логином уже существует';
                        $flag = false;
                     }
                 }
                 if($flag) {
                     $login_old = mysqli_real_escape_string($mysqli, $_POST["Login_old"]);
                     $login = mysqli_real_escape_string($mysqli, $_POST["Login"]);
                     $password = mysqli_real_escape_string($mysqli, $_POST["Password"]);
                     $flag_admin = mysqli_real_escape_string($mysqli, $_POST["flag_admin"]);
                     $personname = mysqli_real_escape_string($mysqli, $_POST["PersonName"]);
                     $personsurname = mysqli_real_escape_string($mysqli, $_POST["PersonSurname"]);
                     $number = mysqli_real_escape_string($mysqli, $_POST["Number"]);
                     $email = mysqli_real_escape_string($mysqli, $_POST["email"]);
                     $message = mysqli_real_escape_string($mysqli, $_POST["message"]);
                     mysqli_set_charset($mysqli, "utf8");
                     $sql = "UPDATE users SET login = '$login', password = '$password', flag_admin = '$flag_admin', name = '$personname', surname = '$personsurname', number = '$number', email = '$email', message = '$message' WHERE login = '$login_old'"; 
                     mysqli_query($mysqli, $sql);
                }
            }
            mysqli_close($mysqli);
        }

        
        $result['err'] = $err;
        return $result;
    }
}
if($_SESSION['flag_admin'] == 1 && isset($_SESSION['flag_admin'])) {
    $updateuser = new UpdateUsers($_POST["Login"], $_POST["Password"], $_POST["flag_admin"], $_POST["PersonName"], $_POST["PersonSurname"], $_POST["Number"], $_POST["email"], $_POST["message"], $_POST["Login_old"]);
    $result = $updateuser -> UpdateUser();
    $err = $result['err'];
if(count($err) == 0){
    $json = json_encode('ok');
echo $json;
}else{
    $json = json_encode($err);
    echo $json;
}
}
    ?>
