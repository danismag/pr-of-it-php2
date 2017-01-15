<!DOCTYPE HTML>
<html>
<head>
    <title>Главная страница</title>
</head>
<body>
<nav>
    <a href="/article.php?action=new">Добавить новость</a> |
    <a href="/article.php?action=edit">Редактировать новости</a> |
    <a href="/article.php?action=delete">Удалить новости</a>
</nav>
<TABLE>
    <CAPTION><H2>Последние новости</H2></CAPTION>
    <TR>
        <TH>Заголовок</TH>
        <TH>Новость</TH>
    </TR>

    <?php foreach ($lastNews as $article): ?>

        <TR>
            <TD><a href="/article.php?action=view&id=<?= $article->id; ?>"><?= $article->title; ?></a>
            </TD>
            <TD><?= $article->text; ?></TD>
        </TR>

    <?php endforeach; ?>

</TABLE>
</body>
</html>