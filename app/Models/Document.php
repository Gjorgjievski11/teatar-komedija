<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = ['description', 'image_kit_id', 'category_id', 'sub_category_id', 'url'];

    protected const IS_ANNOUCMENT = 1;
    protected const IS_REGULATIONS = 2;
    protected const IS_FINAL_ACCOUNT = 3;
    protected const IS_PUBLIC_PROCUREMENT = 4;

    protected function scopeSearch($query, $value)
    {
        if ($value) {
            $parts = explode(' ', $value);

            return $query->where(function ($q) use ($parts) {
                foreach ($parts as $part) {
                    $q->orWhere('description', 'like', "%{$part}%");
                }
            });
        }

        return $query;
    }

    protected function scopeSearchCategory($query, $value)
    {
        if ($value) {
            return $query->where('category_id', $value);
        }

        return $query;
    }

    protected static function getCategoryName($id)
    {
        return match ($id) {
            '1', 1 => 'Огласи',
            '2', 2 => 'Правилници',
            '3', 3 => 'Завршна сметка',
            '4', 4 => 'Јавни набавки',
            default => 'Неопределено'
        };
    }

    protected static function getSubCategoryName($id)
    {
        return match ($id) {
            '1', 1 => 'Јавни Огласи',
            '2', 2 => 'Одлуки',
            '3', 3 => 'Архива',
            '4', 4 => 'Правилници',
            '5', 5 => 'Правилник на албански јазик',
            '6', 6 => 'Завршни сметки',
            '7', 7 => 'Јавни набавки',
            '8', 8 => 'Одлуки',
            default => 'Неопределено'
        };
    }
}
