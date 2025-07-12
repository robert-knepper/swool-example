<?php

namespace Lackammer\Test\HttpServer;
require_once "../Base/Init.php";

use Swoole\Coroutine;

use function Swoole\Coroutine\go;
use function Swoole\Coroutine\run;

function printId()
{
    $cid = Coroutine::getCid();
    echo $cid;
}

Coroutine\run(function () {
    printId();
    $cid = Coroutine::getCid();
    go(function () use ($cid) {
        printId();
        sleep(1);
//        Coroutine::resume($cid);
    });
    go(function () use ($cid) {
        printId();
        sleep(1);
        Coroutine::yield();
//        Coroutine::resume($cid);
    });
    go(function () use ($cid) {
        printId();
        sleep(1);
        Coroutine::yield();
        echo "sdwdwd";
//        Coroutine::resume($cid);
    });
    printId();
    echo "before yield\n";
//    Coroutine::yield();
    echo "after yield\n";
    sleep(5);
    dump(Coroutine::listCoroutines());
});