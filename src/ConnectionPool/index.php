<?php
namespace Lackammer\Test\HttpServer;
require_once "../Base/Init.php";

use Swoole\Database\PDOPool;
use Swoole\Database\PDOConfig;

\Swoole\Coroutine\run(function () {
    $pool = new PDOPool(
        (new PDOConfig())
            ->withHost('127.0.0.1')
            ->withPort(3306)
            ->withDbName('test')
            ->withUsername('root')
            ->withPassword('')
            ->withCharset('utf8mb4'),
        5 // سایز pool
    );

    for ($i = 0; $i < 10; $i++) {
        go(function () use ($pool, $i) {
            /** @var \PDO $pdo */
            $pdo = $pool->get();

            $stmt = $pdo->query("SELECT SLEEP(1) as test");
            $data = $stmt->fetchAll();

            echo "[{$i}] Done: " . json_encode($data) . PHP_EOL;
        });
    }
});
