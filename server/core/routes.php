<?php

// 默认路由
$default = 'Dolphin\\Tan\\Controller\\' . ucwords($container->get('config')['defaultController']) . ':index';

$app->get('/', $default)->setName('default');

// 自定义路由

$app->get('/token', 'Dolphin\Tan\Controller\Token:index')->setName('token');
$app->get('/user/{id:[0-9]+}', 'Dolphin\Tan\Controller\User:user')->setName('user');

// get Status
$app->get('/status/{osType:[a-zA-Z]+}/{build}', 'Dolphin\Tan\Controller\Status:index')->setName('getStatus');

// get Support Currency
$app->get('/currency', 'Dolphin\Tan\Controller\Currency:getSupportCurrency')->setName('getSupportCurrency');

// get Currency price
$app->get('/currency/price', 'Dolphin\Tan\Controller\Currency:getCurrencyPrice')->setName('getCurrencyPrice');

// get Currency History
$app->get('/currency/history/{symbol:[A-Z]+}', 'Dolphin\Tan\Controller\Currency:getCurrencyHistory')->setName('getCurrencyHistory');




