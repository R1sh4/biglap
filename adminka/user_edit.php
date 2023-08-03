<?php
$title = 'Редактирование пользователей';

$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "biglap";
session_start();
if($_SESSION['authorized'] != 1 || !isset($_SESSION['authorized']))
    header('Location: ../authorization.php');
if($_SESSION['flag_admin'] != 1 && isset($_SESSION['flag_admin']))
    header('Location: ../kittens.php');
require($_SERVER['DOCUMENT_ROOT']."/components/header.php");
?>

<div class="body-content user-edit-body-content">

    <h1>Администраторы</h1>
    <div class="table-responsive">
        <table class="table table-sm table-bordered">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Логин</th>
                    <th scope="col">Пароль</th>
                    <th scope="col">Имя</th>
                    <th scope="col">Фамилия</th>
                    <th scope="col">Номер</th>
                    <th scope="col">email</th>
                    <th scope="col">Редактирование</th>
                    <th scope="col">Удаление</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $mysqli = new mysqli($hostname, $username, $password, $dbname);
                if ($mysqli -> connect_error) 
                printf("Соединение не удалось: %s\n", $mysqli -> connect_error);
                    else{
                $sql = "SELECT * FROM users WHERE flag_admin = '1' ";
                $res = $mysqli -> query($sql);
                if ($res -> num_rows > 0) {
                    for($i = 1; $i <= $res -> num_rows; $i++) {
                        $row = $res -> fetch_assoc();
                        if($row['login'] == 'admin') {
                            echo '<tr>
                            <th>'.$i.'</th>
                            <td>'.$row['login'].'</td>
                            <td>'.$row['password'].'</td>
                            <td>'.$row['name'].'</td>
                            <td>'.$row['surname'].'</td>
                            <td>'.$row['number'].'</td>
                            <td>'.$row['email'].'</td>
                            <td></td>
                            <td></td>
                            </tr>';
                        }else {
                            echo '<tr>
                        <th>'.$i.'</th>
                        <td id="logina'.$i.'">'.$row['login'].'</td>
                        <td id="passworda'.$i.'">'.$row['password'].'</td>
                        <td id="namea'.$i.'">'.$row['name'].'</td>
                        <td id="surenamea'.$i.'">'.$row['surname'].'</td>
                        <td id="numbera'.$i.'">'.$row['number'].'</td>
                        <td id="emaila'.$i.'">'.$row['email'].'</td>
                        <td><button type="button" class="btn btn-primary" data-toggle="modal" value=a'.$i.' data-target="#addModal" data-type="admin_edit"> Редактировать </button></td>
                        <td><button type="button" class="btn btn-primary btn_del" value=a'.$i.'>Удалить</button></td>
                        </tr>';
                        }
                    }   
                }
                        mysqli_close($mysqli);
                    }
            ?>
            </tbody>
        </table>
    </div>
    <h1>Пользователи <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#addModal" data-type="add">Добавить</button> </h1>
    <div class="table-responsive">
        <table class="table table-hover table-sm table-bordered">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Логин</th>
                    <th scope="col">Пароль</th>
                    <th scope="col">Имя</th>
                    <th scope="col">Фамилия</th>
                    <th scope="col">Номер</th>
                    <th scope="col">email</th>
                    <th scope="col">О себе</th>
                    <th scope="col">Отправить заявку</th>
                    <th scope="col">Редактирование</th>
                    <th scope="col">Удаление</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $mysqli = new mysqli($hostname, $username, $password, $dbname);
                if ($mysqli -> connect_error) 
                printf("Соединение не удалось: %s\n", $mysqli -> connect_error);
                    else{
            $sql = "SELECT * FROM users WHERE flag_admin = '0' ";
            $res = $mysqli -> query($sql);
                if ($res -> num_rows > 0) {
            for($i = 1; $i <= $res -> num_rows; $i++) {
                $row = $res -> fetch_assoc();
                if($row['send_message'] == 1) {
                    $sm = '<button type="button" class="btn btn-primary btn_send" value='.$i.'>Отправить</button>';
                }else {
                    $sm = "Заявка не была отправлена";
                }
                echo '<tr>
                    <th>'.$i.'</th>
                    <td id="login'.$i.'">'.$row['login'].'</td>
                    <td id="password'.$i.'">'.$row['password'].'</td>
                    <td id="name'.$i.'">'.$row['name'].'</td>
                    <td id="surename'.$i.'">'.$row['surname'].'</td>
                    <td id="number'.$i.'">'.$row['number'].'</td>
                    <td id="email'.$i.'">'.$row['email'].'</td>
                    <td id="info'.$i.'"><textarea name="Info" cols="30" rows="3" readonly>'.$row['message'].'</textarea></td>
                    <td>'.$sm.'</td>
                    <td><button type="button" class="btn btn-primary btn_edit" value='.$i.' data-toggle="modal" data-target="#addModal" data-type="edit">Редактировать </button></td>
                    <td><button type="button" class="btn btn-primary btn_del" value='.$i.'>Удалить</button></td>
                </tr>';
                }
                }
                        mysqli_close($mysqli);
                    }
            ?>
            </tbody>
        </table>
    </div>
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="addModalLabel">Добавление пользователя</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-6">
                                <p><input class="form-check-input" type="checkbox" name="flag-admin" id="flag-admin" value="1">Администратор</p>
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

                            </div>
                            <div class="col-lg-6">

                                <p>Расскажите о себе</p>
                                <p>
                                    <textarea name="message" id="message" cols="35" rows="16" value="" placeholder="Это учитывается при выборе владельца для котенка"></textarea>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                        <button type="button" class="btn btn-primary" id="btn-add">Добавить</button>
                        <button type="button" class="btn btn-primary" id="btn-edit" hidden>Изменить</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $('#addModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Кнопка, что спровоцировало модальное окно
            var recipient = button.data('type');
            var modal = $(this);
            if (recipient == 'add') {
                modal.find('.modal-title').text('Добавление пользователя');
                document.getElementById("btn-add").hidden = false;
                document.getElementById("btn-edit").hidden = true;
                document.getElementById("Login").value = '';
                document.getElementById("Password").value = '';
                document.getElementById("PersonName").value = '';
                document.getElementById("PersonSurname").value = '';
                document.getElementById("Number").value = '';
                document.getElementById("email").value = '';
                document.getElementById("message").value = '';

            } else {
                if(recipient == 'admin_edit') {
                    document.getElementById('flag-admin').checked = true;
                }else {
                    document.getElementById('flag-admin').checked = false;
                }
                    
                modal.find('.modal-title').text('Редактирование пользователя');
                document.getElementById("btn-edit").value = button.val();
                document.getElementById("btn-edit").hidden = false;
                document.getElementById("btn-add").hidden = true;
                document.getElementById("Login").value = $('#login' + button.val()).text();
                document.getElementById("Password").value = $('#password' + button.val()).text();
                document.getElementById("PersonName").value = $('#name' + button.val()).text();
                document.getElementById("PersonSurname").value = $('#surename' + button.val()).text();
                document.getElementById("Number").value = $('#number' + button.val()).text();
                document.getElementById("email").value = $('#email' + button.val()).text();
                document.getElementById("message").value = $('#info' + button.val()).text();
            }
        })

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
            $("button.btn_del").click(function(event) {
                var Login = $('#login' + event.target.value).text();
                $.ajax({
                    type: "POST", 
                    url: 'del-users.php', 
                    data: {
                        Login: Login
                    }, 
                    success: function(data) {
                        if (data === 'ok') {
                            location.reload();
                        } else {
                            window.alert("Ошибка удаления");
                        }
                    }
                });
            });
        });

        $(document).ready(function() {
            $("button.btn_send").click(function(event) {
                var PersonName = $('#name' + event.target.value).text();
                var PersonSurname = $('#surename' + event.target.value).text();
                var Number = $('#number' + event.target.value).text();
                var Info = $('#info' + event.target.value).text();
                var email = $('#email' + event.target.value).text();
                $.ajax({
                    type: "POST", 
                    url: 'send_message.php', 
                    data: {
                        PersonName: PersonName,
                        PersonSurname: PersonSurname,
                        Number: Number,
                        Info: Info,
                        email: email
                    }, 
                    success: function(data) {
                        if (data === 'ok') {
                            window.alert("Заявка отправлена повторно");
                        } else {
                            window.alert("Ошибка отправки заявки");
                        }
                    }
                });
            });
        });

        $(document).ready(function() {
            $('#btn-add').click(function() {
                var Login = $('#Login').val();
                var Password = $('#Password').val();
                if (document.getElementById('flag-admin').checked) {
                    var flag_admin = $('#flag-admin').val();
                } else
                    var flag_admin = 0;
                var PersonName = $('#PersonName').val();
                var PersonSurname = $('#PersonSurname').val();
                var Number = $('#Number').val();
                var email = $('#email').val();
                var message = $('#message').val();
                $.ajax({
                    type: "POST", //метод передачи данных
                    url: 'add-users.php', //обработчик php
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
                            location.reload();
                        } else {
                            CheckForm(data);
                        }

                    }
                });
            });
        });

        $(document).ready(function() {
            $('#btn-edit').click(function(event) {
                var Login_old = $('#login' + event.target.value).text();
                var Login = $('#Login').val();
                var Password = $('#Password').val();
                if (document.getElementById('flag-admin').checked) {
                    var flag_admin = $('#flag-admin').val();
                } else
                    var flag_admin = 0;
                var PersonName = $('#PersonName').val();
                var PersonSurname = $('#PersonSurname').val();
                var Number = $('#Number').val();
                var email = $('#email').val();
                var message = $('#message').val();
                $.ajax({
                    type: "POST", 
                    url: 'edit-users.php', 
                    data: {
                        Login: Login,
                        Password: Password,
                        flag_admin: flag_admin,
                        PersonName: PersonName,
                        PersonSurname: PersonSurname,
                        Number: Number,
                        email: email,
                        message: message,
                        Login_old: Login_old
                    }, 
                    success: function(data) { 
                        if (data === 'ok') {
                            $('#addModal').modal('hide');
                            location.reload();
                        } else {
                            CheckForm(data);
                        }

                    }
                });
            });
        });

    </script>
    </body>

    </html>
