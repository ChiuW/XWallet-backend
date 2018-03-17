<?php

namespace Dolphin\Tan\Controller;

use Psr\Container\ContainerInterface as ContainerInterface;

use Dolphin\Tan\Librarie\Weixin as Lib_weixin;
use Dolphin\Tan\Model\User as Model_user;

/** 
* 简单的类介绍
*  
* @category Controller
* @package  User
* @author   dolphin.wang <416509859@qq.com>
* @license  MIT https://mit-license.org 
* @link     https://github.com/dolphin836/Slim-Skeleton-MVC
* @since    2017-05-18
**/

class User extends Base
{
    /**
    * 构造函数
    *
    * @param interface $app 框架
    *
    * @return void
    **/
    function __construct(ContainerInterface $app)
    {
        parent::__construct($app);
    }
    
    /**
    * 函数说明
    *
    * @param object $request  请求
    * @param object $response 响应
    * @param array  $args     参数
    *
    * @return object
    **/
    public function index($request, $response, $args)
    {   
        $json         = array();

        // 这是一个 Library 使用的例子
        $lib_weixin   = new Lib_weixin();
        $sign         = $lib_weixin->sign($this->data);

        $json['code'] = 0;
        $json['note'] = 'Success.';
        $json['data'] = array('sign' => $sign);
        $json['help'] = 'http://api.app.com';

        return $response->withStatus(200)
            ->withHeader("Content-Type", "application/json")
            ->write(json_encode($json));
    }

    /**
    * 如果你想要输出 JSON 格式的数据，可以参考这个例子
    *
    * @param object $request  请求
    * @param object $response 响应
    * @param array  $args     参数
    *
    * @return object
    **/
    public function user($request, $response, $args)
    {
        $json             = array();
        // Model
        $model_user       = new Model_user();
        $user             = $model_user->user($args['id']);

        if ($user) {
            $json['code'] = 0;
            $json['note'] = 'Success.';
            $json['data'] = $user;
            $json['help'] = 'http://api.app.com';
        } else {
            $json['code'] = 1;
            $json['note'] = 'No User By ID ' . $args['id'];
            $json['help'] = 'http://api.app.com';
        }
        
        $this->app->log->write($json);

        return $response->withStatus(200)
            ->withHeader("Content-Type", "application/json")
            ->write(json_encode($json));

    }
}


