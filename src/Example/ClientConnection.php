<?php

namespace Lackammer\Test\Example;

class ClientConnection
{
    public function __construct(
        private                $fd,
        private \Swoole\Server $server
    )
    {
    }

    /**
     * @return mixed
     */
    public function getFd()
    {
        return $this->fd;
    }

    public function onReceive($data): void
    {
        $this->server->send($this->fd, $data);
    }

}