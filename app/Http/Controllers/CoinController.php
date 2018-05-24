<?php

namespace App\Http\Controllers;

use App\Models\Miner;
use Illuminate\Http\Request;

use App\Http\Requests;

class CoinController extends Controller
{
    public function index()
    {
        $miners = Miner::all();
        return view('coin.index' , compact('miners'));
    }
}
