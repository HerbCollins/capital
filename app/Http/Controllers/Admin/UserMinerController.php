<?php

namespace App\Http\Controllers\Admin;

use App\Models\UserMiner;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserMinerController extends Controller
{
    private $userMiner;

    public function __construct()
    {
        $this->middleware('CheckPermission:userminers');
    }

    public function index()
    {
        $userminers = UserMiner::orderBy('created_at' , 'desc')->with('miner')->paginate(20);
        return view('admin.userminers.index' ,compact('userminers'));
    }
}
