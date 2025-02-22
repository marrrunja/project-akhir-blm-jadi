<?php
namespace App\Models;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class News extends Model
{
    protected $fillable = ["user_id", "body", "category_id", "judul","gambar"];
    protected $with = ["kategoriNews", "userNews"];


    public function kategoriNews():BelongsTo{
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function userNews():BelongsTo{
        return $this->belongsTo(User::class, 'user_id');
    }
}
