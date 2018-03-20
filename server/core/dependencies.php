<?php
$container = $app->getContainer();

// Log
$container['log'] = function ($c) {
    return new XWallet\Librarie\Log();
};