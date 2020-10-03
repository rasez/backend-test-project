<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property  name
 * @property  category_id
 * @property  price
 * @property  stock
 * @property  description
 */
class Product extends Model
{
    protected $fillable = [
        'name', 'category_id', 'price', 'description', 'stock'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @param $query1
     * @param $category
     */
    public function scopeCategoryFilter($query1, $category)
    {
        $query1->with('category')->whereHas('category', function ($query) use ($category) {
            return $query->where('name', 'LIKE', $category);
        });


    }

}
