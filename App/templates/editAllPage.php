<!DOCTYPE HTML>
<html>
<head>
    <title>Страница редактирования новостей</title>
</head>
<body>
<nav>
    <a href="/">На главную</a> |
    <a href="/edit.php?action=new">Добавить новость</a> |
</nav>
<TABLE>
    <CAPTION><H2>Новости</H2></CAPTION>
    <TR>
        <TH>Заголовок</TH>
        <TH>Новость</TH>
    </TR>

    <?php foreach ($news as $article): ?>

        <TR>
            <TD><?= $article->title; ?></TD>
            <TD><?= $article->text; ?></TD>
            <TD><a href="/edit.php?action=edit&id=<?= $article->id; ?>">Редактировать</a></TD>
            <TD>&nbsp;</TD>
            <TD><a href="/edit.php?action=delete&id=<?= $article->id; ?>">Удалить</a></TD>
        </TR>

    <?php endforeach; ?>

</TABLE>

</body>
</html>
