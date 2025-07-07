<?php

namespace Lackammer\Test\HttpServer;
require_once "../Base/Init.php";

\Swoole\Coroutine\run(function () {
    $pool = new \Swoole\Coroutine\Channel(2);
    $pool->push("conn1");
    $pool->push("conn2");
    for ($i = 0; $i < 4; $i++) {
        go(function () use ($pool, $i) {
            // wait
            echo "Coroutine {$i} waiting for connection...\n";
            $conn = $pool->pop();

            // work
            echo "Coroutine {$i} got {$conn}\n";
            sleep(1); // simulate work

            // end work and return connection
            $pool->push($conn);
            echo "Coroutine {$i} released {$conn}\n";
        });
    }
});
