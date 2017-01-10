<?php

$db = new \App\Db();

/*$res = $db->execute(
    'INSERT INTO news (title, text) VALUES (:head, :cont)',
    [
        ':head' => 'Миграция слонов',
        ':cont' => 'Жители хутора Новотитаровский сообщают, что вчера видели стадо индийских слонов, неспешно направлявшихся к реке около пяти вечера'
]);

var_dump($res);*/
echo '<br>';
var_dump($db->query('SELECT * FROM news WHERE id = 1'));