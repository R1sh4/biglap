<?php
header('Content-Type: application/json; charset=utf-8');
class UpdateKittens{
    public $Name = '';
    public $id = '';
    public $Gender = '';
    public $Age = '';
    public $Characteristic = '';
    public $Image = '';
    
    function __construct($Name, $Gender, $Age, $Characteristic, $Image, $id) 
    {
        $this->Name = $Name;
        $this->id = $id;
        $this->Gender = $Gender;
        $this->Age = $Age;
        $this->Characteristic = $Characteristic;
        $this->Image = $Image;
    }
    
    function UpdateKitten() {
        
        $hostname = "localhost";
        $username = "root";
        $password = "";
        $dbname = "biglap";  
        $mysqli = new mysqli($hostname, $username, $password, $dbname);
        if ($mysqli -> connect_error) {
            $err['err_conn'] = 'Соединение не удалось: %s\n'. $mysqli -> connect_error.'';
        } else {
            $name = mysqli_real_escape_string($mysqli, $_POST["Name"]);
            $id = mysqli_real_escape_string($mysqli, $_POST["id"]);
            $gender = mysqli_real_escape_string($mysqli, $_POST["Gender"]);
            $age = mysqli_real_escape_string($mysqli, $_POST["Age"]);
            $characteristic = mysqli_real_escape_string($mysqli, $_POST["Characteristic"]);
                
            if(empty($_FILES['file']['name'])) {
                mysqli_set_charset($mysqli, "utf8");
                $sql = "UPDATE kittens SET name = '$name', gender = '$gender', age = '$age', characteristic = '$characteristic' WHERE id = '$id'"; 
                mysqli_query($mysqli, $sql);
            }else {
                
                $sql = "SELECT * FROM kittens WHERE id = '$id'";
                    if($result = mysqli_query($mysqli, $sql)){
                        foreach($result as $row){
                            $filename = $row["image"];
                        }
                    }
                $filepath = "../img/$filename";
                unlink($filepath);
                $image = mysqli_real_escape_string($mysqli, $_FILES['file']['name']);
                mysqli_set_charset($mysqli, "utf8");
                $sql = "UPDATE kittens SET name = '$name', gender = '$gender', age = '$age', characteristic = '$characteristic', image = '$image' WHERE id = '$id'"; 
                mysqli_query($mysqli, $sql);
            }
                     
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
            if($_FILES['file'] != null) { 
                $path = $_SERVER['DOCUMENT_ROOT'].'/img';
                if(is_file($path.'/' . $_FILES['file']['name'])) {
                    $result['err_file_already_exists'] = 'Такой файл уже существует';
                } else {
                    move_uploaded_file($_FILES['file']['tmp_name'], $path.'/' . $_FILES['file']['name']);
                    if(is_file($path.'/' . $_FILES['file']['name'])) {
                    
                        $updatekitten = new UpdateKittens($_POST["Name"], $_POST["Gender"], $_POST["Age"], $_POST["Characteristic"], $_FILES['file']['name'], $_POST["id"]);
                        $result = $updatekitten -> UpdateKitten();
                    } else {
                    $result['err_file'] = 'Файл не создан';
                    }
                }
            }else {
                $updatekitten = new UpdateKittens($_POST["Name"], $_POST["Gender"], $_POST["Age"], $_POST["Characteristic"], $_FILES['file']['name'], $_POST["id"]);
                $result = $updatekitten -> UpdateKitten();
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
