<?php

namespace App\Http\Controllers;

use App\Http\Repositories\Interfaces\WalletRepositoryInterface;
use App\Http\Requests\CsvRequest;
use App\Http\Services\Csv as CsvServices;
use Illuminate\Support\Facades\Storage;
use Psy\Util\Str;

class CsvController extends Controller
{

    private $csvServices;

    /**
     * CsvController constructor.
     * @param CsvServices $csvServices
     */
    public function __construct(CsvServices $csvServices)
    {
        $this->csvServices = $csvServices;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function upload()
    {
        return view('csv.upload');
    }

    /**
     * @param CsvRequest $request
     * @return \Exception|\Illuminate\Http\JsonResponse
     */
    public function storeCsv(CsvRequest $request)
    {
        $path = storage_path() . '/app/' . $request->file('csv')->storeAs('public', \Illuminate\Support\Str::uuid() . '.csv');
        return $this->csvServices->saveCsv($path);

    }

}
