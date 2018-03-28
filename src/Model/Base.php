<?php

namespace XWallet\Model;
use Medoo\Medoo;
use GuzzleHttp\Client;



class Base
{
    const JSON_RPC_VERSION = '2.0';

    protected $db;
    protected $ethereumClient;
    protected $id;
    
    function __construct()
    {
        $this->db = new Medoo(
            [
            'database_type' => 'mysql',
            'database_name' => getenv('DB_DATANAME'),
                   'server' => getenv('DB_SERVERER'),
                 'username' => getenv('DB_USERNAME'),
                 'password' => getenv('DB_PASSWORD'),
                  'charset' => 'utf8'
            ]
        );

        $this->currencyClient = new Client([
            'base_uri' => getenv('DATA_SRC'),
            'timeout'  => 2.0,
        ]);

        $this->ethereumClient = new Client([
            'base_uri' => getenv('ETH_NODE'),
            'timeout'  => 2.0,
            'headers' => [ 'Content-Type' => 'application/json' ]
        ]);
        $this->id = 1;
    }

    function paserJsonRPC($method, array $params){
        $request = [
            'jsonrpc' => "2.0",
            'method' => $method,
            'params' => array_values($params),
            'id' => "1",
        ];
        $json_request = json_encode($request);
        return $json_request;
    }

    function wei2int($wei)
    {
        return bcdiv($wei,'1000000000000000000',18);
    }
}
