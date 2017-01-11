<?php

namespace App\Models;

use App\Model;

class Article
    extends Model
{

    public static $table = 'news';

    public $title;
    public $text;

    /**
     * Возвращает последние 3 новости
     * @param int $num
     * @return array
     */
    public static function getLast($num = 3)
    {
        return self::findLast($num);
    }

}