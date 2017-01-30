<?php

namespace App\Models;

use App\Model;

/**
 * Class Article
 * @package App\Models
 * @property \App\Models\Author author
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
            return new Author;
        }
    }

    /**
     * Заполняет поле author_id
     * @param array $data
     */
    public function fill($data = [])
    {
        parent::fill($data);

        if (!empty($data['author'])) {

            if ($this->author_id) {
                $author = Author::findById($this->author_id);
            } else {
                $author = new Author;
            }

            $author->fill($data['author']);
            $author->save();
            $this->author_id = $author->id;
        }
    }
}