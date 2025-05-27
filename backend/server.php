<?php
require 'vendor/autoload.php';

use Spiral\GRPC\Server;
use App\core\PingService;
use Spiral\RoadRunner\Worker;
use Ping\PingServiceInterface;
use Spiral\Goridge\StreamRelay;

// Create Goridge relay from STDIN and STDOUT streams
$relay = new StreamRelay(STDIN, STDOUT);

// Pass the relay to Worker constructor
$worker = new Worker($relay);

$server = new Server();
$server->registerService(PingServiceInterface::class, new PingService());

$server->serve($worker);
