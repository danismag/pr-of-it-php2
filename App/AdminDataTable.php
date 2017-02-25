<?php


namespace App;



class AdminDataTable
{
    protected $functions = [];
    protected $models = [];

    /**
     * AdminDataTable constructor.
     * @param array $models
     * @param array $functions
     */
    public function __construct(array $models, array $functions)
    {
        $this->models = $models;
        $this->functions = $functions;
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
}