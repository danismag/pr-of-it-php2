<?php


namespace App\Models;


class TagsExtractor
{
    protected $text;
//\[(?P<tag1>\w+):?(?P<desc1>.+)?\](?P<tagval>.+)\[\/(?P=tag1)\]

    public function __construct($text)
    {
        $this->text = $text;
    }

    public function getTagsValue():array
    {
        $result = [];
        $text = $this->text;
        while (preg_match(
                '~\[(?P<tag>\w+):?.*\](?P<tagval>.+)\[\/(?P=tag)\]~',
                $text,
                $matches)) {

            $result[$matches['tag']] = $matches['tagval'];

            $matches = [];
            $text = preg_replace('~.*\[.*\].*\[\/.*\]~U', '', $text, 1);
        }
        return $result;
    }

    public function getTagsDescription():array
    {
        preg_match('',
            $this->text, $result);
        return $result;
    }

}