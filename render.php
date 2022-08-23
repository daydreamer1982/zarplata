<?php
/* Всё, что связано с рендерингом страницы */
//  Показывает основное содержание страницы
$main_content = calculate_salary($days_worked, $days_left, $tax, $bonus, $koeff, $items_made, $prepayment_percent, $prepayment, $tarriffs);
$body = show_content($style, $main_content);
// Добавляет заголовок над основным содержанием
$body = $page_top.$body.$page_bottom;