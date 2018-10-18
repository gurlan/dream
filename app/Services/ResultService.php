<?php
/**
 * 返回结果输出格式化类
 * Created by IntelliJ IDEA.
 * User: xuml
 * Date: 2018/3/25
 * Time: 14:18
 */

namespace App\Services;
//自定义返回状态码
define("MAYI_RESULT_SUCCESS",0);//成功
define("MAYI_RESULT_PARAM_ERROR",100400);//参数错误
define("MAYI_RESULT_UNAUTHORIZED",100401);//未认证、未登录
define("MAYI_RESULT_VALIDATE_ERROR",100402);//表单验证不通过
define("MAYI_RESULT_FORBIDDEN",100403);//没有权限
define("MAYI_RESULT_SIGN_ERROR",100410);//签名错误
define("MAYI_RESULT_FAILED",100411);//操作失败
define("MAYI_RESULT_STATUS_ERROR",100420);//状态错误

class ResultService
{
    public $code = MAYI_RESULT_SUCCESS;

    public $error='';

    public $info='';

//    const MAYI_RESULT_SUCCESS = 0;//成功
//    const MAYI_RESULT_PARAM_ERROR = 100400;//参数错误
//    const MAYI_RESULT_UNAUTHORIZED = 100401;//未认证、未登录
//    const MAYI_RESULT_VALIDATE_ERROR = 100402;//表单验证不通过
//    const MAYI_RESULT_FORBIDDEN = 100403;//没有权限
//    const MAYI_RESULT_SIGN_ERROR = 100410; //签名错误
//    const MAYI_RESULT_FAILED = 100411; //操作失败
//    const MAYI_RESULT_STATUS_ERROR = 100420; //状态错误


    function __construct($code = MAYI_RESULT_SUCCESS,$info='',$error=''){
        $this->code = $code;
        $this->info = $info;
        $this->error = $error;
    }

    /**
     * @return the $code
     * @auth zr
     * @date 2015-6-3 上午12:02:41
     */
    public function getCode() {
        return $this->code;
    }

    /**
     * @return the $info
     * @auth zr
     * @date 2015-6-3 上午12:02:41
     */
    public function getInfo() {
        return $this->info;
    }

    /**
     * @param field_type $code
     * @auth zr
     * @date 2015-6-3 上午12:02:41
     */
    public function setCode($code) {
        $this->code = $code;
        return $this;
    }

    /**
     * @param field_type $error
     * @auth zr
     * @date 2015-6-3 上午12:02:41
     */
    public function setError($error,$code=MAYI_RESULT_FAILED) {
        $this->error = $error;
        $this->code = $code;
        return $this;
    }

    /**
     * @param field_type $info
     * @auth zr
     * @date 2015-6-3 上午12:02:41
     */
    public function setInfo($info,$code=MAYI_RESULT_SUCCESS) {
        $this->info = $info;
        $this->code = $code;
        return $this;
    }

    public function __toString(){
        return json_encode($this);
    }
}