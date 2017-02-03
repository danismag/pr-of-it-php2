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

    /**
     * @return string
     */
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

}