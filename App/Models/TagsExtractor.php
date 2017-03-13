<?php


namespace App\Models;


class TagsExtractor
{
    protected $text;

    public function __construct($text)
    {
        $this->text = $text;
    }

    public function getTagsValue():array
    {
        return $this->extractTags(
            '~\[(?P<key>\w+):?.*\](?P<value>.+)\[\/(?P=key)\]~',
            '~.*\[.*\].*\[\/.*\]~U');
    }

    public function getTagsDescription():array
    {
        return $this->extractTags(
            '~\[(?P<key>\w+):+(?P<value>.+)\].+\[\/(?P=key)\]~',
            '~.*\[.*:+.+\].+\[\/.*\]~U');
    }

    protected function extractTags(string $searchPattern, string $excludePattern):array
    {
        $result = [];
        $text = $this->text;
        while (preg_match($searchPattern, $text, $matches)) {

            $result[$matches['key']] = $matches['value'];
            $matches = [];
            $text = preg_replace($excludePattern, '', $text, 1);
        }
        return $result;
    }

}