<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'page_id',
        'lang_id',
        'name',
        'menu_type',
        'position',
        'order',
        'status',
    ];

     public function page()
    {
        return $this->belongsTo(DynamicPage::class, 'page_id', 'id');
    }

    public function language()
    {
        return $this->belongsTo(Language::class, 'lang_id', 'id');
    }
}
