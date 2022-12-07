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
$meta = '<meta charset="utf-8"><meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate"/><meta http-equiv="Pragma" content="no-cache"/><meta http-equiv="Expires" content="0"/><meta name="viewport" content="width=device-width, initial-scale=1.0">';
$style = '<style> #pagewrapper {max-width: 480px;margin: auto;} <?style>';


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

$calendar_widget = <<<END
<style>
#calendar3 {
  width: 100%;
  font: monospace;
  line-height: 1.2em;
  font-size: 15px;
  text-align: center;
}
#calendar3 thead tr:last-child {
  font-size: small;
  color: rgb(85, 85, 85);
}
#calendar3 tbody td {
  color: rgb(44, 86, 122);
}
#calendar3 tbody td:nth-child(n+6), #calendar3 .holiday {
  color: rgb(231, 140, 92);
}
#calendar3 tbody td.today {
  outline: 3px solid red;
}
</style>

<table id="calendar3">
  <thead>
    <tr><td colspan="4"><select>
<option value="0">Январь</option>
<option value="1">Февраль</option>
<option value="2">Март</option>
<option value="3">Апрель</option>
<option value="4">Май</option>
<option value="5">Июнь</option>
<option value="6">Июль</option>
<option value="7">Август</option>
<option value="8">Сентябрь</option>
<option value="9">Октябрь</option>
<option value="10">Ноябрь</option>
<option value="11">Декабрь</option>
</select><td colspan="3"><input type="number" value="" min="0" max="9999" size="4">
    <tr><td>Пн<td>Вт<td>Ср<td>Чт<td>Пт<td>Сб<td>Вс
  <tbody>
</table>

<script>
function Calendar3(id, year, month) {
var Dlast = new Date(year,month+1,0).getDate(),
    D = new Date(year,month,Dlast),
    DNlast = D.getDay(),
    DNfirst = new Date(D.getFullYear(),D.getMonth(),1).getDay(),
    calendar = '<tr>',
    m = document.querySelector('#'+id+' option[value="' + D.getMonth() + '"]'),
    g = document.querySelector('#'+id+' input');
if (DNfirst != 0) {
  for(var  i = 1; i < DNfirst; i++) calendar += '<td>';
}else{
  for(var  i = 0; i < 6; i++) calendar += '<td>';
}
for(var  i = 1; i <= Dlast; i++) {
  if (i == new Date().getDate() && D.getFullYear() == new Date().getFullYear() && D.getMonth() == new Date().getMonth()) {
    calendar += '<td class="today">' + i;
  }else{
    if (  // список официальных праздников
        (i == 1 && D.getMonth() == 0 && ((D.getFullYear() > 1897 && D.getFullYear() < 1930) || D.getFullYear() > 1947)) || // Новый год
        (i == 2 && D.getMonth() == 0 && D.getFullYear() > 1992) || // Новый год
        ((i == 3 || i == 4 || i == 5 || i == 6 || i == 8) && D.getMonth() == 0 && D.getFullYear() > 2004) || // Новый год
        (i == 7 && D.getMonth() == 0 && D.getFullYear() > 1990) || // Рождество Христово
        (i == 23 && D.getMonth() == 1 && D.getFullYear() > 2001) || // День защитника Отечества
        (i == 8 && D.getMonth() == 2 && D.getFullYear() > 1965) || // Международный женский день
        (i == 1 && D.getMonth() == 4 && D.getFullYear() > 1917) || // Праздник Весны и Труда
        (i == 9 && D.getMonth() == 4 && D.getFullYear() > 1964) || // День Победы
        (i == 12 && D.getMonth() == 5 && D.getFullYear() > 1990) || // День России (декларации о государственном суверенитете Российской Федерации ознаменовала окончательный Распад СССР)
        (i == 7 && D.getMonth() == 10 && (D.getFullYear() > 1926 && D.getFullYear() < 2005)) || // Октябрьская революция 1917 года
        (i == 8 && D.getMonth() == 10 && (D.getFullYear() > 1926 && D.getFullYear() < 1992)) || // Октябрьская революция 1917 года
        (i == 4 && D.getMonth() == 10 && D.getFullYear() > 2004) // День народного единства, который заменил Октябрьскую революцию 1917 года
       ) {
      calendar += '<td class="holiday">' + i;
    }else{
      calendar += '<td>' + i;
    }
  }
  if (new Date(D.getFullYear(),D.getMonth(),i).getDay() == 0) {
    calendar += '<tr>';
  }
}
for(var  i = DNlast; i < 7; i++) calendar += '<td>&nbsp;';
document.querySelector('#'+id+' tbody').innerHTML = calendar;
g.value = D.getFullYear();
m.selected = true;
if (document.querySelectorAll('#'+id+' tbody tr').length < 6) {
    document.querySelector('#'+id+' tbody').innerHTML += '<tr><td>&nbsp;<td>&nbsp;<td>&nbsp;<td>&nbsp;<td>&nbsp;<td>&nbsp;<td>&nbsp;';
}
document.querySelector('#'+id+' option[value="' + new Date().getMonth() + '"]').style.color = 'rgb(220, 0, 0)'; // в выпадающем списке выделен текущий месяц
}
Calendar3("calendar3",new Date().getFullYear(),new Date().getMonth());
document.querySelector('#calendar3').onchange = function Kalendar3() {
  Calendar3("calendar3",document.querySelector('#calendar3 input').value,parseFloat(document.querySelector('#calendar3 select').options[document.querySelector('#calendar3 select').selectedIndex].value));
}
</script>
END;

?>