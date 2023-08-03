<?php

$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "biglap";

$mysqli = new mysqli($servername, $username, $password, $dbname);
            
        if ($mysqli -> connect_error) 
        {
            $err['conn'] = 'Ошибка подключения';
            mysqli_close($mysqli);
            header('Location: '.$_SERVER['PHP_SELF'].'?message=err');
        }
        else
        {
            $sql = "SELECT * FROM pages WHERE id = 1";
            $res = $mysqli -> query($sql);
            if ($res -> num_rows > 0)
            {
                mysqli_set_charset($mysqli, "utf8");
                while ($row = $res -> fetch_assoc())
                {
                   $title = $row['title'];
                    $text = $row['content'];
                }
            }
            mysqli_close($mysqli);    
                
        }  
require('components/header.php');
require('components/menu.php');
?>
  <div class="body-content">
        <div class="jumbotron">
            <h1>Большие лапки</h1>
            <h3>Кошачий питомник породы Мейн-кун</h3>
            <a href="kittens.php" class="btn btn-primary">Выбрать котенка</a>
        </div>
        <div class="textcenter">
            <h3><?=$text?></h3>
        </div>
    </div>
    <hr />
<?php
require('components/footer.php');
?>