<?php
$title = 'Авторизация';

$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "biglap";

require('components/header.php');

if (isset($_POST['btn_ok'])) { 
    $err = array();
        if (empty($_POST['login'])) {
            $err['login'] = 'Введите логин';
        }
    if (empty($_POST['password'])) {
            $err['password'] = 'Введите пароль';
        }
    
    if(count($err) == 0)
    {
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
            $sql = 'SELECT login, password, flag_admin FROM users';
            $result = mysqli_query($mysqli, $sql);
            while ($row = $result -> fetch_assoc())
            {
                if($row['login'] == $_POST['login'])
                {
                    if($row['password'] == $_POST['password'])
                    {
                        if($row['flag_admin'] != 0) 
                        {
                            session_start();
                            $_SESSION['authorized'] = 1;
                            $_SESSION['flag_admin'] = 1;
                            mysqli_close($mysqli);
                            header('Location: adminka/admin.php');
                        }
                        else
                        {
                            session_start();
                            $_SESSION['authorized'] = 1;
                            $_SESSION['flag_admin'] = 0;
                            $_SESSION['login'] = $row['login'];
                            mysqli_close($mysqli);
                            header('Location: requests.php');
                        }
                    }
                    $err['password'] = 'Неверный пароль';
                }
            }
            if(empty($err['password']))
            $err['login'] = 'Неверный логин';
            mysqli_close($mysqli);
        }
    }
        
    else
        header('Location: '.$_SERVER['PHP_SELF'].'?message=err');
}
?>
<div class="body-content">
    <div class="textcenter aut-text">
        <?php
        if(isset($_GET['message']))
        {
            if(isset($err['conn']))
               {
                   echo '<h1 style="color: red;">Ошибка подключения</h1>';
               } 
        }     
              ?>
        <h1>Авторизуйтесь</h1>

        <form name="myform" action="<?=$_SERVER['PHP_SELF']?>" method="POST">
            <?php
            if (isset($err['login'])) echo '<p style="color: red;">'.$err['login'].'</p>';
              ?>
            <p>
                <input type='text' placeholder='Логин' class='input' id="login" value="<?=(isset($_POST['login']) ? $_POST['login'] : '')?>" name='login' required><br>
            </p>
            <?php
            if (isset($err['password'])) echo '<p style="color: red;">'.$err['password'].'</p>';
              ?>
            <p>
                <input type='password' placeholder='Пароль' class='input' id="password" value="<?=(isset($_POST['password']) ? $_POST['password'] : '')?>" name='password' required><br>
            </p>
            <p>Нет учетной записи?</p>
            <a class="nav-link" href="" data-toggle="modal" data-target="#addModal">Зарегистрируйтесь</a>
            <input type='submit' name="btn_ok" value='Войти' class='button'>
        </form>
    </div>
</div>

<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="addModalLabel">Регистрация</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <p>Логин</p>
                <p class="alert" id="Loginp"></p>
                <p>
                    <input type="text" name="Login" id="Login" value="" placeholder="Не менее 5-ти символов" />
                </p>
                <p>Пароль</p>
                <p class="alert" id="Passwordp"></p>
                <p>
                    <input type="text" name="Password" id="Password" value="" placeholder="Не менее 5-ти символов" />
                </p>
                <p>Имя</p>
                <p class="alert" id="PersonNamep"></p>
                <p>
                    <input type="text" name="PersonName" id="PersonName" value="" placeholder="Не менее 2-х символов" />
                </p>
                <p>Фамилия</p>
                <p class="alert" id="PersonSurnamep"></p>
                <p>
                    <input type="text" name="PersonSurname" id="PersonSurname" value="" placeholder="Не менее 2-х символов" />
                </p>
                <p>Номер телефона</p>
                <p class="alert" id="Numberp"></p>
                <p><input type="tel" name="Number" id="Number" value="" placeholder="Номер телефона БЕЗ 8" />
                </p>
                <p>Почта email</p>
                <p class="alert" id="emailp"></p>
                <p><input type="email" name="email" id="email" value="" placeholder="Пример 'name@mail.ru'" />
                </p>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                    <button type="button" class="btn btn-primary" id="btn-confirm">Подтвердить</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function CheckForm(data) {
        var login = document.querySelector('#Login');
        login.style = "border-color: black";
        document.getElementById("Loginp").textContent = '';
        var login = document.querySelector('#Password');
        login.style = "border-color: black";
        document.getElementById("Passwordp").textContent = '';
        var login = document.querySelector('#PersonName');
        login.style = "border-color: black";
        document.getElementById("PersonNamep").textContent = '';
        var login = document.querySelector('#PersonSurname');
        login.style = "border-color: black";
        document.getElementById("PersonSurnamep").textContent = '';
        var login = document.querySelector('#Number');
        login.style = "border-color: black";
        document.getElementById("Numberp").textContent = '';

        if (data['LoginRepeat'] != null) {
            var login = document.querySelector('#Login');
            login.style = "border-color: red";
            document.getElementById("Loginp").textContent = data['LoginRepeat'];
        }
        if (data['LoginLen'] != null) {
            var login = document.querySelector('#Login');
            login.style = "border-color: red";
            document.getElementById("Loginp").textContent = data['LoginLen'];
        }
        if (data['PasswordLen'] != null) {
            var login = document.querySelector('#Password');
            login.style = "border-color: red";
            document.getElementById("Passwordp").textContent = data['PasswordLen'];
        }
        if (data['PersonNameNum'] != null) {
            var login = document.querySelector('#PersonName');
            login.style = "border-color: red";
            document.getElementById("PersonNamep").textContent = data['PersonNameNum'];
        }
        if (data['PersonNameLen'] != null) {
            var login = document.querySelector('#PersonName');
            login.style = "border-color: red";
            document.getElementById("PersonNamep").textContent = data['PersonNameLen'];
        }
        if (data['PersonSurnameNum'] != null) {
            var login = document.querySelector('#PersonSurname');
            login.style = "border-color: red";
            document.getElementById("PersonSurnamep").textContent = data['PersonSurnameNum'];
        }
        if (data['PersonSurnameLen'] != null) {
            var login = document.querySelector('#PersonSurname');
            login.style = "border-color: red";
            document.getElementById("PersonSurnamep").textContent = data['PersonSurnameLen'];
        }
        if (data['NumberSymbol'] != null) {
            var login = document.querySelector('#Number');
            login.style = "border-color: red";
            document.getElementById("Numberp").textContent = data['NumberSymbol'];
        }
        if (data['NumberLen'] != null) {
            var login = document.querySelector('#Number');
            login.style = "border-color: red";
            document.getElementById("Numberp").textContent = data['NumberLen'];
        }

        if (data['email'] != null) {
            var login = document.querySelector('#email');
            login.style = "border-color: red";
            document.getElementById("emailp").textContent = data['email'];
        } else {
            var login = document.querySelector('#email');
            login.style = "border-color: black";
            document.getElementById("emailp").textContent = '';
        }
    }
    $(document).ready(function() {
        $('#btn-confirm').click(function() {

            var Login = $('#Login').val();
            var Password = $('#Password').val();
            var flag_admin = 0;
            var PersonName = $('#PersonName').val();
            var PersonSurname = $('#PersonSurname').val();
            var Number = $('#Number').val();
            var email = $('#email').val();
            var message = "";
            $.ajax({
                type: "POST", 
                url: 'adminka/add-users.php', 
                data: {
                    Login: Login,
                    Password: Password,
                    flag_admin: flag_admin,
                    PersonName: PersonName,
                    PersonSurname: PersonSurname,
                    Number: Number,
                    email: email,
                    message: message
                }, 
                success: function(data) {
                    if (data === 'ok') {
                        $('#addModal').modal('hide');
                        document.getElementById("login").value = Login;
                        document.getElementById("password").value = Password;

                    } else {
                        CheckForm(data);
                    }
                }
            });
        });
    });

</script>


<hr />
<?php
require('components/footer.php');
?>
