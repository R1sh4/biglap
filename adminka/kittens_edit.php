<?php
$title = 'Редактирование котят';

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

<div class="body-content kittens-body-content edit-kittens-body-content">
    <h1>Котята <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addKittenModal" data-type="add">Добавить</button></h1>
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
                for($i = 1; $i <= $res -> num_rows; $i++) {
                    $row = $res -> fetch_assoc();
                    echo '<div class="col-lg-3">
            <div id="id'.$i.'" value="'.$row['id'].'" class="card text-center">
                <img id="image'.$i.'" value="'.$row['image'].'" class="card-img-top"  src="../img/'.$row['image'].'">
                <div class="card-body">
                    <h2 id="name'.$i.'" class="card-title">'.$row['name'].'</h2>
                    <h3 id="gender'.$i.'" class="card-subtitle">'.$row['gender'].'</h3>
                    <h3 id="age'.$i.'" class="card-subtitle">'.$row['age'].'</h3>
                    <h4 id="characteristic'.$i.'" class="card-text">'.$row['characteristic'].'</h4>
                    <button type="button" class="btn btn-primary btn_edit" value="'.$i.'" data-toggle="modal" data-target="#addKittenModal" data-type="edit">Редактировать</button>
                    <button type="button" class="btn btn-primary btn_del" value='.$i.'>Удалить</button>
                </div>
            </div>
        </div>';
                }
            }
            mysqli_close($mysqli);    
                
        }  
            ?>

    </div>
    <div class="modal fade" id="addKittenModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="addModalLabel">Добавление котенка</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <p class="alert" id="Nullp"></p>
                        <p>Имя</p>
                        <p class="alert" id="Namep"></p>
                        <p>
                            <input type="text" name="Name" id="Name" value="" placeholder="Не менее 2-х символов" />
                        </p>
                        <p>Пол</p>
                        <p class="alert" id="Genderp"></p>
                        <p>
                            <input type="text" name="Gender" id="Gender" value="" placeholder="Девочка/Мальчик" />
                        </p>
                        <p>Возраст</p>
                        <p class="alert" id="Agep"></p>
                        <p>
                            <input type="text" name="Age" id="Age" value="" placeholder="Например: 6 месяцев" />
                        </p>
                        <p>Картинка</p>
                        <p class="alert" id="Imagep"></p>
                        <p>
                            <input type="file" name="Image" id="Image" accept="image/*" />
                        </p>
                        <p>Характеристика</p>
                        <p>
                            <textarea name="Characteristic" id="Characteristic" cols="35" rows="10" value=""></textarea>
                        </p>
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
        $('#addKittenModal').on('show.bs.modal', function(event) {
            ClearForm();
            var button = $(event.relatedTarget); // Кнопка, что спровоцировало модальное окно
            var recipient = button.data('type');
            var modal = $(this);
            if (recipient == 'add') {
                modal.find('.modal-title').text('Добавление котенка');
                document.getElementById("btn-add").hidden = false;
                document.getElementById("btn-edit").hidden = true;
                document.getElementById("Name").value = '';
                document.getElementById("Gender").value = '';
                document.getElementById("Age").value = '';
                document.getElementById("Characteristic").value = '';
            } else {
                modal.find('.modal-title').text('Редактирование котенка');
                document.getElementById("btn-edit").value = button.val();
                document.getElementById("btn-edit").hidden = false;
                document.getElementById("btn-add").hidden = true;
                document.getElementById("Name").value = $('#name' + button.val()).text();
                document.getElementById("Gender").value = $('#gender' + button.val()).text();
                document.getElementById("Age").value = $('#age' + button.val()).text();
                document.getElementById("Imagep").textContent = "Не выбирайте файл, если не хотите его менять";
                document.getElementById("Characteristic").value = $('#characteristic' + button.val()).text();
            }
        })

        function CheckForm(data) {
            var Name = document.querySelector('#Name');
            Name.style = "border-color: black";
            document.getElementById("Namep").textContent = '';
            var Gender = document.querySelector('#Gender');
            Gender.style = "border-color: black";
            document.getElementById("Genderp").textContent = '';
            var Image = document.querySelector('#Image');
            Image.style = "border-color: black";
            document.getElementById("Imagep").textContent = '';

            if (data['NameLen'] != null) {
                var Name = document.querySelector('#Name');
                Name.style = "border-color: red";
                document.getElementById("Namep").textContent = data['NameLen'];
            }
            if (data['NameRepeat'] != null) {
                var Name = document.querySelector('#Name');
                Name.style = "border-color: red";
                document.getElementById("Namep").textContent = data['NameRepeat'];
            }
            if (data['NameNum'] != null) {
                var Name = document.querySelector('#Name');
                Name.style = "border-color: red";
                document.getElementById("Namep").textContent = data['NameNum'];
            }
            if (data['Gender'] != null) {
                var Gender = document.querySelector('#Gender');
                Gender.style = "border-color: red";
                document.getElementById("Genderp").textContent = data['Gender'];
            }
            if (data['err_file_already_exists'] != null) {
                document.getElementById("Nullp").textContent = data['err_file_already_exists'];
            }
            if (data['err_file'] != null) {
                document.getElementById("Nullp").textContent = data['err_file'];
            }
            if (data['NameNum'] != null) {
                var Name = document.querySelector('#Name');
                Name.style = "border-color: red";
                document.getElementById("Namep").textContent = data['NameNum'];
            }

        }

        function ClearForm() {
            document.getElementById("Imagep").textContent = '';
            document.getElementById("Nullp").textContent = '';
            var Name = document.querySelector('#Name');
            Name.style = "border-color: gray";
            var Gender = document.querySelector('#Gender');
            Gender.style = "border-color: gray";
            var Age = document.querySelector('#Age');
            Age.style = "border-color: gray";
            var Characteristic = document.querySelector('#Characteristic');
            Characteristic.style = "border-color: gray";
        }

        function CheckFormNull() {
            var flag = true;
            var Name = document.querySelector('#Name');
            if (Name.value == "") {
                Name.style = "border-color: red";
                flag = false;
            }
            var Gender = document.querySelector('#Gender');
            if (Gender.value == "") {
                Gender.style = "border-color: red";
                flag = false;
            }
            var Age = document.querySelector('#Age');
            if (Age.value == "") {
                Age.style = "border-color: red";
                flag = false;
            }
            var Characteristic = document.querySelector('#Characteristic');
            if (Characteristic.value == "") {
                Characteristic.style = "border-color: red";
                flag = false;
            }
            if (!flag)
                document.getElementById("Nullp").textContent = 'Заполните поля';
            return flag;
        }

        $(document).ready(function() {
            $("button.btn_del").click(function(event) {
                var id = $('#id' + event.target.value)[0].attributes[1].value;
                var filename = $('#image' + event.target.value)[0].attributes[1].value;
                $.ajax({
                    type: "POST",
                    url: 'del-kittens.php',
                    data: {
                        id: id,
                        filename: filename
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
        var files;
        var fileslength;
        $('input[type=file]').on('change', function() {
            files = this.files;
            fileslength = files.length;
            document.getElementById("Imagep").textContent = "";
        });
        $(document).ready(function() {
            $('#btn-add').click(function() {
                if (typeof files == 'undefined' || fileslength == 0) {
                    document.getElementById("Imagep").textContent = "Выберите файл";
                    return;
                }
                if (!CheckFormNull())
                    return;
                var data = new FormData();
                data.append('Name', $('#Name').val());
                data.append('Gender', $('#Gender').val());
                data.append('Age', $('#Age').val());
                data.append('Characteristic', $('#Characteristic').val());
                data.append('file', $("#Image")[0].files[0]);
                $.ajax({
                    type: "POST",
                    url: 'add-kittens.php',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: data,
                    dataType: 'json',
                    success: function(msg) {
                        if (msg === 'ok') {
                            $('#addKittenModal').modal('hide');
                            location.reload();
                        } else {
                            CheckForm(msg);
                        }
                    }
                });
            });
        });

        $(document).ready(function() {
            $('#btn-edit').click(function(event) {
                if (!CheckFormNull())
                    return;
                var data = new FormData();
                if (typeof files == 'undefined' || fileslength == 0) {
                    data.append('file', null);
                } else
                    data.append('file', $("#Image")[0].files[0]);
                data.append('Name', $('#Name').val());
                data.append('Gender', $('#Gender').val());
                data.append('Age', $('#Age').val());
                data.append('Characteristic', $('#Characteristic').val());
                data.append('id', $('#id' + event.target.value)[0].attributes[1].value)
                $.ajax({
                    type: "POST",
                    url: 'edit-kittens.php',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: data,
                    dataType: 'json',
                    success: function(msg) {
                        if (msg === 'ok') {
                            $('#addKittenModal').modal('hide');
                            location.reload();
                        } else {
                            CheckForm(msg);
                        }
                    }
                });
            });
        });

    </script>

    </body>

    </html>
