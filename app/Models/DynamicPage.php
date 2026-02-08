<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Translatable;

class DynamicPage extends Model
{
    use Translatable;

    protected $fillable = [
        'page_title',
        'page_slug',
        'order',
        'page_content',
        'status',
        'meta_title',
        'meta_tags',
        'meta_description'
    ];
}
