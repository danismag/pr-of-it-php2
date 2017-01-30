Тайп-хинтинг в Article->_get():Author убрал. 
Спасибо за подсказку с PHPDoc: написал полное имя класса \App\Models\Author
Убрал избыточную проверку в \App\Controller->action($actionName, $params=null) на наличие $params.
Страницу ошибок сделал простенькую.
Исключение 404 бросаю в методе Model::FindById().

