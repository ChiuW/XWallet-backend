<?php

$app->get('/', 'XWallet\Controller\Base:default')->setName('default');
$app->get('/base', 'XWallet\Controller\Base:default')->setName('default');

$app->get('/currency', 'XWallet\Controller\Currency:getSupportCurrency')->setName('getSupportCurrency');
$app->get('/currency/price', 'XWallet\Controller\Currency:getCurrencyPrice')->setName('getCurrencyPrice');
$app->get('/currency/history/{symbol:[A-Z]+}', 'XWallet\Controller\Currency:getCurrencyHistory')->setName('getCurrencyHistory');

//Ethereum
$app->get('/ETH/status', 'XWallet\Controller\Currency:getSyncStatus')->setName('getSyncStatus:ETH');
$app->get('/ETH/balance/{address:[A-z0-9]+}', 'XWallet\Controller\Currency:getBalance')->setName('getBalance:ETH');
$app->get('/ETH/transaction/status/{address:[A-z0-9]+}', 'XWallet\Controller\Currency:getTransactionStatus')->setName('getTransactionStatus:ETH');
$app->get('/ETH/gas/price/', 'XWallet\Controller\Currency:getGasPrice')->setName('getGasPrice:ETH');
$app->get('/ETH/gas/estimate/', 'XWallet\Controller\Currency:getEstimateGas')->setName('getEstimateGas:ETH');