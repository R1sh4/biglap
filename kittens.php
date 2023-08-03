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
            $sql = "SELECT * FROM pages WHERE id = 4";
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

<div class="body-content kittens-body-content">
    <?=$text?>
    <div class="row">
        <?php
            $mysqli = new mysqli($servername, $username, $password, $dbname);
            
        if ($mysqli -> connect_error) 
        {
            $err['conn'] = 'Ошибка подключения';
            mysqli_close($mysqli);
            header('Location: '.$_SERVER['PHP_SELF'].'?message=err');
        }
        else
        {
            $sql = "SELECT * FROM kittens";
            $res = $mysqli -> query($sql);
            if ($res -> num_rows > 0)
            {
                mysqli_set_charset($mysqli, "utf8");
                while ($row = $res -> fetch_assoc())
                {
                    echo '<div class="col-lg-3">
            <div class="card text-center">
                <img class="card-img-top" src="img/'.$row['image'].'">
                <div class="card-body">
                    <h2 class="card-title">'.$row['name'].'</h2>
                    <h3 class="card-subtitle">'.$row['gender'].' '.$row['age'].'</h3>
                    <h4 class="card-text">'.$row['characteristic'].'</h4>
                    <a href="authorization.php" class="btn btn-primary">Подать заявку</a>
                </div>
            </div>
        </div>';
                }
            }
            mysqli_close($mysqli);    
                
        }  
            ?>
        
    </div>
</div>
<hr />
<?php
require('components/footer.php');
?>
