<?php

namespace App\Models;

use App\Models\News;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    public function news():HasMany{
        return $this->hasMany(News::class);
    }
    public static function getAllCategories(){
        $categories = self::all();
        return $categories;
    }
}
