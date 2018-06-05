<?php

namespace App\Http\Controllers\Admin;

use App\Facades\Settings;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function system()
    {
        $settings['site_name'] = Settings::get('site_name');
        $settings['coin_name'] = Settings::get('coin_name');
        return view('admin.system' , compact('settings'));
    }

    public function systemsetting(Request $request)
    {
        $attrs = $request->except('_token');
        if($attrs){
            foreach ($attrs as $key => $value){
                Settings::set($key , $value);
            }
        }
        return Redirect::to(url('admin/system'));
    }
}
