<?php

namespace Lackammer\Test\HttpServer;
require_once "../Base/Init.php";

use Swoole\Coroutine;

use function Swoole\Coroutine\go;
use function Swoole\Coroutine\run;

run(function (): void {
    for ($i = 0; $i < 1; $i++) {
        go(function (): void {
            dd(\Swoole\Coroutine::stats());
            // Note that we use the PHP function sleep() directly.
            sleep(1);
        });
    }

    // Note that there are 2,001 coroutines created, including the main coroutine created by function call run().
    echo count(Coroutine::listCoroutines()), ' active coroutines when reaching the end of the PHP script.', PHP_EOL; // @phpstan-ignore argument.type
});