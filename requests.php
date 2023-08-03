<?php
$title = 'Отправка заявки';

$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "biglap";

if (isset($_POST['btn_ok'])) { // если была нажата кнопка "Отправить"
    require('cmail.php');
    $cm = new CMail($_POST['PersonName'], $_POST['PersonSurname'], $_POST['Number'], $_POST['Info'], $_POST['email']); // функция CMail, которая формирует массив ошибок и сообщение для отправки на e-mail
    $r = $cm->sendMail();
    $m = $r['sendm'];
    $err = $r['err'];
    if(count($err) == 0)
        if(m) {
            $mysqli = new mysqli($servername, $username, $password, $dbname);
            
        if ($mysqli -> connect_error) 
        {
            $err['conn'] = 'Ошибка подключения';
            mysqli_close($mysqli);
            header('Location: '.$_SERVER['PHP_SELF'].'?message=err');
        }
        else
        {
            session_start();
            $login = $_SESSION['login'];
            $sql = "UPDATE users SET send_message = 1 WHERE login = '$login'"; 
            mysqli_query($mysqli, $sql);
            $info = $_POST['Info'];
            $sql = "UPDATE users SET message = '$info' WHERE login = '$login'";
            mysqli_query($mysqli, $sql);
            mysqli_close($mysqli);
        }
            header('Location: '.$_SERVER['PHP_SELF'].'?message=ok');
        }    
        else
            header('Location: '.$_SERVER['PHP_SELF'].'?message=err');
}
    session_start();
    if($_SESSION['authorized'] != 1)
        header('Location: authorization.php');
    else {
        $mysqli = new mysqli($servername, $username, $password, $dbname);
            
        if ($mysqli -> connect_error) 
        {
            $err['conn'] = 'Ошибка подключения';
            mysqli_close($mysqli);
            header('Location: '.$_SERVER['PHP_SELF'].'?message=err');
        }
        else
        {
            mysqli_set_charset($mysqli, "utf8");
            $login = $_SESSION['login'];
            $sql = "SELECT name, surname, number, email, message FROM users WHERE login = '$login'";
            $result = mysqli_query($mysqli, $sql);
            while ($row = $result -> fetch_assoc()) {
                $name = $row['name'];
                $surname = $row['surname'];
                $number = $row['number'];
                $email = $row['email'];
                $info = $row['message'];
            }
        }
    }

    
require('components/header.php');
require('components/menu.php');
?>
<div class="body-content request-body-content">
    <h1>Заявка</h1>
    <?php
        if(isset($_GET['message']))
            if($_GET['message'] == 'ok')
                echo '<h2 style="color: green;">Заявка успешно отправлена</h2>';
            else echo '<h2 style="color: red;">Ошибка отправки</h2>';
        ?>
    <h2>Заполните поля</h2>
    <form name="myform" action="<?=$_SERVER['PHP_SELF']?>" method="POST">
        <div class="container-request">
            <div class="row">
                <div class="col-lg-6">
                    <p>Имя</p>
                    <?php
                            if (isset($err['PersonNameLen'])) echo '<p style="color: red;">'.$err['PersonNameLen'].'</p>';

                            if (isset($err['PersonNameNum'])) echo '<p style="color: red;">'.$err['PersonNameNum'].'</p>';
                        ?>
                    <p>
                        <input type="text" name="PersonName" value="<?php if (isset($_POST['PersonName'])) echo $_POST['PersonName']; if ($name != "") echo $name; ?>" placeholder="Не менее 2-х символов" <?php if (isset($err['PersonNameLen']) or isset($err['PersonNameNum'])) echo 'style="border-color: red"'; ?> />
                    </p>
                    <p>Фамилия</p>
                    <?php
                            if (isset($err['PersonNameSurnameLen'])) echo '<p style="color: red;">'.$err['PersonNameSurnameLen'].'</p>';

                            if (isset($err['PersonNameSurnameNum'])) echo '<p style="color: red;">'.$err['PersonNameSurnameNum'].'</p>';
                        ?>
                    <p>
                        <input type="text" name="PersonSurname" value="<?php if (isset($_POST['PersonSurname'])) echo $_POST['PersonSurname']; if ($surname != "") echo $surname; ?>" placeholder="Не менее 2-х символов" <?php if (isset($err['PersonNameSurnameLen']) or isset($err['PersonNameSurnameNum'])) echo 'style="border-color: red"'; ?> />
                    </p>
                    <p>Номер телефона</p>
                    <?php
                            if (isset($err['NumberLen'])) echo '<p style="color: red;">'.$err['NumberLen'].'</p>';

                            if (isset($err['NumberSymbol'])) echo '<p style="color: red;">'.$err['NumberSymbol'].'</p>';
                        ?>
                    <p><input type="tel" name="Number" value="<?php if (isset($_POST['Number'])) echo $_POST['Number']; if ($number != "") echo $number; ?>" placeholder="Номер телефона БЕЗ 8" <?php if (isset($err['NumberLen']) or isset($err['NumberSymbol'])) echo 'style="border-color: red"'; ?> />
                    </p>
                    <p>Почта email</p>
                    <?php
                            if (isset($err['email'])) echo '<p style="color: red;">'.$err['email'].'</p>';
                        ?>
                    <p><input type="email" name="email" value="<?php if (isset($_POST['email'])) echo $_POST['email']; if ($email != "") echo $email; ?>" placeholder="Пример 'name@mail.ru'" <?php if (isset($err['email'])) echo 'style="border-color: red"'; ?> />
                    </p>
                </div>
                <div class="col-lg-6">
                    <p>Расскажите о себе</p>
                    <p>
                        <textarea name="Info" cols="30" rows="9" value="" placeholder="Это учитывается при выборе владельца для котенка"><?php if (isset($_POST['Info'])) echo $_POST['Info']; if ($info != "") echo $info; ?></textarea>
                    </p>
                </div>
            </div>
            <p><input type="submit" name="btn_ok" value="Отправить" /></p>
        </div>
    </form>
</div>
<hr />

<?php
require('components/footer.php');
?>
