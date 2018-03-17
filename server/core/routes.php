<?php

// 默认路由
$default = 'Dolphin\\Tan\\Controller\\' . ucwords($container->get('config')['defaultController']) . ':index';

$app->get('/', $default)->setName('default');

// 自定义路由
$app->get('/token', 'Dolphin\Tan\Controller\Token:index')->setName('token');
$app->get('/user/{id:[0-9]+}', 'Dolphin\Tan\Controller\User:user')->setName('user');