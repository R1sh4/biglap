<?php
header('Content-Type: application/json; charset=utf-8');
class AddKittens{
    public $Name = '';
    public $Gender = '';
    public $Age = '';
    public $Characteristic = '';
    public $Image = '';
    
    function __construct($Name, $Gender, $Age, $Characteristic, $Image) 
    {
        $this->Name = $Name;
        $this->Gender = $Gender;
        $this->Age = $Age;
        $this->Characteristic = $Characteristic;
        $this->Image = $Image;
    }
    
    function AddKitten() {
        
        $hostname = "localhost";
        $username = "root";
        $password = "";
        $dbname = "biglap";
        $err = array();
        $mysqli = new mysqli($hostname, $username, $password, $dbname);
        if ($mysqli -> connect_error) {
            $err['err_conn'] = 'Соединение не удалось: %s\n'. $mysqli -> connect_error.'';}
        else {
            $name = mysqli_real_escape_string($mysqli, $_POST["Name"]);
            $gender = mysqli_real_escape_string($mysqli, $_POST["Gender"]);
            $age = mysqli_real_escape_string($mysqli, $_POST["Age"]);
            $characteristic = mysqli_real_escape_string($mysqli, $_POST["Characteristic"]);
            $image = mysqli_real_escape_string($mysqli, $_FILES['file']['name']);
            mysqli_set_charset($mysqli, "utf8");
            $sql = "INSERT INTO kittens (name, gender, age, characteristic, image) VALUES ('$name', '$gender', '$age',  '$characteristic', '$image')"; 
            mysqli_query($mysqli, $sql);              
        }
        mysqli_close($mysqli);
        return $err;
    }
}
function CheckData() {
        $err = array();
        if (strlen($_POST["Name"]) < 2) {
            $err['NameLen'] = 'Длина имени должна быть не менее 2-х символов';
        }
        else {
            if (preg_match('/\d/',$_POST["Name"]) != false) {
            $err['NameNum'] = 'В имени не должно быть цифр';
            }
        }
           
        if ($_POST["Gender"] != "Девочка" && $_POST["Gender"] != "Мальчик") {
            $err['Gender'] = 'Введите Девочка либо Мальчик';
        }
        
        return $err;
    }
    session_start();
    if($_SESSION['flag_admin'] == 1 && isset($_SESSION['flag_admin'])) {
        $result = array();
        $result = CheckData();
        if(empty($result)) {
            $path = $_SERVER['DOCUMENT_ROOT'].'/img';
            if(is_file($path.'/' . $_FILES['file']['name'])) {
                $result['err_file_already_exists'] = 'Такой файл уже существует';
            } else {
                move_uploaded_file($_FILES['file']['tmp_name'], $path.'/' . $_FILES['file']['name']);
                if(is_file($path.'/' . $_FILES['file']['name'])) {
                    
                    $addkitten = new AddKittens($_POST["Name"], $_POST["Gender"], $_POST["Age"], $_POST["Characteristic"], $_FILES['file']['name']);
                    $result = $addkitten -> AddKitten();
                } else {
                    $result['err_file'] = 'Файл не создан';
                }
            }
        }
        if(empty($result)) {
            $json = json_encode('ok');
            echo $json;
        }else{
            $json = json_encode($result);
            echo $json;
        }
    }
?>
