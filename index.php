<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Landing-page constructor</title>
</head>

<body>
    <form enctype="multipart/form-data" action="controller/Controller.php" method="post">
        <h2>Landing-page constructor</h2>
        <h3>Title сторінки*</h3>
        <input type="input" name="title" value="" placeholder="Уведіть title сторінки" class="design" />
        <h3>Заголовок сторінки *</h3>
        <input type="input" name="header" value="" placeholder=" Уведіть заголовок сторінки " class="design" />
        <h3>Логотип</h3>
        <input type="file" name="logo" value="" placeholder="Введите изображение логотипа" class="design" />
        <div id="message"></div>
        <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
        <h3>Форма</h3>
        <input type="input" name="form" value="" placeholder="Введите название кнопки" class="design" />
        <h3>Текст сторінки*</h3>
        <textarea name="text" value="" placeholder=" Уведіть текст сторінки " class="design" /></textarea>
        <h3>Генерація</h3>
        <input type="submit" name="submitB" value="Сгенерувати Landing" class="design" id="ok" />
        <a href='landing.zip' class="design" download>Скачать результат</a>
        <h3>Результат</h3>
        <a href='landing/index.html' class="design" target="_blank"> Переглянути результат у новому вікні </a>
    </form>
    <iframe width="800" height="400" src="landing/index.html"></iframe>
    <p>* поля, обов'язкові до заповнення </p>
</body>

</html>