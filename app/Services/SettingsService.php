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
        return json_decode(json_encode($value));
    }

    public static function set($key = "" , array $value = [])
    {
        $setting = new Setting();
        $setting->key = $key;
        $setting->value = json_encode($value);
        return $setting->save();
    }
}