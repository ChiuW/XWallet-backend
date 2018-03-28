<?php

namespace XWallet\Controller;

use Psr\Container\ContainerInterface as ContainerInterface;

use XWallet\Model\Currency as Model_currency;

use XWallet\Model\Ethereum as Model_ethereum;

class Currency extends Base {

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

        $json['data'] = $currency;
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

    public function getSyncStatus($request, $response, $args){
        $json               = array();
        $Model_ethereum     = new Model_ethereum();
        $responseObj        = $Model_ethereum->eth_syncing();

        $json['data']               = $responseObj;
        $json['update_time']        = time();

        $this->app->log->write($json);

        return $response->withStatus(200)
            ->withHeader("Content-Type", "application/json")
            ->write(json_encode($json));
    }

    public function getBalance($request, $response, $args){

        $json               = array();
        $Model_ethereum     = new Model_ethereum();
        $responseObj        = $Model_ethereum->eth_getBalance($args['address']);

        $json['data']               = $responseObj;
        $json['update_time']        = time();

        $this->app->log->write($json);

        return $response->withStatus(200)
            ->withHeader("Content-Type", "application/json")
            ->write(json_encode($json));
    }

    public function postTransaction($request, $response, $args){
        $json               = array();
        $Model_ethereum     = new Model_ethereum();

        $data               = $request->getParams("data");
        $responseObj        = $Model_ethereum->eth_sendRawTransaction($data);

        $json['data']               = $responseObj;
        $json['update_time']        = time();

        $this->app->log->write($json);

        return $response->withStatus(200)
            ->withHeader("Content-Type", "application/json")
            ->write(json_encode($json));
    }

    public function getTransactionStatus($request, $response, $args){
        $json               = array();
        $Model_ethereum     = new Model_ethereum();
        $responseObj        = $Model_ethereum->eth_getTransactionReceipt($args['address']);

        $json['data']               = $responseObj;
        $json['update_time']        = time();

        $this->app->log->write($json);

        return $response->withStatus(200)
            ->withHeader("Content-Type", "application/json")
            ->write(json_encode($json));
    }

    public function getGasPrice($request, $response, $args){
        $json               = array();
        $Model_ethereum     = new Model_ethereum();
        $responseObj        = $Model_ethereum->eth_gasPrice();

        $json['data']               = $responseObj;
        $json['update_time']        = time();

        $this->app->log->write($json);

        return $response->withStatus(200)
            ->withHeader("Content-Type", "application/json")
            ->write(json_encode($json));
    }

    public function getEstimateGas($request, $response, $args){
        $json               = array();
        $Model_ethereum     = new Model_ethereum();
        $responseObj        = $Model_ethereum->eth_gasPrice();

        $json['data']               = $responseObj;
        $json['update_time']        = time();

        $this->app->log->write($json);

        return $response->withStatus(200)
            ->withHeader("Content-Type", "application/json")
            ->write(json_encode($json));
    }
}