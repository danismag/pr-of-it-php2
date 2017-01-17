<!DOCTYPE HTML>
<html>
<head>
    <title>Добавление новости</title>
</head>
<body>
    <nav>
        <a href="/">На главную</a>
    </nav>
    <form method="POST">
        <label for="inputTitle">Заголовок новости</label>
        <input type="text" name="title" id="inputTitle" size="40%" placeholder="Введите заголовок новости" value="<?= $title ?>">
        <br><br>
        <label for="inputText">Текст новости</label>
        <textarea type="text" name="text" id="inputText" cols="67" rows="5" placeholder="Введите текст новости"><?= $text ?></textarea>
        <br><br>
        <label for="inputText">Автор новости</label>
        <input type="text" name="firstName" id="inputTitle" size="20%" placeholder="Имя автора" value="<?= $firstName; ?>">
        <input type="text" name="lastName" id="inputTitle" size="20%" placeholder="Фамилия автора" value="<?= $lastName; ?>">
        <br><br>
        <button type="submit">Отправить</button>
    </form>
</body>
</html>
