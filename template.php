<?php 
include 'data.php';
?>

<!DOCTYPE html>
<head>
    <?=$meta_everyday?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$title_everyday?></title>
    <style>
      #pagewrapper {
        max-width: 480px;
        margin: auto;
      }
    </style>
</head>
<body>
    <div id="pagewrapper" >
        <header><div id="header_div"><a href="index.php"><img src="logo.png" alt="logo" id="logo_img">Расчётзарплаты.рф</a></div></header>
        <hr>
        <nav><a href="">Профиль</a><a href="">Расценки</a><a href="">Справка</a><a href="">Выход</a></nav>
        <hr>
<?=$calendar_widget?>

<hr>

    </div>
</body>