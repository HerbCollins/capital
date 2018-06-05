<?php
/**
 * Created by PhpStorm.
 * User: Maker <maker68@163.com>
 * GITHUB: HerbCollins <http://github.com/herbcollins>
 * Date: 2018/5/23 0023
 * Time: 17:39
 */

namespace App\Services;


use App\Models\Setting;

class SettingsService
{

    public static function get($key = "")
    {
        $value = Setting::where('key' ,$key)->value('value');
        return $value;
    }

    public static function set($key = "" ,  $value = "" )
    {
        $find = Setting::where('key' , $key)->first();
        if(isset($find->id) && $find->id > 0){

            $find->key = $key;
            $find->value = $value;
            return $find->save();
        }else{
            $setting = new Setting();
            $setting->key = $key;
            $setting->value = $value;
            return $setting->save();
        }
    }
}