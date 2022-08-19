<head>
    <title>Результат расчёта</title>
</head>
<body align="center">
<?php 
 // Так как количество рабочих дней показывается ползунками,
 // то нельзя ввести неправильные данные, но хоть в поле "Оклад"
 // и указано дефолтное значение, всё равно нужно проверить, чтоб
 // ввод был непустым

    if (!empty($_POST['oklad'])) {

// Все введённые данные приводятся к типу integer, потому что по умолчанию
// post передаёт тип string

        $working=intval($_POST['working']);
        $worked=intval($_POST['worked']);
        $oklad=intval($_POST['oklad']);

// Основная формула расчёта зарплаты

        $result=$oklad/$working*$worked;
        $result=round($result, 2);
    } else {

// Если поле ввода оклада пустое, то выводится сообщение

        $result="не может быть рассчитана из-за неверно введённых данных, попробуйте снова";
    }
    ?>

<h1>Ваша зарплата <?=$result  ?></h1>

</br>
<!--- Скрипт, который переходит на предыдущий документ --->
<script>
  document.write('<a href="' + document.referrer + '">Назад</a>');
</script>

</br>
<!--- debug section --->
<?php echo(gettype($_POST['oklad'])) ?>

</body>