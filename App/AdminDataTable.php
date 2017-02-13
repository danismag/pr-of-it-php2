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
     * @param string $funkArrayName
     * @param array $functions
     */
    public function __construct(array $models, $funkArrayName = null, $functions = [])
    {
        $this->models = $models;

        if (null === $funkArrayName) {

            $this->functions = $functions;
        } else {

            $funkArrayMethod = 'get' . $funkArrayName . 'FuncArray';
            $this->functions =
                method_exists($this, $funkArrayMethod) ?
                    $this->$funkArrayMethod() :
                    [];
        }
    }

    public function render()
    {
        if (!empty($this->functions)) {

            foreach ($this->models as $model) {

                foreach ($this->functions as $function) {

                    yield $function($model);
                }
            }
        }
    }

    /**
     * Выдает строку таблицы в виде массива
     * @return \Generator
     */
    public function renderRow()
    {
        if (count($this->functions) > 0) {

            $row = [];
            $row_count = count($this->functions);
            foreach ($this->render() as $gen) {

                $row[] = $gen;
                $row_count--;
                if ($row_count === 0) {

                    yield $row;
                    $row = [];
                    $row_count = count($this->functions);
                }
            }
        }

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