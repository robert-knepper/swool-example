<?php

namespace Lackammer\Test\HttpServer;
require_once "../Base/Init.php";


\Swoole\Coroutine\run(function () {
    go(function () {
        \Swoole\Coroutine::sleep(2);
        echo "Coroutine 1 done\n";
    });

    go(function () {
        \Swoole\Coroutine::sleep(1);
        echo "Coroutine 2 done\n";
    });

    echo "Main coroutine\n";
});
echo "Exit";
/*
Main coroutine
Coroutine 2 done
Coroutine 1 done
Exit
*/


$server = new \Swoole\Http\Server(HOST, PORT);
$server->on("start", function (\Swoole\Http\Server $server) {
    echo serverStartMessageText("http");
});

$server->on("request", function (\Swoole\Http\Request $request, $response) use ($server) {

    go(function () {
        \Swoole\Coroutine::sleep(2);
        echo "Coroutine 1 done\n";
    });

    go(function () {
        \Swoole\Coroutine::sleep(1);
        echo "Coroutine 2 done\n";
    });

    echo "Main coroutine\n";

    $response->end("received request");
});

$server->start();


