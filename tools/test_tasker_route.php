<?php

require_once __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

use Illuminate\Http\Request;

$url = $argv[1] ?? '/en/taskers/4';
$request = Request::create($url, 'GET');
$response = $kernel->handle($request);

echo "URL: {$url}\n";
echo 'Status: '.$response->getStatusCode()."\n";

$kernel->terminate($request, $response);
