<?php

namespace XWallet\Controller;

use Psr\Container\ContainerInterface as ContainerInterface;

use XWallet\Librarie\Log as Log;

class Base
{
    protected $app;
    protected $lib_log;
    protected $data;
    
    function __construct(ContainerInterface $app)
    {
        $this->app     = $app;
        $this->lib_log = new Log();
    }

    public static function default($request, $response)
    {
        $json               = array();

        $json['message']    = "Hello World";
        $json['time']       = time();
        
        return $response->withStatus(200)
            ->withHeader("Content-Type", "application/json")
            ->write(json_encode($json));
    }
}