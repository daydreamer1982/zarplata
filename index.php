<head>
    <title>Расчёт зарплаты</title>
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
        <form action="result.php" method="post" enctype="multipart/form-data">
            Количество рабочих дней: <input type="range" min="1" max="31" name="working" value="1" oninput="this.nextElementSibling.value = this.value"><output>1</output>
            </br>
            Количество отработанный дней: <input type="range" min="1" max="31" name="worked" value="1" oninput="this.nextElementSibling.value = this.value"><output>1</output>
            </br>
            Оклад: <input type="number" name="oklad" value="35000">
            </br>
            <input type="submit" value="Рассчитать">
            </br>
            <input type="reset" value="Сбросить">
    </form>
</body>