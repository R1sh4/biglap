<?php header("Content-type: text/html;charset=utf-8"); 
$root_path = "http://".$_SERVER['SERVER_NAME'];?>
<!DOCTYPE html>
<html>

<head>
    <title>
        <?php echo $title;?>
    </title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?=$root_path?>/style.css" rel="stylesheet" />
    <link href="<?=$root_path?>/bootstrap-4.0.0/dist/css/bootstrap.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Russo+One&display=swap" rel="stylesheet">
    <script src="<?=$root_path?>/jquery-3.5.1.min.js"></script>
    <script src="<?=$root_path?>/popper.min.js"></script>
    <script src="<?=$root_path?>/js.js"></script>
    <script src="<?=$root_path?>/bootstrap-4.0.0/dist/js/bootstrap.bundle.js"></script>

    
</head>
    <main>