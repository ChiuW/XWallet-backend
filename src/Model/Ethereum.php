<?php

namespace XWallet\Model;

use Achse\GethJsonRpcPhpClient\JsonRpc\Client;
use Achse\GethJsonRpcPhpClient\JsonRpc\GuzzleClient;
use Achse\GethJsonRpcPhpClient\JsonRpc\GuzzleClientFactory;

class Ethereum extends Base {

    function __construct(){
        parent::__construct();
    }

    public function eth_syncing(){
        $json_request   = $this->paserJsonRPC("eth_syncing",[]);
        $response       = $this->ethereumClient->post('', ['body' => $json_request]);
        $data           = json_decode($response->getBody(), TRUE);

        if ($data['result'] == false) {
            $sycn_percent = 1;
        }else{
            $currentBlock = hexdec($data['result']['currentBlock']);
            $highestBlock = hexdec($data['result']['highestBlock']);
            $sycn_percent = $currentBlock/$highestBlock;
        }
        
        $responseObj                = array();
        $responseObj['syncing']     = $sycn_percent == 1 ? false: true;
        $responseObj['status']      = $sycn_percent;
        return $responseObj;
    }

    public function eth_getBalance($address){
        $json_request   = $this->paserJsonRPC("eth_getBalance",[$address,'latest']);
        $response       = $this->ethereumClient->post('', ['body' => $json_request]);

        $data           = json_decode($response->getBody(), TRUE);
        $balance        = hexdec($data['result']);

        $balance        = $this->wei2int($balance);

        $responseObj                = array();
        $responseObj['balance']      = $balance;

        return $responseObj;
    }

    public function eth_gasPrice(){
        $json_request   = $this->paserJsonRPC("eth_gasPrice",[]);
        $response       = $this->ethereumClient->post('', ['body' => $json_request]);

        $data           = json_decode($response->getBody(), TRUE);
        $price          = hexdec($data['result']);

        $responseObj                = array();
        $responseObj['gasPrice']      = $price;

        return $responseObj;
    }

    public function eth_sendRawTransaction($tx){
        $json_request   = $this->paserJsonRPC("eth_sendRawTransaction",[$tx]);
        $response       = $this->ethereumClient->post('', ['body' => $json_request]);

        $data           = json_decode($response->getBody(), TRUE);
        print_r($data);
        $responseObj                = array();

        if ($data['error'] != null) {
            $responseObj['success'] = false;
            $responseObj['error']   = $data['error'];
        }else{
            $responseObj['success'] = true;
            $responseObj['TxHash']  = $data['result'];
        }
    
        return $responseObj;
    }

    public function eth_getTransactionReceipt($address){

        $json_request   = $this->paserJsonRPC("eth_getTransactionReceipt",[$address]);
        $response       = $this->ethereumClient->post('', ['body' => $json_request]);

        $data           = json_decode($response->getBody(), TRUE);
        $isSuccess      = hexdec($data['result']['status']);

        $responseObj                = array();
        $responseObj['success']     = $isSuccess == 1 ? true: false;

        return $responseObj;
    }
}