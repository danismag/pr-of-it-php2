<?php


namespace App\Models;


class TextTags
{
    protected $text;

    public function __construct($text)
    {
        $this->text = $text;
    }

    public function getTagsValue():array
    {
        preg_match('',
            $this->text, $result);
        return $result;
    }

    public function getTagsDescription():array
    {
        preg_match('',
            $this->text, $result);
        return $result;
    }

}