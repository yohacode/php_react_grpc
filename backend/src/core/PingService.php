<?php

/**
 * gRPC server application.
 * This class is responsible for initializing the gRPC server and handling requests.
 * It uses the `GrpcServer` class to set up the server and register services.
 * The server listens on a specified port and handles incoming gRPC requests.
 */

namespace App\core;

use Ping\PingRequest;
use Ping\PingServiceInterface;

use Ping\PingResponse;


class PingService implements PingServiceInterface
{
    /**
     * Handles the ping request and returns a pong response.
     *
     * @param PingRequest $request The ping request containing the message.
     * @return PingResponse The pong response with the message.
     */
    public function Ping(\Spiral\GRPC\ContextInterface $ctx, PingRequest $in): PingResponse
    {
        $response = new \Ping\PingResponse();
        $response->setMessage('Pong: ' . $in->getMessage());
        return $response;
    }
}
