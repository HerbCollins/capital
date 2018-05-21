<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PriceRequest;
use App\Models\Price;
use App\Repositories\Eloquent\PriceRepositoryEloquent as PriceRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Validator;

class PriceController extends Controller
{
    private $price;

    public function __construct(PriceRepository $priceRepository)
    {
        $this->middleware('CheckPermission:coinprices');

        $this->price = $priceRepository;
    }

    public function index()
    {
        $attrs = ['id' , 'price' , 'updated_at'];
        $prices = $this->price->getAll($attrs);
        $price = $this->price->orderBy('updated_at' , 'desc')->first();

        return view('admin.prices.index' , compact('price' , 'prices'));
    }

    public function store(PriceRequest $request)
    {
        $attrs = $request->all();
        $attrs['day'] = Carbon::today()->toDateString();
        $this->price->createPrice($attrs);
        return redirect('admin/coinprices');
    }

    public function axis()
    {
        $prices = Price::all('price' , 'day');
        return $prices;
    }
}
