<?php
$title = 'Редактирование страниц';
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "biglap";
    session_start();
if($_SESSION['authorized'] != 1 || !isset($_SESSION['authorized']))
    header('Location: ../authorization.php');
if($_SESSION['flag_admin'] != 1 && isset($_SESSION['flag_admin']))
    header('Location: ../kittens.php');
$mysqli = new mysqli($servername, $username, $password, $dbname);
            
        if ($mysqli -> connect_error) 
        {
            $err['conn'] = 'Ошибка подключения';
            mysqli_close($mysqli);
            header('Location: '.$_SERVER['PHP_SELF'].'?message=err');
        }
        else
        {
            $sql = "SELECT * FROM pages";
            $res = $mysqli -> query($sql);
            if ($res -> num_rows > 0)
            {
                mysqli_set_charset($mysqli, "utf8");
                
                for($i = 1; $i <= $res -> num_rows; $i++) {
                    $row = $res -> fetch_assoc();
                    $titles[$i] = $row['title'];
                    $content[$i] = $row['content'];
                }
            }
            mysqli_close($mysqli);
        }  

require($_SERVER['DOCUMENT_ROOT']."/components/header.php");
?>
<div class="body-content page-edit-body-content">
    <h1>Редактирование страниц</h1>
    <div class="row">
        <div class="col-lg-4 col-md-auto">
            <div class="list-group">
                <button type="btn btn-primary" value="1" id="1" class="list-group-item list-group-item-action active"><?=$titles[1]?></button>
                <button type="btn btn-primary" value="2" id="2" class="list-group-item list-group-item-action"><?=$titles[2]?></button>
                <button type="btn btn-primary" value="3" id="3" class="list-group-item list-group-item-action"><?=$titles[3]?></button>
                <button type="btn btn-primary" value="4" id="4" class="list-group-item list-group-item-action"><?=$titles[4]?></button>
                <button type="btn btn-primary" value="5" id="5" class="list-group-item list-group-item-action"><?=$titles[5]?></button>
            </div>
        </div>
        <div class="col-lg-8 col-md-auto">
            <h3>Название страницы</h3>
            <p>
                <input type="text" id="title" value="<?=$titles[1]?>" />
            </p>
            <h3>Текст страницы</h3>
            <p>
                <textarea id="content" cols="100" rows="9" value=""><?=$content[1]?></textarea>
            </p>
            <button type="button" class="btn btn-primary" id="btn-edit">Изменить</button>
        </div>
    </div>
</div>

<hr />
<script>
    $(document).ready(function() {
        $("button.list-group-item").click(function(event) {
            let btn_collection = document.getElementsByClassName("list-group-item");
            for (let i = 0; i < btn_collection.length; i++) {
                let btn = btn_collection[i].className = "list-group-item list-group-item-action";
            }
            document.getElementById(event.target.value).className = "list-group-item list-group-item-action active";
            var id = event.target.value;
            $.ajax({
                type: "POST", 
                url: 'pages.php', 
                data: {
                    id: id
                }, 
                success: function(data) {
                    document.getElementById("title").value = data['title'];
                    document.getElementById("content").textContent = data['content'];
                }
            });
        });
    });

    $(document).ready(function() {
        $('#btn-edit').click(function() {
            var title = document.getElementById("title").value;
            var content = $('#content').val();
            var title_old = document.getElementsByClassName("active")[0].textContent;
            $.ajax({
                type: "POST",
                url: 'update-pages.php', 
                data: {
                    title: title,
                    content: content,
                    title_old: title_old
                }, 
                success: function(data) {
                    if (data === 'ok') {
                        location.reload();
                    } else {
                        window.alert("Ошибка");
                    }
                }
            });
        });
    });

</script>
<?php
require($_SERVER['DOCUMENT_ROOT'].'/components/footer.php');
?>
