<!DOCTYPE HTML>
<html>
<head>
    <title>Список новостей</title>
</head>
<body>
<nav>
    <a href="/">На главную</a> |
    <a href="/article.php?action=new">Добавить новость</a> |
    <a href="/article.php?action=edit">Редактировать новости</a> |
    <a href="/article.php?action=delete">Удалить новости</a>
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
            <TD><a href="/article.php?action=delete&id=<?= $article->id; ?>">Удалить</a></TD>
        </TR>

    <?php endforeach; ?>

</TABLE>

</body>
</html>