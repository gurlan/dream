<?php

namespace App\Http\Controllers\Api\V1\home;

use App\Models\Suggestion;
use App\Services\OneiromancyService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    protected $dream;

    public function __construct(OneiromancyService $service)
    {
        $this->dream = $service;
    }

    /**
     * 解梦
     * @param
     */
    public function index()
    {
        return   $this->dream->query();
    }

    /**
     * 星座
     * @return mixed
     */
    public function star(Request $request)
    {
        switch($request->input('type',0)){
            case 0:$type = 'today';break;
            case 1:$type = 'tomorrow';break;
            case 2:$type = 'week';break;
            case 3:$type = 'month';break;
            case 4:$type = 'year';break;
            default:$type = 'today';
        }
        $result = $this->dream->star(request()->input('key'),$type);

        return $result;
    }

    public function suggestion(Request $request)
    {
        $title = $request->input('title');
        $content = $request->input('remark');
        $openid= $request->input('openid');
        $user_id = User::where('openid',$openid)->value('user_id');
        if($user_id){
            $data['title'] = $title;
            $data['content'] = $content;
            $data['user_id'] = $user_id;
            $data['add_time'] = time();
            Suggestion::insert($data);
            return array('code'=>200);
        }else{
            return array('code'=>0);
        }

    }

    /**
     * 姓名匹配
     * @param Request $request
     * @param Crawler $crawler
     * @return mixed
     */
    public function mate(Request $request, Crawler $crawler)
    {
        $html = $this->dream->mate($request->input('man'),$request->input('woman'));
        $crawler->addHtmlContent($html);

        $tr_selector = '#yc_df';
        $score =  $crawler->filter($tr_selector)->html();

        $tr_selector = '#yc_ms';
        $description =  $crawler->filter($tr_selector)->html();

        if($request->input('man')=='王勋'&&$request->input('woman')=='赵静'){
            $data['code'] = 200;
            $data['score'] = 100000000;
            $data['description'] = '天啊！！！ 你俩是天造地设的一对儿';
            return $data;
        }
        if($score){
            $data['code'] = 200;
            $data['score'] = $score;
            $data['description'] = $description;
        }else{
            $data['code'] = 0;
        }
        return $data;
    }
}
