<?php

namespace Lackammer\Test\Example;

class MyTcpServer
{
    private \Swoole\Server $server;

    /**
     * @var ClientConnection[]
     */
    private array $clientConnections;

    public function __construct($host, $port)
    {
        $this->server = new \Swoole\Server($host, $port);
        $this->clientConnections = [];
        $this->server->set([
            'open_eof_split' => true,   // Enable EOF_SPLIT check
            'package_eof' => "\r\n", // Set EOF
        ]);
        $this->server->on('start', [$this, 'onStart']);
        $this->server->on('connect', [$this, 'onConnect']);
        $this->server->on('receive', [$this, 'onReceive']);
        $this->server->on('close', [$this, 'onClose']);
    }

    public function onStart()
    {
        echo serverStartMessageText('tcp');
    }

    public function onConnect(\Swoole\Server $server, $fd)
    {
        if (isset($this->clientConnections[$fd]))
            return;
        $this->clientConnections[$fd] = new ClientConnection($fd,$server);
    }

    public function onReceive($server, $fd, $reactorId, $data)
    {
        $this->clientConnections[$fd]->onReceive($data);
    }

    public function onClose()
    {

    }

    public function start(): void
    {
        $this->server->start();
    }

}