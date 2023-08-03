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
            $sql = "SELECT * FROM pages WHERE id = 3";
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

    <div class="body-content cats-body-content">
        <?=$text?>
        <div class="row">
            <div class="col-lg-6">
                <div class="card text-center">
                    <img class="card-img-top" src="img/a9.jpg">
                    <div class="card-body">
                        <h2 class="card-title">Майя</h2>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card text-center">
                    <img class="card-img-top" src="img/a6.jpg">
                    <div class="card-body">
                        <h2 class="card-title">Вайт</h2>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    <hr />
<?php
require('components/footer.php');
?>
