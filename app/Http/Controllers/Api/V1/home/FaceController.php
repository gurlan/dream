<?php

namespace App\Http\Controllers\Api\V1\Home;

use Laravel\Lumen\Routing\Controller as BaseController;
use App\Services\baidu\AipFace;
class FaceController extends BaseController
{
    // 你的 APPID AK SK
    const APP_ID = '14996341';
    const API_KEY = 'oSAsyNgKG4TBNFhCYrxEZxpG';
    const SECRET_KEY = 'GVyANeNtRqNsO5EW0xFzAAQdXsljiRUM ';

    public function index(){

        $client = new AipFace(self::APP_ID, self::API_KEY, self::SECRET_KEY);


        $image = public_path('statics/image/5684e50f83402.png') ;
        $imageType = "BASE64";
        $fp = fopen($image,"rb", 0);

        $gambar = fread($fp,filesize($image));
        fclose($fp);


        $base64 = chunk_split(base64_encode($gambar));
        // 输出
     //   $encode = '<img src="data:image/jpg/png/gif;base64,' . $base64 .'" >';

        $res = $client->detect($base64, $imageType);


// 如果有可选参数
        $options = array();
        $options["face_field"] = "age,beauty,expression,faceshape,gender,glasses,race,quality,facetype";


        $res = $client->detect($base64, $imageType, $options);
        dd($res);



    }
}
