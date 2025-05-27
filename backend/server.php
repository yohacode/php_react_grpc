<?php

use Spiral\GRPC\Server;
use Ping\PingService;

include __DIR__ . '/vendor/autoload.php';

$server = new Server();
$server->registerService(PingServiceInterface::class, new PingService());
$server->serve("0.0.0.0:9000");