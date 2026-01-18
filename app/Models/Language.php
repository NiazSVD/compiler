<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Language extends Model
{
    // use SoftDeletes;


    protected $fillable = [
        'name',
        'display_name',
        'version',
        'runtime',
        'is_active',
        'is_default',
        'slug',
        'icon',
        'icon_color',
        'description'
    ];


    protected $casts = [
        'is_active' => 'boolean',
        'is_default' => 'boolean'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getIconShowAttribute()
    {
        if ($this->icon && file_exists(public_path($this->icon))) {
            return asset($this->icon);
        }

        return asset('uploads/code.png');
    }

    protected $appends = ['icon_show'];
}
