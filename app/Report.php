<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{


    protected $table = 'report';


    protected $fillable = ['cubeNumber', 'phoneModel', 'ktt', 'nizz', 'tmg', 'noUnit', 'teacher'];



}
