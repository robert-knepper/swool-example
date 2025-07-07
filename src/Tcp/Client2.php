<?php

namespace Lackammer\Test\Tcp;
require_once "../Base/Init.php";


$client = new \Swoole\Client(SWOOLE_SOCK_TCP);

if (!$client->connect(HOST, PORT, 1)) {
    exit("Connection failed. Error: {$client->errCode}\n");
}

$client->send("Hello Server from Swoole Client! \r\n Hello Server from Swoole Client!");
$data = @$client->recv();
echo $data;
$client->close();