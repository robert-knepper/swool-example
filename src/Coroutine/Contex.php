<?php

namespace Lackammer\Test\HttpServer;
require_once "../Base/Init.php";

use Swoole\Coroutine;


// Test function
go(function () {
    $ctx = \Swoole\Coroutine::getContext();
    $ctx['user_id'] = 123;
    foo();
});

function foo()
{
    $ctx = \Swoole\Coroutine::getContext();
    dump($ctx['user_id']);
}


// Multi coroutine
go(function () {
    $cid = Coroutine::getCid();
    Coroutine::getContext()['user_id'] = 123;

    dump("In coro {$cid}, user_id = " . Coroutine::getContext()['user_id'] . "\n");
});

go(function () {
    $cid = Coroutine::getCid();
    dump("In coro {$cid}, user_id = ");
    dump(Coroutine::getContext()['user_id'] ?? 'not set');
});

