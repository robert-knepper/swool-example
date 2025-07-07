<?php

namespace Lackammer\Test\HttpServer;
require_once "../Base/Init.php";

$counter = new \Swoole\Atomic(0);

go(function () use ($counter) {
    for ($i = 0; $i < 1000; $i++) {
        $counter->add(1);
    }
});

go(function () use ($counter) {
    for ($i = 0; $i < 1000; $i++) {
        $counter->add(1);
    }
});

\Swoole\Event::wait();

echo "Counter: " . $counter->get() . PHP_EOL;

// Counter: 2000