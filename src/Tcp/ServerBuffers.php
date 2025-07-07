<?php

namespace Lackammer\Test\Tcp;
require_once "../Base/Init.php";

$server = new \Swoole\Server(HOST, PORT);

$buffers = []; // fd => buffer

$server->on("start", fn($server) => print "✅ TCP Server started at " . HOST . ":" . PORT . "\n"
);

$server->on("connect", function ($server, $fd) use (&$buffers) {
    echo "👤 Client {$fd} connected.\n";
    $buffers[$fd] = '';
});

$server->on("receive", function ($server, $fd, $reactorId, $data) use (&$buffers) {
    echo "📩 Chunk from {$fd}: {$data}\n";
    $buffers[$fd] .= $data;
   $str = processBuffer($fd, $buffers);
    $server->send($fd, "Server: You said -> {$str}\n");
});

$server->on("close", function ($server, $fd) use (&$buffers) {
    echo "❌ Client {$fd} closed.\n";
    unset($buffers[$fd]);
});

$server->start();

function processBuffer(int $fd, array &$buffers): string
{
    while (($pos = strpos($buffers[$fd], "\n")) !== false) {
        $message = substr($buffers[$fd], 0, $pos);
        $buffers[$fd] = substr($buffers[$fd], $pos + 1);

        $message = trim($message);
        if ($message === '') continue;

        echo "✅ Complete message from {$fd}: {$message}\n";
        return $message;
//        $server->send($fd, "Server: You said -> {$message}\n");
    }
    return '';
}