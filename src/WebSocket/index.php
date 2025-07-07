<?php

namespace Lackammer\Test\WebSocket;
require_once "../Base/Init.php";
$server = new \Swoole\WebSocket\Server(HOST, PORT);

$server->on("start", function (\Swoole\WebSocket\Server $server) {
    echo serverStartMessageText("Web Socket");
});

$server->on('open', function (\Swoole\WebSocket\Server $server, \Swoole\Http\Request $request) {
    echo "connection open: {$request->fd}\n";
});

$server->on('message', function ($server, \Swoole\WebSocket\Frame $frame) {
    echo "received message: {$frame->data}\n";
    $server->push($frame->fd, "Swoole says: {$frame->data}");
});

$server->on('close', function (\Swoole\WebSocket\Server $server, $fd) {
    echo "connection close: {$fd}\n";
});

$server->start();