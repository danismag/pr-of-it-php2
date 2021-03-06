<!DOCTYPE HTML>
<html>
<head>
    <title>Добавление/редактирование новости</title>
</head>
<body>
    <nav>
        <a href="/">На главную</a> |
        <a href="/admin/new">Добавить новость</a> |
        <a href="/admin/default">Редактировать новости</a>
    </nav>
    <br><br>
    <?php if (isset($errors)): ?>
        <?php foreach ($errors as $error): ?>
            <p style="color: crimson"><?= $error->getMessage(); ?></p>
        <?php endforeach; ?>
    <?php endif; ?>
    <br><br>

    <form method="POST" action="/admin/save/<?= $article->id; ?>">

        <label for="inputTitle">Заголовок новости</label>
        <input type="text" name="article[title]" id="inputTitle" size="40%" placeholder="Введите заголовок новости" value="<?= $article->title; ?>">
        <br><br>
        <label for="inputText">Текст новости</label>
        <textarea type="text" name="article[text]" id="inputText" cols="67" rows="5" placeholder="Введите текст новости"><?= $article->text; ?></textarea>
        <br><br>
        <label for="inputText">Автор новости</label>
        <input type="text" name="article[author][firstName]" id="inputTitle" size="20%" placeholder="Имя автора" value="<?= $article->author->firstName; ?>">
        <input type="text" name="article[author][lastName]" id="inputTitle" size="20%" placeholder="Фамилия автора" value="<?= $article->author->lastName; ?>">
        <br><br>
        <button type="submit">Отправить</button>
    </form>
</body>
</html>
