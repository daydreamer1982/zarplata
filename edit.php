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
//$edited_content = read_tariffs($user);
if (isset($_POST['save'])) {
    $data = [];
    array_walk($_POST, function ($value, $key) { $data[$key] = $_POST[$key];});
//    write_tariffs($user, $data);
}
?>

<!DOCTYPE html>
<head>
    <title><?=$title_head?></title>
    <?=$meta?>
    <?=$body_style?>
</head>
<body>
<?=$title?>
<form name="edit" action="" method="post">
    <p><input type="text", name="name">&nbsp;<input type="number" name="tariff">
    <p><input type="submit" name="save" value="Сохранить">
</form>

<?php
// var_dump($edited_content); 

?>
</body>