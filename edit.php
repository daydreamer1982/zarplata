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
$tariffs_now = read_tariffs($dept);
$edited_content = '';
foreach ($tariffs_now as $name => $value) {
    foreach ($value as $item => $count) {
        $edited_content .=  '<span>'.$count.' </span>';
    }
    $edited_content .= '</br>';
}
$title = $title.'</br></br>';
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
    <p><input type="submit" name="save" value="Сохранить">
</form>

<?php
echo '<pre>';
 var_dump($tariffs_now); 
 var_dump($edited_content);

?>
</body>