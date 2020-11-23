<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table ="employees";
    protected $fillable=['e_right'];
    public $timestamps = false;
    protected $primaryKey = 'e_id';
//
}
