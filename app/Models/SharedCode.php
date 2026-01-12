<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SharedCode extends Model
{
    protected $fillable = ['token','language','code','stdin'];
}
