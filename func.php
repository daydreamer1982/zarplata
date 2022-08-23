<?php

/* Функции, которые используются для вывода и обработки данных */ 

// Функция, которая будет выводить div c данными из массива, каждый в своём span и присваивать id

function show_content(string $id_style,array $content) {
    $result = "<div ".$id_style.">";
    foreach($content as $name => $value) {
        $result = $result."<span>".$name.":".$value." </span></br>";
    }
    unset($name);
    unset($value);
    $result =  $result."</div></br>";

    return $result;
}

/* 
Функция, которая вычисляет зарплату. На вход получает: количество отработанных дней, количество
оставшихся дней в месяце, сколько процентов снимается (налог, профвзносы и т.д.), премию, аванс (
либо в процентах, либо фиксированный), коэффициент (если считается зарплата в бригаде), массив с 
количеством каждой сделанной позиции массив с расценками.
 Каждая позиция перемножается на соответствующую расценку, и прибавляется к результату,так мы 
получаем количество заработанных денег грязными на текущий день месяца. После этого мы отнимаем 
проценты, и умножаем на премию, получая сколько заработано чистыми. Потом делим эту сумму на 
количество отработанных дней, получая среднюю зарплату за день и умножаем на количество оставшихся 
дней, потом прибавляем заработанное чистыми, чтобы увидеть, сколько примерно выходит за весь месяц.
 */
function calculate_salary(int $days_worked, int $days_left, int $tax, int $bonus, int $koeff, array $items_made, bool $prepayment_percent, int $prepayment, array $tarriffs) {
// Инициализация переменных
    $result = [];
    $temp = 0;
// Перемножение количества готовых деталей на расценки и получение суммы грязными
    foreach ($tarriffs as $item => $value) {
        if (array_key_exists($item, $items_made)){
            $temp = $temp + $tarriffs[$item] * $items_made[$item];
//            echo($temp.' '.$item.' '.$value.' '.$items_made[$item].",");
        }
    }
    $result['Грязными'] = $temp * $koeff / 100;
    unset($item);
    unset($value);
    $temp = $result['Грязными'];
// Отнимаем налог и получаем сумму чистыми
    $result['Чистыми'] = $temp - $temp * $tax / 100;
// Прибавляем премию
    $temp = $result['Чистыми'];
    $result['С премией'] = $temp + $temp * $bonus / 100;
// Вычисляем примерную зарплату
    $temp = $result['С премией'];
    $result['Примерная'] = $temp + $temp / $days_worked * $days_left;
// Записываем в выходной массив аванс
    $temp = $result['Примерная'];
    if ($prepayment_percent) {
        $prepayment = $temp * $prepayment / 100;
    }
    $result['Аванс'] = $prepayment;
// Вычисляем сколько получать примерно на руки без аванса
    $result['На руки без аванса'] = $result['Примерная'] - $result['Аванс'];
// Округляем всё до целых
  foreach ($result as $key => $value) {
    $result[$key] = round(floatval($value));
  }
// Возвращаем массив
    return $result;
}
