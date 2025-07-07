<?php

namespace Lackammer\Test\HttpServer;
require_once "../Base/Init.php";

$server = new \Swoole\Http\Server(HOST, PORT);

$server->on("start", function (\Swoole\Http\Server $server) {
    echo serverStartMessageText("http");
});

$timers = [];

$server->on("request", function (\Swoole\Http\Request $request, $response) use ($server) {
    $response->end("received request");
    $flag = $request->get['flag'] ?? 1;
    echo $flag;
    if ($flag == 1) {
        addTimer();
    } else {
        clearTimer();
    }
});

$timeoutTimers = [];
$intervalTimers = [];
function addTimer()
{
    global $timeoutTimers;
    global $intervalTimers;
    $timeoutTimers[] = \Swoole\Timer::after(2000, function () {
        echo "after: " . date('H:i:s') . "\n";
    });
    $intervalTimers[] = \Swoole\Timer::tick(5000, function () {
        echo "tick: " . date('H:i:s') . "\n";
    });
    dump($timeoutTimers, $intervalTimers);
}

function clearTimer()
{
    global $timeoutTimers;
    global $intervalTimers;
    foreach ($timeoutTimers as $key => $item) {
        \Swoole\Timer::clear($item);
        unset($timeoutTimers[$key]);
    }
    foreach ($intervalTimers as $key =>$item) {
        \Swoole\Timer::clear($item);
        unset($intervalTimers[$key]);
    }
    echo 'clearTimer: ' . date('H:i:s') . "\n";
}

$server->start();


