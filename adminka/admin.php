<?php
$title = 'Админка';

session_start();
if($_SESSION['authorized'] != 1 || !isset($_SESSION['authorized']))
    header('Location: ../authorization.php');
if($_SESSION['flag_admin'] != 1 && isset($_SESSION['flag_admin']))
    header('Location: ../kittens.php');

require($_SERVER['DOCUMENT_ROOT']."/components/header.php");
?>
<div class="body-content admin-body-content">
    <h1>Выберите раздел</h1>
    <div class="row">
        <div class=" col-lg-4">
            <a href="user_edit.php" class="btn btn-primary">Редактирование<br>пользователей</a>
        </div>
        <div class="col-lg-4">
            <a href="page_edit.php" class="btn btn-primary">Редактирование<br>страниц</a>
        </div>
        <div class="col-lg-4">
            <a href="kittens_edit.php" class="btn btn-primary">Редактирование<br>информации<br>о котятах</a>
        </div>
    </div>
</div>

</body>

</html>
