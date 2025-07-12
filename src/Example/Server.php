<?php

namespace Lackammer\Test\Example\Server;
use Lackammer\Test\Example\MyTcpServer;

require_once "../Base/Init.php";


$server = new MyTcpServer(HOST,PORT);
$server->start();

/*$server->on("start", function ($server) {
    echo serverStartMessageText("tcp");
});

$server->on("connect", function ($server, $fd) {
    echo "ClientConnection {$fd} connected.\n";
});

$server->on("receive", function ($server, $fd, $reactorId, $data) {
    echo "Received from {$fd}: {$data}\n";
    $server->send($fd, "Server: You said -> {$data}\n");
});

$server->on("close", function ($server, $fd) {
    echo "ClientConnection {$fd} closed.\n";
});*/


