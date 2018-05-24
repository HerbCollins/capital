<?php

namespace App\Http\Controllers;

use App\Models\Price;
use App\Models\Order;
use Illuminate\Http\Request;

use App\Http\Requests;

class TransactionController extends Controller
{
    public function index()
    {
        $present = Price::orderBy('day' , 'desc')->first();

        $max = sprintf("%.2f" , Order::max('price'));
        $min = sprintf("%.2f" , Order::min('price'));

        return view('transaction.index' , compact('present' , 'max' , 'min'));
    }
}
