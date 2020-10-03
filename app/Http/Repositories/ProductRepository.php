<?php
/**
 * Created by PhpStorm.
 * User: rasez
 * Date: 8/7/20
 * Time: 4:18 PM
 */

namespace App\Http\Repositories;

use App\Http\Repositories\Interfaces\ProductRepositoryInterface;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProductRepository implements ProductRepositoryInterface
{
    /**
     * create new product
     * @param $category
     * @param $csvRow
     * @return Product
     */
    public function create($category, $csvRow): Product
    {
        $product = new Product();
        $product->name = $csvRow['name'];
        $product->category_id = $category;
        $product->price = $csvRow['price'];
        $product->description = $csvRow['description'];
        $product->stock = $csvRow['stock'];
        $product->save();
        return $product;
    }

}
