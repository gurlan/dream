<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;


class LoginController extends Controller
{

    const APPID = 'wxcecf234ee62295c6';
    const SECRET = 'a94c4c0d8171009c25c308bb640cb398';

    public function login(Request $request)
    {
        $code =$request->input('code');
        $url = "https://api.weixin.qq.com/sns/jscode2session?appid=".self::APPID."&secret=".self::SECRET."&js_code=".$code."&grant_type=authorization_code";
        $result = file_get_contents($url);
        $result = json_decode($result,true);
        $user =   new User();
        if($result['openid']) //如果拿到openid，去数据库查
        {
          $user_info =  $user->where('openid',$result['openid'])->first();
            if(!$user_info){
                $user->openid = $result['openid'];
                $user->session_key = $result['session_key'];
                $user->register_time = time();
                $user->last_time = time();
                $user->save();
            }else{
                $user->where('openid',$result['openid'])->update(['last_time'=>time(),'session_key'=> $result['session_key']]);
            }
            return $result['openid'];
        }
    }

    /**
     * 获取授权后 更新用户信息
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Model|null|object|static
     */
    public function update_user_info(Request $request)
    {

        $openid = $request->input('openid');

        $data['avatarUrl'] = $request->input('avatarUrl');
        $data['nickName'] = $request->input('nickName');
        $data['city'] = $request->input('city');
        $data['province'] = $request->input('province');
        $data['is_ok'] = 1;
        return User::where('openid',$openid)->update($data);

    }
    public function get_user_info(Request $request)
    {
        $openid = $request->input('openid');
        return    User::where('openid',$openid)->first();
    }

}
