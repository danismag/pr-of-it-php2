<?php


namespace App;


use App\Models\Article;

class AdminDataTable
{
    protected $functions = [];
    protected $models = [];

    public function __construct(array $models, $functions = [])
    {
        $this->models = $models;
        $this->functions = $functions ?: $this->getArticleFuncArray();
    }

    public function render()
    {
        ob_start();
        foreach ($this->models as $model) {

            echo '<TR>';
            foreach ($this->functions as $function) {

                echo '<TD>'. $function($model) .'</TD>';
            }
            echo '</TR>';
        }
        return ob_get_clean();
    }

    protected function getArticleFuncArray():array
    {
        return [
            function(Article $article)
            {
                return "<a href='/index/one/$article->id'>$article->title</a>";
            },
            function(Article $article)
            {
                return $article->text;
            },
            function(Article $article)
            {
                return $article->author->firstName .' '. $article->author->lastName;
            },
            function(Article $article)
            {
                return "<a href='/admin/edit/$article->id'>Редактировать</a>";
            },
            function(Article $article)
            {
                return "<a href='/admin/delete/$article->id'>Удалить</a>";
            },
        ];
    }

}