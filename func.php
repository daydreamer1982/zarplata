<?php

/* Функции, которые используются для вывода и обработки данных */ 

// Функция, которая будет выводить div c данными из массива, каждый в своём span и присваивать стиль 

function show_content(string $id_style,array $content) {
    $result = "<div id=".$id_style.">";
    foreach($content as $div) {
        $result = $result."<span>".$div."</span></br>";
    }
    unset($div);
    $result =  $result."</div></br>";

    return $result;
}

