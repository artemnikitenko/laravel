<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Neo extends Model
{
    protected $primaryKey = 'id';
    public $incrementing = 'id';
    public $timestamps = FALSE;

}
