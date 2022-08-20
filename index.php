<?php
/*  Обработчик формы */

// Если была нажата кнопка рассчитать, то выполнится этот блок

// Так как количество рабочих дней показывается ползунками,
// то нельзя ввести неправильные данные, но хоть в поле "Оклад"
// и указано дефолтное значение, всё равно нужно проверить, чтоб
// ввод был непустым и количество отработаннных дней было не
// больше количества рабочих

if (isset($_POST['raschet']) && !isset($_POST['reset'])) {
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


        // Строки вывода результата

                 $result="Ваша зарплата".strval($result);
                 $result_tax='Зарплата после уплаты налога '.strval($result_tax);
        
            } else {
        
        // Если поле ввода оклада пустое, то выводится сообщение
        
                $result="Зарплата не может быть рассчитана из-за неверно введённых данных, попробуйте снова";
                $result_tax='';
            }
        } else {
            $result="";
            $result_tax="";
        }
            ?>



<!DOCTYPE html>
<head>
    <title>Расчёт зарплаты</title>
    <meta charset="utf-8">
<body align="center">
    <h1>Расчёт зарплаты за месяц</h1>
    </br>
    </br>
    </br>

<!--- Форма ввода, в которой количество рабочих и отработанных дней
 указаны ползунками, которые могут принимать значение от 1 до 31,
 что логично, так как является числом дней в месяце, а поле оклад 
 текстовое с возможностью ввода только чисел и значением по умолчанию--->

    <div id="form_input">
        <form action="" method="post" enctype="multipart/form-data">
            Количество рабочих дней: <input type="range" min="1" max="31" name="working" value="1" oninput="this.nextElementSibling.value = this.value"><output>1</output>
            </br>
            Количество отработанный дней: <input type="range" min="1" max="31" name="worked" value="1" oninput="this.nextElementSibling.value = this.value"><output>1</output>
            </br>
            Оклад: <input type="number" name="oklad" value="35000">
            </br>
            <input type="submit" name="raschet" value="Рассчитать">
            </br>
            <input type="submit" name="reset" value="Сбросить">
    </form>
    </br>
    <h1><?=$result  ?></h1>
        </br>
        <h1> <?=$result_tax ?> </h1>
</body>