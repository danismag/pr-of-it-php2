<!DOCTYPE HTML>
<html>
<head>
    <title>Страница новостей</title>
</head>
<body>
<nav>
    <a href="/">На главную</a> |
    <a href="/admin/new">Добавить новость</a> |
    <a href="/admin/default">Редактировать новости</a>
</nav>
<H1>Новость дня</H1>
<H3><?= $article->title; ?></H3>
<p><?= $article->text; ?></p>
<p>
    <?= $article->author->firstName; ?>
    <?= $article->author->lastName; ?>
</p>

</body>
</html>
