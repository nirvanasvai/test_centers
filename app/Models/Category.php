<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'title',
        'description',
        'category_id'
    ];

//    public function countProductsInSubCategories()
//    {
//        $ar = [];
//        $categoryIds = Category::get(['id'])->pluck('id')->toArray();
//        foreach ($categoryIds as $categoryId)
//        {
//            $ar[] = [
//                'count' => Product::query()->where('category_id', $categoryId)->count(),
//                'category_id' => $categoryId
//            ];
//
//        }
//        return $ar;
//
//    }

    public function categoriesRelationship()
    {

        return $this->hasMany(self::class,'category_id','id');
    }
    public function productsRelationship()
    {
        return $this->hasMany(Product::class,'id','category_id');
    }

    public function childrenCategories()
    {
        return $this->hasMany(self::class)->with('categoriesRelationship');
    }



}
