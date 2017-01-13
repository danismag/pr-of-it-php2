<?php

$db = new \App\Db();

echo 'Добавление новости ';
$res = $db->execute(
    'INSERT INTO news (title, text) VALUES (:head, :cont)',
    [
        ':head' => 'Миграция слонов',
        ':cont' => 'Жители хутора Новотитаровский сообщают, что вчера видели стадо индийских слонов, неспешно направлявшихся к реке около пяти вечера'
]);

var_dump($res);
echo 'Проверка результата<br>';
var_dump($db->query("SELECT * FROM news WHERE title = 'Миграция слонов'"));

echo '<br><br> Создание нового столбца в таблице ';
$res = $db->execute('ALTER TABLE news ADD date TIMESTAMP');

var_dump($res);
echo '<br><br>Новый перечень стобцов<br>';
var_dump($db->query('DESCRIBE news'));

echo '<br><br>Удаление добавленного столбца ';
$res = $db->execute('ALTER TABLE news DROP date');

var_dump($res);
echo '<br><br>Первоначальный набор полей таблицы<br>';
var_dump($db->query('DESCRIBE news'));
