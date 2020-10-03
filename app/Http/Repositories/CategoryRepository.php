<?php
/**
 * Created by PhpStorm.
 * User: rasez
 * Date: 8/7/20
 * Time: 4:18 PM
 */

namespace App\Http\Repositories;

use App\Http\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CategoryRepository implements CategoryRepositoryInterface
{
    /**
     * create new category
     * @param $csvRow
     * @return Category
     */
    public function create($csvRow): Category
    {
        $category = new Category();
        $category->name = $csvRow['category'];
        $category->parent_id = 0;
        $category->description = $csvRow['category-desc'];
        $category->save();
        return $category;
    }

}
