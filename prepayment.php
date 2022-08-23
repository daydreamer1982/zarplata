<!DOCTYPE html>
<head>
    <title>Расценки</title>
</head>
<body align="center">
    <h1>Расценки</h1></br></br>
    <?php
        include 'io.php';
        include 'func.php';

    echo(show_content($style, $tarriffs));
    ?>
    <a href='index.php'>На главную</a>
</body>