<!DOCTYPE HTML>
<html>
<head>
    <title>Страница редактирования новостей</title>
</head>
<body>
<nav>
    <a href="/">На главную</a> |
    <a href="/admin/new.php">Добавить новость</a>
</nav>
<TABLE>
    <CAPTION><H2>Новости</H2></CAPTION>
    <TR>
        <TH>Заголовок</TH>
        <TH>Новость</TH>
        <TH>Имя и фамилия автора</TH>
    </TR>

    <?php foreach ($news as $article): ?>

        <TR>
            <TD><?= $article->title; ?></TD>
            <TD><?= $article->text; ?></TD>
            <TD>
                <?= $article->author->firstName; ?>
                <?= $article->author->lastName; ?>
            </TD>
            <TD><a href="/admin/edit.php?id=<?= $article->id; ?>">Редактировать</a></TD>
            <TD>&nbsp;</TD>
            <TD><a href="/admin/delete.php?id=<?= $article->id; ?>">Удалить</a></TD>
        </TR>

    <?php endforeach; ?>

</TABLE>

</body>
</html>
