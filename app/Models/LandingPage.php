<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LandingPage extends Model
{
    protected $fillable = ['header_text','header_description','description','header_color','hero_color','body_color','footer_color','language_color'];
}
