<?php

namespace Dolphin\Tan\Controller;

use Psr\Container\ContainerInterface as ContainerInterface;

use Dolphin\Tan\Model\Currency as Model_currency;

class Currency extends Base
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

    public function getSupportCurrency($request, $response, $args)
    {
        $json               = array();
        // Model
        $Model_currency     = new Model_currency();
        $currency           = $Model_currency->getSupportCurrency();

        $json['code'] = 0;
        $json['note'] = 'Success.';
        $json['data'] = $currency;
        $json['help'] = getenv("APP_DOMAIN");
        $json['time'] = time();
        
        $this->app->log->write($json);

        return $response->withStatus(200)
            ->withHeader("Content-Type", "application/json")
            ->write(json_encode($json));
    }

    public function getCurrencyPrice($request, $response, $args){
        $json               = array();
        $Model_currency     = new Model_currency();

        $currency_data      = array();
        $responseObj        = $Model_currency->getSupportCurrency();

        foreach ($responseObj as $item) {
            $data = $Model_currency->getCurrencyData($item['symbol'],getenv("TARGET_CURRENCY"));
            array_push($currency_data, $data);
        }
       
        $json['data']               = $currency_data;
        $json['update_time']        = time();
        
        $this->app->log->write($json);

        return $response->withStatus(200)
            ->withHeader("Content-Type", "application/json")
            ->write(json_encode($json));
    }

    public function getCurrencyHistory($request, $response, $args){
        $json               = array();
        $Model_currency     = new Model_currency();

        $currency_data      = array();
        $responseObj        = $Model_currency->getCurrencyHistoryData($args['symbol'],getenv("TARGET_CURRENCY"));
       
        $json['data']               = $responseObj;
        $json['update_time']        = time();
        
        $this->app->log->write($json);

        return $response->withStatus(200)
            ->withHeader("Content-Type", "application/json")
            ->write(json_encode($json));
    }
}

