<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class CoinController extends Controller
{
    public function index()
    {
        return view('coin.index');
    }
}
