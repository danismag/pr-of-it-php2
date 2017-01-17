<?php

namespace App\Models;

use App\Model;

class Author
    extends Model
{

    public static $table = 'authors';

    public $firstName;
    public $lastName;

    /**
     * Author constructor.
     * @param array $data
     */
    public function __construct($data = [])
    {
        if (isset($data)){

            $this->firstName = $data['firstName'];
            $this->lastName = $data['lastName'];
        }
    }

}