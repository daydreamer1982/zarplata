<!DOCTYPE html>
<head>
    <?=$meta_everyday?>
    <title><?=$title_everyday?></title>
    <style type="text/css">
        body {
            font-size: 200%; 
        }
        input {
            font-size: 200%;
        }
    </style>
</head>
<body>
    <div>Здравствуйте, <?=$username?>, на сегодняшний день вы заработали <?=$result['Грязными']?> рублей, на руки вы получите аванс <?=$result['Аванс']?> и зарплату <?=$result['На руки без аванса']?></div>
    <div><form action="">
        <input type="submit" value="Добавить запись">
</body>