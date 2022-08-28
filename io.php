<?php 
/* Всё, что связано со вводом и выводом данных */

const TARIFF = '_tariff';
const DB_USER = 'dd1982';
const DB_PASS = 'dd1982';
const DB_NAME = 'testio';
const DB_OPT = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,];


$body_style = '<style type="text/css">
    body {
        text-align: center;
    }                
</style>';
$title = 'Расчёт зарплаты';
$meta = '<meta charset="utf-8"><meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate"/><meta http-equiv="Pragma" content="no-cache"/><meta http-equiv="Expires" content="0"/>';
$style = '';


/*[
    'Грязными' => 26328,
    'Чистыми' => 22905,
    'Примерная' => 33316,
    'С премией' => 46643,
    'Аванс' => 13000,
    'На руки без аванса' => 33643
];
*/
$tariffs = [
    'Шнек 6м' => 1280,
    'Шнек 7м' => 1696,
    'Шнек Полесье' => 1750,
    'Шнек Подборщик' => 1200,
    'Горловина' => 577,
    'Шнек Нива' => 1150,
];

$bonus = 40;

$days_worked = 11;

$days_left = 5;

$tax = 13;

$page_top = '<h1>'.$title.'</h1></br></br>';

$page_bottom = '</br><a href="tariffs.php">Расценки</a>';

$prepayment_percent = FALSE;

$prepayment = 13000;

$items_made = [
    'Шнек 6м' => 20,
    'Шнек 7м' => 11,
    'Шнек Полесье' => 4
];

$koeff = 42;
$dept = 2;

// Функция для чтения расценок из базы
function read_tariffs(int $dept) {
// инициализируем выходной массив
    $output = [];
// Подключаемся к базе данных

    $db = new PDO('mysql:host=localhost;dbname='.DB_NAME, DB_USER, DB_PASS,DB_OPT);
// Подготавливаем запрос, используя неименованный плейсхолдер
    $query = $db->prepare("SELECT * FROM `tariffs` WHERE `dept` = :dept");
// Отправляем подготовленный запрос на исполнение используя в качестве аргумента
// массив
    $query->execute(array($dept));
// Получаем результат из базы 
    foreach ($query as $row) {
        array_push($output, ['item' => $row['item']],['tariff' =>$row['tariff']]);
    }
    return $output;
}

// Функция для записи расценок в базу
function write_tariffs(array $tariff) {
// Подключаемся к базе данных
    $db = new PDO('mysql:host=localhost;dbname='.DB_NAME, DB_USER, DB_PASS);
// Подготавливаем запрос, используя неименованный плейсхолдер
    $query = $db->prepare("INSERT INTO `tariffs` (`item`, `tariff`, `dept`) VALUES (:item, :tariff, :dept)");
// Отправляем подготовленный запрос на исполнение используя в качестве аргумента
// массив
    $query->execute($tariff);
}