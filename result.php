<head>
    <title>Результат расчёта</title>
</head>
<body align="center">
<?php 
 // Так как количество рабочих дней показывается ползунками,
 // то нельзя ввести неправильные данные, но хоть в поле "Оклад"
 // и указано дефолтное значение, всё равно нужно проверить, чтоб
 // ввод был непустым и количество отработаннных дней было не
 // больше количества рабочих

    if (!empty($_POST['oklad']) && intval($_POST['worked'])<=intval($_POST['working'])) {

// Все введённые данные приводятся к типу integer, потому что по умолчанию
// post передаёт тип string

        $working=intval($_POST['working']);
        $worked=intval($_POST['worked']);
        $oklad=intval($_POST['oklad']);

// Основная формула расчёта зарплаты

        $result=$oklad/$working*$worked;
        $result=round($result, 2);

// Расчёт зарплаты чистыми

        $result_tax=$result-$result*0.13;
        $result_tax=round($result_tax, 2);
        $result_tax='Зарплата после уплаты налога '.strval($result_tax);

    } else {

// Если поле ввода оклада пустое, то выводится сообщение

        $result="не может быть рассчитана из-за неверно введённых данных, попробуйте снова";
        $result_tax='';
    }
    ?>

<h1>Ваша зарплата <?=$result  ?></h1>
</br>
<h1> <?=$result_tax ?> </h1>

</br>
<!--- Скрипт, который переходит на предыдущий документ --->
<script>
  document.write('<a href="' + document.referrer + '">Назад</a>');
</script>

</br>
<!--- debug section --->
<?php 
//        echo(gettype($oklad)."</br>");
//        echo(gettype($worked)."</br>");
//        echo(gettype($working)."</br>");
?>

</body>