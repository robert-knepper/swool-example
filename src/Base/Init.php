<?php
require_once "../../vendor/autoload.php";
const HOST = "localhost";
const PORT = "8080";

function serverStartMessageText($message = '') : string
{
    return "Swoole $message server is started at " . HOST . ':' .PORT . " \n";
}