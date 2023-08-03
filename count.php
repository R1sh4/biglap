<?php
$title = 'Подсчет';

if (isset($_GET['btn_ok']))
{
    if (preg_match("/\.\.\//",$_GET['filename'])) {
        $err['filename'] = 'Путь к файлу/папке не должен содержать ../';
    }
    else {
        $path = $_SERVER['DOCUMENT_ROOT'];
        $path .= '//';
        $path .= $_GET['filename'];
        if (file_exists($path))
            $filesize = 'Размер = '. filesize($path). ' Кб';
        else $err['file_not_exists'] = 'Файл не найден';
    }
}

require('components/header.php');
require('components/menu.php');
?>

<div class="count">
    
    <h1>Подсчет размера файла/папки</h1>
    <form name="myformcount" action="<?=$_SERVER['PHP_SELF']?>" method="GET">
        <div class="container-request">
            <h2>Введите имя файла/папки</h2>
            <p><input type="text" name="filename" value="<?=(isset($_GET['filename']) ? $_GET['filename'] : '')?>" <?php if (isset($err['filename']) or isset($err['file_not_exists'])) echo 'style="border-color: red"'; ?> /></p>
            <p><input type="submit" name = 'btn_ok' value="Отправить" /></p>
        </div>
    </form>
    <?php
     if(isset($err['filename'])) 
         echo '<p style="color: red; text-align:center; ">'.$err['filename'].'</p>';
    else
        if(isset($err['file_not_exists'])) 
            echo '<p style="color: red; text-align:center; ">'.$err['file_not_exists'].'</p>';
        else
            echo '<p style = "text-align:center;">'.$filesize.'</p>'
    ?>
    <img src="img/catquestion.gif">
</div>
<?php
require('components/footer.php');
?>