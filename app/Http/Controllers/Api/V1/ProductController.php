<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Servises\JsonResult;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use JsonResult;

    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $product = $this->product->categoryFilter($request->category)->paginate(10);
        return ProductResource::collection($product);

    }

}
