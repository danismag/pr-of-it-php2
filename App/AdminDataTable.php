<?php


namespace App;


class AdminDataTable
{
    protected $functions = [];
    protected $models = [];

    public function __construct(array $models, array $functions)
    {
        $this->models = $models;
        $this->functions = $functions;
    }

    public function render()
    {
        foreach ($this->models as $model) {

            foreach ($this->functions as $function) {

                yield $function($model);
            }
        }
    }

}