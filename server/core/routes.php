<?php

$app->get('/', 'XWallet\Controller\Base:default')->setName('default');
$app->get('/base', 'XWallet\Controller\Base:default')->setName('default');

$app->get('/currency', 'XWallet\Controller\Currency:getSupportCurrency')->setName('getSupportCurrency');
$app->get('/currency/price', 'XWallet\Controller\Currency:getCurrencyPrice')->setName('getCurrencyPrice');
$app->get('/currency/history/{symbol:[A-Z]+}', 'XWallet\Controller\Currency:getCurrencyHistory')->setName('getCurrencyHistory');
