<?php

namespace App\Models;

use App\Model;

/**
 * Class Article
 * @package App\Models
 * @property Author author
 */
class Article
    extends Model
{

    public static $table = 'news';

    public $title;
    public $text;
    public $author_id;

    /**
     * Возвращает последние 3 новости
     * @param int $num
     * @return array
     */
    public static function getLast($num = 3)
    {
        return self::findLast($num);
    }

    public function __get($key)
    {
        if ('author' === $key) {
            if (null !== $this->author_id) {

                return Author::findById($this->author_id);
            }
            return [
                'firstName' => 'Автор',
                'lastName' => 'неизвестен',
            ];
        }
    }


}