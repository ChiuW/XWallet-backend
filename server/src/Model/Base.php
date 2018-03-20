<?php

namespace XWallet\Model;
use Medoo\Medoo;
use GuzzleHttp\Client;

class Base
{
    protected $db;
    
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
            // Base URI is used with relative requests
            'base_uri' => 'https://min-api.cryptocompare.com/',
            // You can set any number of default request options.
            'timeout'  => 2.0,
        ]);
    }
}
