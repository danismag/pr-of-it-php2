Вы правы насчет выброса 404 в модели - это должны решать бизнес-логика: перевел в конкретный контроллер. Спасибо!
Подключил библиотеку twig и переделал шаблоны.
Подключил библиотеку phpunit/php-timer, добавил вывод информации в шаблоны.
Проверьте, пожалуйста, реализацию этих библиотек.
Реализовал генератор Db:queryEach() и использовал его для Model::getLast($num).
Класс AdminDataTable с методом render() реализовал, но не могу понять, как его можно использовать в админ-панели: все мои способы приводят только к усложнению кода. Подскажите направление размышлений.