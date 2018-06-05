<?php

namespace App\Http\Controllers;

use App\Facades\Settings;
use App\Models\CoinLog;
use App\Models\Notice;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public $coin_name;

    public function __construct()
    {
        $this->middleware('auth:users');
        $this->coin_name = Settings::get('coin_name');
    }

    public function index()
    {
        $user = Auth::user();

        $coin = $user->coin;

        $inviter = User::where('inviter' , $user->hash)->count();

        $today_get = CoinLog::where(['type' =>3 , 'user_id' => $user->id])->whereDate('updated_at' , '=' , Carbon::today()->toDateString())->sum('coin');

        $today_get = $today_get ? $today_get : 0;

        $income = CoinLog::where(['type' =>3 , 'user_id' => $user->id])->sum('coin');

        $income = $income ? $income : 0;

        $notices = Notice::whereNotNull("published_at")->orderBy('published_at' , 'desc')->get();
        $coin_name = $this->coin_name;

        return view('home.index' , compact('coin' ,'inviter' , 'today_get' , 'income' , 'notices' , 'coin_name'));
    }

    public function notice($id)
    {
        $notice = Notice::find($id);
        $coin_name = $this->coin_name;
        return view('home.notice' , compact('notice' , 'coin_name'));
    }
}
