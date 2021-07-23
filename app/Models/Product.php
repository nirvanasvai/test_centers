<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name','slug','category_id','description'];

    public static function boot()
    {
        parent::boot();

        self::created(function ($model) {

            $model->slug = Str::slug(mb_substr($model->name, 0, 40) . '-' . $model->id);
            $model->save();
        });
    }

    public function getCategory()
    {
        return $this->hasMany(Category::class,'id','category_id');
    }
}
