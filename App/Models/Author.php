<?php

namespace App\Models;

use App\Model;

class Author
    extends Model
{
    protected static $mustNotBeFilled = ['id'];
    protected static $table = 'authors';

    public $firstName;
    public $lastName;

    protected function validateFirstName($str):bool
    {
        return $this->validateString($str);
    }

    protected function validateLastName($str):bool
    {
        return $this->validateString($str);
    }

}