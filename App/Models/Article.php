<?php

namespace App\Models;

use App\Model;

class Article
    extends Model
{

    public static $table = 'news';

    public $title;
    public $text;

}