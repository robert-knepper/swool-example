<?php
namespace Lackammer\Test\HttpServer;
require_once "../Base/Init.php";

$http = new \Swoole\Http\Server(HOST, PORT);

$http->on("start", function ($server) {
    echo serverStartMessageText("http");
});

$http->on("request", function ($request, $response) {
    $response->header("Content-Type", "text/plain");
    $response->end("Hello from Swoole!\n");
});

$http->start();