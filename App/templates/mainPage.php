<!DOCTYPE HTML>
<html>
<head>
    <title>Главная страница</title>
</head>
<body>
<TABLE>
    <CAPTION><H1>Последние новости</H1></CAPTION>
    <TR>
        <TH>Заголовок</TH>
        <TH>Новость</TH>
    </TR>

    <?php foreach ($lastNews as $article): ?>

        <TR>
            <TD><a href="/article.php?id=<?= $article->id; ?>"><?= $article->title; ?></a></TD>
            <TD><?= $article->text; ?></TD>
        </TR>

    <?php endforeach; ?>

</TABLE>

</body>
</html>