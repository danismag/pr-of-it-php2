<?php

require __DIR__ . '/../../App/autoload.php';

\App\Models\Article::findById($_GET['id'])->delete();

header('Location: /admin');
exit;