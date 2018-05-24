<?php

namespace App\Http\Controllers\Admin;

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
        return view('admin.userminers.index');
    }
}
