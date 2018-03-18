<?php

namespace Dolphin\Tan\Controller;

use Psr\Container\ContainerInterface as ContainerInterface;

class Status extends Base
{
    function __construct(ContainerInterface $app)
    {
        parent::__construct($app);
    }
    
    public function index($request, $response, $args)
    {
        $json['code'] = 0;
        $json['data'] = array(
                            'islatestVersion'   => TRUE,
                            'isNeedToUpdate'    => FALSE,
                            'osType'            => $args['osType'],
                            'build'             => $args['build'],
                        );
        $json['help'] = getenv("APP_DOMAIN");
        $json['time'] = time();

        return $response->withStatus(200)
            ->withHeader("Content-Type", "application/json")
            ->write(json_encode($json, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
    }
}


