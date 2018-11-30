<?php

namespace App\Http\Controllers\Api\V1\Home;

use App\Services\Baidu\AipOcr;
use Laravel\Lumen\Routing\Controller as BaseController;
use App\Services\Baidu\AipFace;
class WordController extends BaseController
{
    // 你的 APPID AK SK
    const APP_ID = '15001985';
    const API_KEY = 'm50iqnG7HlbXjUWPdm2UdKMx';
    const SECRET_KEY = 'PLCYf1MEgs2ya7nf9uV86oUdBxvG3oiV';

    public function index(){

        $client = new AipOcr(self::APP_ID, self::API_KEY, self::SECRET_KEY);


        $image = public_path('statics/image/5684e50f83402.png') ;


// 调用通用文字识别, 图片参数为本地图片
        $client->basicGeneral($image);

// 如果有可选参数
        $options = array();
        $options["language_type"] = "CHN_ENG";
        $options["detect_direction"] = "true";
        $options["detect_language"] = "true";
        $options["probability"] = "true";

// 带参数调用通用文字识别, 图片参数为本地图片
        $client->basicGeneral($image, $options);
        $url = "http//www.x.com/sample.jpg";

// 调用通用文字识别, 图片参数为远程url图片
        $client->basicGeneralUrl($url);

// 如果有可选参数
        $options = array();
        $options["language_type"] = "CHN_ENG";
        $options["detect_direction"] = "true";
        $options["detect_language"] = "true";
        $options["probability"] = "true";

// 带参数调用通用文字识别, 图片参数为远程url图片
        $res = $client->basicGeneralUrl($url, $options);

        dd($res);


    }
}
