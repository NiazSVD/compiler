<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Translatable;

class LandingPage extends Model
{
    use Translatable;

    protected $fillable = ['key', 'value'];

}
