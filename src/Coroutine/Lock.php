<?php

namespace Lackammer\Test\HttpServer;
require_once "../Base/Init.php";

$counter = 0;
$lock = new \Swoole\Lock(SWOOLE_MUTEX);

go(function() use (&$counter, $lock) {
    for ($i = 0; $i < 1000; $i++) {
        $lock->lock();
        $counter++;
        $lock->unlock();
    }
});

go(function() use (&$counter, $lock) {
    for ($i = 0; $i < 1000; $i++) {
        $lock->lock();
        $counter++;
        $lock->unlock();
    }
});

\Swoole\Event::wait();

echo "Counter: {$counter}\n";

// Counter: 2000