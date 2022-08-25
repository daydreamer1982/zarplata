<?php
include 'func.php';
include 'io.php';
require 'render.php';

/* Главная страница */

?>

<!DOCTYPE html>
<head>
    <title><?=$title?></title>
    <?=$meta?>
    <?=$body_style?>
</head>
<body>
    <?=$body?>
    <a href="edit.php?edit=work">Редактировать часы и выполненные задания</a></br>
<?php 
// system('id'); 
?>
</body>