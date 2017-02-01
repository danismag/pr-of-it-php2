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
    protected static $mustNotBeFilled = ['id', 'author', 'author_id'];
    protected static $table = 'news';

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

    public function __isset($key):bool
    {
        if ('author' === $key) {
            return true;
        }
        return false;
    }
    
    /**
     * Заполняет поле author_id
     * @param array $data
     */
    public function fill(array $data)
    {
        parent::fill($data);

        if (null !== $this->author_id) {
            $author = Author::findById($this->author_id);
        } else {
            $author = new Author;
        }

        $author->fill($data['author']);
        $author->save();
        $this->author_id = $author->id;
    }

    protected function validateTitle($str):bool
    {
        return $this->validateString($str);
    }

    protected function validateText($str):bool
    {
        return $this->validateString($str);
    }
}