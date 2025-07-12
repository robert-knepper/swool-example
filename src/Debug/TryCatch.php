<?php
namespace Lackammer\Test\HttpServer;
require_once "../Base/Init.php";


use function Swoole\Coroutine\run;

run(function (): void {
    try {
        exit(911);
    } catch (\Exception $e) { // @phpstan-ignore catch.neverThrown
        echo <<<EOT
        Calling exit() inside a coroutine throws out a \\Swoole\\ExitException exception instead of terminating code execution
        directly.
        
        There are two extra methods in class \\Swoole\\ExitException::
        1. \\Swoole\\ExitException::getFlags(): The exit flags. In this example, the flags is {$e->getFlags()} (SWOOLE_EXIT_IN_COROUTINE).
        2. \\Swoole\\ExitException::getStatus(): The status as defined in PHP function exit(). In this example, the status is {$e->getStatus()}.

        EOT;
//        exit(911);
    }
});
echo "end";