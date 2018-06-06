<?php
/**
 * Created by PhpStorm.
 * User: Maker <maker68@163.com>
 * GITHUB: HerbCollins <http://github.com/herbcollins>
 * Date: 2018/6/5 0005
 * Time: 22:47
 */

namespace App\Repositories;

use App\Services\AlidayuSignHelperService as SignHelper;
use Illuminate\Support\Facades\Redis;

class SMSRepository
{

    private $accessKeyId;

    private $accessKeySecret;

    const SIGN_NAME = "张长恩";

    const TEMPLATE_CODE = "SMS_136680126";

    const PREFIX_SAVE_SESSEION = 'CODE_';


    public function __construct()
    {
        $this->accessKeyId = '1cEjUoLuLoG9ieXu';
        $this->accessKeySecret = "HXA48nJ4Lu1hcen5vJWGrBvtkhRJMo";
    }

    /**
     * 发送短信
     */
    public function send($phone , array $param = [] )
    {
        $params = array ();

        $params["PhoneNumbers"] = $phone;

        $params["SignName"] = self::SIGN_NAME;

        $params["TemplateCode"] = self::TEMPLATE_CODE;

        $params['TemplateParam'] = $param;

        if(!empty($params["TemplateParam"]) && is_array($params["TemplateParam"])) {
            $params["TemplateParam"] = json_encode($params["TemplateParam"], JSON_UNESCAPED_UNICODE);
        }


        $helper = new SignHelper();

        // 此处可能会抛出异常，注意catch
        $content = $helper->request(
            $this->accessKeyId,
            $this->accessKeySecret,
            "dysmsapi.aliyuncs.com",
            array_merge($params, array(
                "RegionId" => "cn-hangzhou",
                "Action" => "SendSms",
                "Version" => "2017-05-25",
            ))
        );

        return $content;
    }

    /**
     * @param $phone
     * @param $code
     *
     * @return bool
     * @author Maker <maker68@163.com>
     */
    public function check($phone , $code)
    {
        $key = self::PREFIX_SAVE_SESSEION . $phone;

        if(Redis::exists($key)){
            if(Redis::get($key) == $code){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
}