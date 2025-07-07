<?php
namespace Lackammer\Test\HttpServer;
require_once "../Base/Init.php";

$server = new \Swoole\Http\Server(HOST, PORT);

$server->set([
    'task_worker_num' => 4,
//    'worker_num' => 2
]);

$server->on("start", function (\Swoole\Http\Server $server) {
    echo serverStartMessageText("task - http");
});

$server->on("request", function ($request, $response) use ($server) {
    $data = $request->get['message'] ?? 'default';
    $server->task($data);
    $response->end("✅ پیام شما دریافت شد و در حال پردازش است!\n");
});

// Task Worker
$server->on("task", function ($server, $task_id, $src_worker_id, $data) {
    echo "🎯 [Task {$task_id}] started with data: {$data}\n";

    sleep(10);
    echo "🎯 [Task {$task_id}] پردازش شد: {$data}\n";

    return "نتیجه پردازش برای: {$data}";
});

$server->on("finish", function ($server, $task_id, $data) {
    echo "✅ [Task {$task_id}] تمام شد: {$data}\n";
});

$server->start();