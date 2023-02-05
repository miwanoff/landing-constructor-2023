<?php

class Model
{

    private $name;
    private $blocks = array();

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getBlocks()
    {
        return $this->blocks;
    }

    public function setBlocks($blocks)
    {
        $this->blocks = $blocks;
    }

    public function __construct($blocks = array(), $name = "Landing-page constructor")
    {
        $this->name = $name;
        $this->blocks = $blocks;
    }

    public function generate()
    {
        $content = "";
        for ($i = 0; $i < count($this->blocks); $i++) {
            $content .= $this->blocks[$i]->draw();
        }
        return $template = <<<EOD
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>{$this->name}</title>
    </head>
    <body>
        {$content}
    </body>
</html>
EOD;
    }

    public function achiving($dir)
    {
        // Створюємо архів
        $zip = new ZipArchive(); //Створюємо об'єкт для роботи з ZIP-архівами
        $arch = ".zip";
        $zip->open($dir . $arch, ZIPARCHIVE::CREATE | ZIPARCHIVE::OVERWRITE);
        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($dir), RecursiveIteratorIterator::LEAVES_ONLY
        );

        foreach ($files as $name => $file) {
            // Пропускаємо каталоги (вони додадуться автоматично)
            if (!$file->isDir()) {
                // Отримуємо реальний та відносний шляхи файлу
                $filePath = $file->getRealPath();
                $lendir = substr($dir, 3);
                $relativePath = strstr($filePath, $lendir);
                // Додаємо поточний файл до архіву
                $zip->addFile($filePath, $relativePath);
            }
        }
        $zip->close(); // Завершуємо роботу з архівом
    }

    public function upload($files, $uploaddir)
    {
        $message = "";


        $target_file = $uploaddir . basename($files["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
// Перевірка, чи є файл зображенням


        $check = @getimagesize($files["tmp_name"]);
        if ($check === false) {
            //$message = "Файл не є зображення.";
            $uploadOk = 0;
        }


// Перевірка існування файла
        if (file_exists($target_file)) {
            $message = "Файл уже существует.";
            //$uploadOk = 0;
        }
// Перевірка розміру файлу
        if ($files["size"] > 50000000) {
            $message = "Файл слишком большой.";
            $uploadOk = 0;
        }
// Роздільна здатність певних файлових форматів
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            $message = "Извините, разрешены только форматы JPG, JPEG, PNG & GIF.";
            $uploadOk = 0;
        }
// Перевірка, чи встановлено $uploadOk в 0 (by an error)помилка)
        if ($uploadOk == 0) {
            $message .= " Файл не был загружен.";
// Якщо все гаразд, завантажуємо файл
        } else {
            if (move_uploaded_file($files['tmp_name'], $target_file)) {
                $message .= "Файл " . basename($files["tmp_name"]) . " был успешно загружен.";
            } else {
                $message .= "При загрузке файла произошла ошибка." . basename($files["tmp_name"]);
            }
        }


        return $message;
    }


}