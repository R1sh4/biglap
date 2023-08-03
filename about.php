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
            $sql = "SELECT * FROM pages WHERE id = 2";
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
<div class="body-content about-body-content">
        <div class="about-img">
            <img src="img/ab.jpg">
        </div>
        <div class="text">
            <?=$text?>
        </div>
    </div>
    <hr />
<?php              
 require('components/footer.php');
?>