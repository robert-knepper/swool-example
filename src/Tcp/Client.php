<?php

namespace Lackammer\Test\Tcp;
require_once "../Base/Init.php";


$client = new \Swoole\Client(SWOOLE_SOCK_TCP);

if (!$client->connect(HOST, PORT, 1)) {
    exit("Connection failed. Error: {$client->errCode}\n");
}

$client->send("Hello Server from Swoole Client!\n");

$buffer = '';

while (true) {
    $data = @$client->recv(2);

    // data not found
    if ($data === false || $data === '') {
        if ($client->errCode === SOCKET_EAGAIN || $client->errCode === 11) {
            echo "No response now, retrying...\n";
        } else {
            echo "recv() error: {$client->errCode}\n";
        }
        sleep(1);
        $client->send("Ping from client\n");
        continue;
    }

    // find data
    $buffer .= $data;

    while (($pos = strpos($buffer, "\n")) !== false) {
        $message = substr($buffer, 0, $pos);
        $buffer = substr($buffer, $pos + 1);

        if (trim($message) === '') continue;

        echo "Received complete: {$message}\n";
    }
}