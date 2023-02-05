<?php
require "autoload.php";
$header = new Header("Заголовок Лендінгу");
$text = new Text("Це лендинг");
$model = new Model([$header, $text], "Лендінг");
$str_land = $model->generate(); // генерація тексту лендинга
echo $str_land;