<?php

namespace App\Http\Services;

use App\Http\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Http\Repositories\Interfaces\ProductRepositoryInterface;
use App\Http\Servises\JsonResult;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\SimpleExcel\SimpleExcelReader;
use Symfony\Component\HttpFoundation\Response;

class Csv
{
    use JsonResult;

    private $productRepository;
    private $categoryRepository;

    public function __construct(ProductRepositoryInterface $productRepository, CategoryRepositoryInterface $categoryRepository)
    {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function saveCsv($path)
    {
        try {
            $rows = SimpleExcelReader::create($path)->getRows();

            $rows->each(function (array $csvLine) {
                $category = $this->categoryRepository->create($csvLine);
                $this->productRepository->create($category->id, $csvLine);
            });

            return view('csv.success',['message'=>'Csv imported succesfully!']);

        } catch (\Exception $exception) {
            return $exception;
        }
    }

}
