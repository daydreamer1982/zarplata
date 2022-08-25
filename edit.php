<?php
/* Страница редактирования данных */
include 'func.php';
include 'io.php';
if(isset($_GET['edit'])) {$title = $_GET['edit']; }
switch ($title) {
    case 'tariffs': $title = 'Расценки'; break;
    case 'work' : $title = 'Часы и выполненные задания'; break;
    default : $title ='';
}
$title_head = 'Редактировать '.mb_strtolower($title);
$edited_content = read_tariffs($user);
?>

<!DOCTYPE html>
<head>
    <title><?=$title_head?></title>
    <?=$meta?>
    <?=$body_style?>
</head>
<body>
<?=$title?>
<?=$edited_content?>
<form name="edit" action="" method="post">
    <p><input type="text", name="name">&nbsp;<input type="number" name="tariff">
</form>

<?php var_dump($edited_content); ?>
</body>