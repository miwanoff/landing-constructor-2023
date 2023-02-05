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

}