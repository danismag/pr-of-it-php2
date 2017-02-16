<?php


namespace App;


use App\Models\Article;

class AdminDataTable
{
    protected $functions = [];
    protected $models = [];

    /**
     * AdminDataTable constructor.
     * @param array $models
     * @param array $functions
     */
    public function __construct(array $models, $functions = [])
    {
        $this->models = $models;
        $this->functions = $functions ?: $this->getArticleFuncArray();
    }

    public function render():array
    {
        $table = [];
        foreach ($this->models as $model) {

            $row = [];
            foreach ($this->functions as $function) {

                $row[] = $function($model);
            }
            $table[] = $row;
        }

        return $table;
    }

    protected function getArticleFuncArray():array
    {
        return [
            function(Article $article)
            {
                return $article->id;
            },
            function(Article $article)
            {
                return $article->title;
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
                return $article->id;
            },
            function(Article $article)
            {
                return $article->id;
            },
        ];
    }

}