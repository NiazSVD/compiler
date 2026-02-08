<?php

namespace App\Traits;

use App\Models\Translation;

trait Translatable
{
    protected static function bootTranslatable()
    {
        static::deleting(function ($model) {
            $model->translations()->delete();
        });
    }

    public function translations()
    {
        return $this->morphMany(Translation::class, 'translationable');
    }

    // public function getTranslation($key, $locale = null)
    // {
    //     $locale = $locale ?: app()->getLocale();

    //     $translation = $this->translations
    //         ->where('locale', $locale)
    //         ->where('key', $key)
    //         ->first();

    //     return $translation ? $translation->value : $this->$key;
    // }

    public function getTranslation($key, $locale = null)
    {
        $locale = $locale ?: app()->getLocale();

        $translation = $this->translations
            ->where('locale', $locale)
            ->where('key', $key)
            ->first();

        if ($translation) {
            return $translation->value;
        }

        if (isset($this->attributes[$key])) {
            return $this->$key;
        }

        return $this->value;
    }
}
