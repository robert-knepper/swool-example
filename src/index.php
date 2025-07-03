<?php
namespace Lackammer\Test;
require_once "../vendor/autoload.php";

$http = new \Swoole\Http\Server("0.0.0.0", 9501);

$http->on("start", function ($server) {
    echo "Swoole HTTP server is started at http://127.0.0.1:9501\n";
});

$http->on("request", function ($request, $response) {
    $response->header("Content-Type", "text/plain");
    $response->end("Hello from Swoole!\n");
});

$http->start();