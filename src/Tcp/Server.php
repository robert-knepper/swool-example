<?php
namespace Lackammer\Test\Tcp;
require_once "../Base/Init.php";

$server = new \Swoole\Server(HOST, PORT);

$server->on("start", function ($server) {
    echo serverStartMessageText("tcp");
});

$server->on("connect", function ($server, $fd) {
    echo "Client {$fd} connected.\n";
});

$server->on("receive", function ($server, $fd, $reactorId, $data) {
    echo "Received from {$fd}: {$data}\n";
    $server->send($fd, "Server: You said -> {$data}\n");
});

$server->on("close", function ($server, $fd) {
    echo "Client {$fd} closed.\n";
});

$server->start();