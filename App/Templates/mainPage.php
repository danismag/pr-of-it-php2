<!DOCTYPE HTML>
<html>
<head>
    <title>Главная страница</title>
</head>
<body>
<nav>
    <a href="/edit.php?action=new">Добавить новость</a> |
    <a href="/edit.php">Редактировать новости</a>
</nav>
<TABLE>
    <CAPTION><H2>Последние новости</H2></CAPTION>
    <TR>
        <TH>Заголовок</TH>
        <TH>Новость</TH>
        <TH>Имя и фамилия автора</TH>
    </TR>

    <?php foreach ($lastNews as $article): ?>

        <TR>
            <TD><a href="/article.php?id=<?= $article->id; ?>"><?= $article->title; ?></a>
            </TD>
            <TD><?= $article->text; ?></TD>
            <TD>
                <?= $article->author->firstName; ?>
                <?= $article->author->lastName; ?>
            </TD>
        </TR>

    <?php endforeach; ?>

</TABLE>
</body>
</html>