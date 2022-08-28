<?php
include 'io.php';

function list_files($path)
{
	if ($path[mb_strlen($path) - 1] != '/') {
		$path .= '/';
	}
 
	$files = array();
	$dh = opendir($path);
	while (false !== ($file = readdir($dh))) {
		if ($file != '.' && $file != '..' && !is_dir($path.$file) && $file[0] != '.') {
			$files[] = $file;
		}
	}
 
	closedir($dh);
	return $files;
}
 
$temp = list_files(__DIR__);
foreach ($temp as $file) {
    $perms = fileperms(__DIR__."/".$file);

switch ($perms & 0xF000) {
    case 0xC000: // сокет
        $info = 's';
        break;
    case 0xA000: // символическая ссылка
        $info = 'l';
        break;
    case 0x8000: // обычный
        $info = 'r';
        break;
    case 0x6000: // файл блочного устройства
        $info = 'b';
        break;
    case 0x4000: // каталог
        $info = 'd';
        break;
    case 0x2000: // файл символьного устройства
        $info = 'c';
        break;
    case 0x1000: // FIFO канал
        $info = 'p';
        break;
    default: // неизвестный
        $info = 'u';
}

// Владелец
$info .= (($perms & 0x0100) ? 'r' : '-');
$info .= (($perms & 0x0080) ? 'w' : '-');
$info .= (($perms & 0x0040) ?
            (($perms & 0x0800) ? 's' : 'x' ) :
            (($perms & 0x0800) ? 'S' : '-'));

// Группа
$info .= (($perms & 0x0020) ? 'r' : '-');
$info .= (($perms & 0x0010) ? 'w' : '-');
$info .= (($perms & 0x0008) ?
            (($perms & 0x0400) ? 's' : 'x' ) :
            (($perms & 0x0400) ? 'S' : '-'));

// Мир
$info .= (($perms & 0x0004) ? 'r' : '-');
$info .= (($perms & 0x0002) ? 'w' : '-');
$info .= (($perms & 0x0001) ?
            (($perms & 0x0200) ? 't' : 'x' ) :
            (($perms & 0x0200) ? 'T' : '-'));

    print_r($file." ".$info."</br>");
}

$result = read_tariffs('1');
foreach ($result as $line) {
    print($line.'</br>');
}

$test_tariff = [':item' => 'Шнек 7м', ':tariff' => 1696, ':dept' => 1];

echo(write_tariffs($test_tariff));
