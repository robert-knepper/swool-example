<?php
namespace Lackammer\Test\HttpServer;
require_once "../Base/Init.php";

// create table
$table = new \Swoole\Table(1);
$table->column('count', \Swoole\Table::TYPE_INT);
$table->create();
$table->set('requests', ['count' => 0]);

// start server
$server = new \Swoole\Http\Server(HOST, PORT);
$server->set([
    'worker_num' => 4
]);

$server->on("start", function (\Swoole\Http\Server $server) {
    echo serverStartMessageText("http");
});

$server->on("request", function ($request, $response) use ($server,$table) {
    $table->incr('requests', 'count', 1);
    $count = $table->get('requests', 'count');

    $response->end("Hello! Request count: {$count}\n");
});

$server->start();