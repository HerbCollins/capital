<?php

namespace App\Http\Controllers\User;

use App\Facades\Settings;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public $coin_name;

    const COIN_NAME = 'coin_name';

    public function __construct()
    {
        $this->coin_name = Settings::get(self::COIN_NAME);
    }

    public function index()
    {
        $user = Auth::user();
        $coin_name = $this->coin_name;
        return view('users.index' , compact('user' , 'coin_name'));
    }
}
