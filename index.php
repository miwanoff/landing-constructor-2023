<?php
require "autoload.php";
$header = new Header("Заголовок Лендінгу");
$text = new Text("Це лендинг");
$model = new Model([$header, $text], "Лендінг");
$str_land = $model->generate(); // генерація тексту лендинга
//echo $str_land;

$dir = "landing";
mkdir($dir); // створення каталогу за вказаним шляхом
$f = fopen("{$dir}/index.html", "w+"); // створення файлу лендингу за вказаним шляхом
fwrite($f, $str_land); // запис в файл коду лендинга
fclose($f);
echo "Лендинг успішно створено!";